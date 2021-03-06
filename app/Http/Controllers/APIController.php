<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Chain;
use App\Models\Token;
use App\Custom\BlockchainData;
use Response;

class APIController extends Controller
{
    private $token;
    function __construct(){
        $this->token = 'eyJhbGciOiJIUzUxMiJ9.eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTY0MzEwNTQ0MiwiaWF0IjoxNjQzMTA1NDQyfQ.HHjIscWL29AHwVpN-KRdHvp6DAC_wv1qL6zG2CDCX9ftHuTepe-dBfqKL0M31Sn_Wd6A8y3zNnVyAK195s4oXQ';

        $this->blockchainData = new BlockchainData;
    }
    public function getNetworks(Request $request){
        
        if (!$request->hasHeader('authorization')) {
           return Response::json([
                'status'=>'fail',
                'message'=>'missing authorization header'
            ], 406);
        }
        if ($request->bearerToken() != $this->token) {
             return Response::json([
                'status'=>'fail',
                'message'=>'invalid bearer token'
            ], 406);
        }
        
        $networks = Chain::all();
        // $tokens = Token::paginate(10);

        return Response::json([
            'status'=>'success',
            'networks'=>$networks
        ], 200);
    }



    public function getTokens(Request $request){
        
        if (!$request->hasHeader('authorization')) {
           return Response::json([
                'status'=>'fail',
                'message'=>'missing authorization header'
            ], 406);
        }
        if ($request->bearerToken() != $this->token) {
             return Response::json([
                'status'=>'fail',
                'message'=>'invalid bearer token'
            ], 406);
        }
        $tokens = Token::with('chain')->get();
        // $tokens = Token::paginate(10);

        return Response::json([
            'status'=>'success',
            'tokens'=>$tokens
        ], 200);
    }

    // current price off a token
    // function currentTokenPrice($token){
    //     if (!$request->hasHeader('authorization')) {
    //         return Response::json([
    //              'status'=>'fail',
    //              'message'=>'missing authorization header'
    //          ], 406);
    //      }
    //      if ($request->bearerToken() != $this->token) {
    //           return Response::json([
    //              'status'=>'fail',
    //              'message'=>'invalid bearer token'
    //          ], 406);
    //      }

        
    //     $query = <<<GQL
    //         query {
    //             ethereum(network: bsc) {
    //                 dexTrades(
    //                 baseCurrency: {is: "0x0e09fabb73bd3ade0a17ecc321fd13a19e81ce82"}
    //                 quoteCurrency: {is: "0x55d398326f99059ff775485246999027b3197955"}
    //                 options: {desc: ["block.height", "transaction.index"], limit: 1}
    //                 ) {
    //                 block {
    //                     height
    //                     timestamp {
    //                     time(format: "%Y-%m-%d %H:%M:%S")
    //                     }
    //                 }
    //                 transaction {
    //                     index
    //                 }
    //                 baseCurrency {
    //                     symbol
    //                 }
    //                 quoteCurrency {
    //                     symbol
    //                 }
    //                 quotePrice
                    
    //                 }
    //             }
    //         }
    //         GQL;

    //         $response = Http::withHeaders([
    //             'Content-Type' => 'application/json',
    //             'X-API-KEY'=>'BQYshahSPmMeRFldJmCee0NNDaOVQnU1',
    //         ])->post('https://graphql.bitquery.io/', [
    //             'query' => $query
    //         ]);

    //        return $response->json();
    // }

    function currentTokenPrice(Request $request){
        $token = Token::where('symbol', $request->token)->first();
        return $this->blockchainData->getTokenPrice($token);
    }

    function getLatestTradesForGivenPair(Request $request){

        $now = time();
        $endIso =  date('c', $now);
        $start = $now - 86400;
        $startIso = date('c', $start);
        $baseAddress = $request->base_address;
        $quoteAddress = $request->quote_address;
        $network = $request->network;
        $exchange = $request->exchange;

        $query = <<<GQL
            
             query {
                ethereum(network: $network) {
                  dexTrades(
                    baseCurrency: {is: "$baseAddress"}
                    options: {limit: 10}
                    time: {till: "$endIso", since: "$startIso"}
                    quoteCurrency: {is: "$quoteAddress"}
                  ) {
                    tradeAmount(in: USD)
                    quoteCurrency {
                      symbol
                      decimals
                      name
                    }
                    baseAmount(calculate: anyLast)
                    baseCurrency {
                      decimals
                      name
                      symbol
                    }
                    quotePrice(calculate: anyLast, exchangeName: {is: "$exchange"})
                    sellCurrency {
                      symbol
                      name
                    }
                    date {
                      date
                    }
                    transaction {
                        to {
                          annotation
                          address
                        }
                        txFrom {
                          address
                        }
                        hash
                    }
                  }
                }
              }

            GQL;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-KEY'=>'BQYshahSPmMeRFldJmCee0NNDaOVQnU1',
            ])->post('https://graphql.bitquery.io/', [
                'query' => $query
            ]);

           return $response->json();
    }


    function search(Request $request){
        $string = $request->q;
        $scope = $request->scope;
        if ($scope == 'blockchain') {
            
            $query = <<<GQL
            
             query {
                search(string: "$string", limit: 1) {
                    subject {
                      ... on SmartContract {
                        address
                        annotation
                        contractType
                        protocol
                      }
                      ... on Currency {
                        address
                        name
                        symbol
                        tokenType
                        decimals
                      }
                    }
                    network {
                      network
                      protocol
                    }
                  }
              }

            GQL;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-KEY'=>'BQYshahSPmMeRFldJmCee0NNDaOVQnU1',
            ])->post('https://graphql.bitquery.io/', [
                'query' => $query
            ]);
            $response = $response->json();
            if (array_key_exists('data', $response)) {
                // dd('kkk');
                if (array_key_exists('search', $response['data'])) {
                    if (array_key_exists(0, $response['data']['search'])) {
                        if (array_key_exists('subject', $response['data']['search'][0])) {
                            $status = 'seen';
                            $tokenAddr = $data['tokenAddr'] = $response['data']['search'][0]['subject']['address'];
                            $tokenChain = $data['tokenChain'] = $response['data']['search'][0]['network']['network'];
                            $tokenSymbol = $data['tokenSymbol'] = $response['data']['search'][0]['subject']['symbol'];
                            $tokenName = $data['tokenName'] = $response['data']['search'][0]['subject']['name'];
                            $tokenType = $data['tokenType'] = $response['data']['search'][0]['subject']['tokenType'];
                            $token = Token::where('symbol', $tokenSymbol)->first();
                            if (!is_null($token)) {
                                return redirect(route('token-via-chain', [$tokenChain, $tokenAddr]));
                            }else{
                                // dd($data);
                                return view('pages.search-result')->with($data);
                            }
                            
                        }
                    }
                }
            }
            if (!isset($status)) {
                dd($response->json());
            }
            
            return;

        }
         
    }
}
