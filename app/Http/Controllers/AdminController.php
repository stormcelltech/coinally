<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chain;
use App\Models\Token;
use App\Models\Exchange;
use App\Custom\SanitizeInput;
use Storage;
use Auth;
use Hash;
class AdminController extends Controller
{   
    function __construct(){
        $this->clean = new SanitizeInput;
    }
    function index(){

        $networks = $data['networks'] = Chain::all();
        $exchanges = $data['exchanges'] = Exchange::all();
        $tokens = $data['tokens'] = Token::with('chain')->get();
        return view('admin.index')->with($data);
    }

    function promotedTokens(){

        $networks = $data['networks'] = Chain::all();
        $exchanges = $data['exchanges'] = Exchange::all();
        $tokens = $data['tokens'] = Token::with('chain')->where('promoted', 'yes')->get();
        return view('admin.index')->with($data);
    }

    function vettedTokens(){

        $networks = $data['networks'] = Chain::all();
        $exchanges = $data['exchanges'] = Exchange::all();
        $tokens = $data['tokens'] = Token::with('chain')->where('vetted', 'yes')->get();
        return view('admin.index')->with($data);
    }

    function unVettedTokens(){

        $networks = $data['networks'] = Chain::all();
        $exchanges = $data['exchanges'] = Exchange::all();
        $tokens = $data['tokens'] = Token::with('chain')->where('vetted', 'no')->get();
        return view('admin.index')->with($data);
    }

    function login(){
        return view('auth.admin.login');
    }

    function signin(Request $request){
         $request->validate([
            'email'   => 'required|email',
            'password' => 'required'
        ]);
         $email = $this->clean->sanitize($request->email);
         $password = $this->clean->sanitize($request->password);
         $password = Hash::make($password);

         if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->route('admin');
        }
        return back();
    }

    function addToken(Request $request){
        // dd($request);
        $token = new Token;
        $token->long_name = $this->clean->sanitize($request->long_name);
        $token->symbol = $this->clean->sanitize($request->symbol);
        $token->quote_currency = $this->clean->sanitize($request->quote_currency);
        $token->quote_address = $this->clean->sanitize($request->quote_address);
        $token->base_address = $this->clean->sanitize($request->base_address);
        $token->exchange_id = $this->clean->sanitize($request->exchange);
        $token->chain_id = $this->clean->sanitize($request->network);
        $token->long_name = $this->clean->sanitize($request->long_name);
        if ($request->hasFile('logo')) {
            $logo         = $request->logo;
            $logoName = $logo->getClientOriginalName();
            $logoExt = $logo->getClientOriginalExtension();
            $logoName = pathinfo($logo, PATHINFO_FILENAME);
            $logoToDb = $logoName . '_' . time() . '.' . $logoExt;
            $savelogo = $logo->storeAs('public/token_icons', $logoToDb);

            $token->logo = $logoToDb;
        }
        $token->save();

        Session(['msg'=>'New token added', 'alert'=>'success']);
        return redirect()->back();

        
    }

    function updateToken(Request $request){
        
        $token = Token::where('id', $request->id)->first();
        
        $token->long_name = $this->clean->sanitize($request->long_name);
        $token->symbol = $this->clean->sanitize($request->symbol);
        $token->quote_currency = $this->clean->sanitize($request->quote_currency);
        $token->quote_address = $this->clean->sanitize($request->quote_address);
        $token->base_address = $this->clean->sanitize($request->base_address);
        $token->exchange_id = $this->clean->sanitize($request->exchange);
        $token->chain_id = $this->clean->sanitize($request->network);
        $token->long_name = $this->clean->sanitize($request->long_name);
        if ($request->hasFile('logo')) {
            // dd('.' . Storage::url('app/public/token_icons/'.$token->logo));
            if (file_exists('.' . Storage::url('app/public/token_icons/'.$token->logo)) && is_file('.' . Storage::url('app/public/token_icons/'.$token->logo))) {
                unlink('.' . Storage::url('app/public/token_icons/'.$token->logo));
            }
            $logo         = $request->logo;
            $logoName = $logo->getClientOriginalName();
            $logoExt = $logo->getClientOriginalExtension();
            $logoName = pathinfo($logo, PATHINFO_FILENAME);
            $logoToDb = $logoName . '_' . time() . '.' . $logoExt;
            $savelogo = $logo->storeAs('public/token_icons', $logoToDb);

            $token->logo = $logoToDb;
        }else{
            $token->logo = $request->current_photo;
            
        }
        $token->save();

        Session(['msg'=>'token updated', 'alert'=>'success']);
        return redirect()->back();
    }

    function deleteToken(Request $request){
        $token = Token::where('id', $request->token_id)->first();
         if (file_exists('.' . Storage::url('app/public/token_icons'.$token->logo)) && is_file('.' . Storage::url('app/public/token_icons'.$token->logo))) {
                
            unlink('.' . Storage::url('app/public/token_icons'.$token->logo));
        }
        Token::where('id', $request->token_id)->delete();
        Session(['msg'=>'token deleted', 'alert'=>'success']);
        return redirect()->back();
    }


    function chains(){
        $data['chains'] = Chain::all();
        return view('admin.chains')->with($data);
    }

    function promoteToken(Request $request){
        $token_id = $this->clean->sanitize($request->token_id);
        $token =Token::where('id', $token_id)->first();
        $token->promoted = 'yes';
        $token->save();
        return json_encode(['status'=>'success', 'msg'=>'token promoted']);
    }

    function unPromoteToken(Request $request){
        $token_id = $this->clean->sanitize($request->token_id);
        $token =Token::where('id', $token_id)->first();
        $token->promoted = 'no';
        $token->save();
        return json_encode(['status'=>'success', 'msg'=>'token removed from promotion']);
    }
    function vetToken(Request $request){
        $token_id = $this->clean->sanitize($request->coin);
        $token =Token::where('id', $token_id)->first();
        $token->vetted = 'yes';
        $token->save();
        return json_encode(['status'=>'success', 'msg'=>'token Vetted']);
    }
    function unVetToken(Request $request){
        $token_id = $this->clean->sanitize($request->coin);
        $token =Token::where('id', $token_id)->first();
        $token->vetted = 'no';
        $token->save();
        return json_encode(['status'=>'success', 'msg'=>'token removed from Vetted list']);
    }
}
