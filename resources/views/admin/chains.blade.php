@extends('layouts.admin.app')
@section('title', 'Admin')
@section('content')

	<div class="main-container">
	@include('layouts.shared.alert')
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12" style="position: relative;">
							<div class="title">
								<h4>Chains</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation" class="">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Chains</li>
								</ol>
							</nav>
							
						</div>
						<div class="col-md-6">
							<button class="btn btn-primary" style="right:0; position: absolute;" data-toggle="modal" data-target="#addChainModal">Add Chain</button>
						</div>
						
					</div>
				</div>
				<!-- Checkbox select Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Listed Chains</h4>
					</div>
					<div class="pb-20">
						<table class="checkbox-datatable table nowrap">
							<thead>

						<tr>
							<th><div class="dt-checkbox">
									<input type="checkbox" name="select_all" value="1" id="example-select-all">
									<span class="dt-checkbox-label"></span>
								</div>
							</th>
							<th scope="col">#</th>

                            <th scope="col">ICON</th>
                            <th scope="col">SHORTNAME</th>
                            <th scope="col">LONGNAME</th>
                            <th scope="col">ABBR</th>
                            <th scope="col">NATIVE CURRENCY</th>
                            <th scope="col">NATIVE USD</th>	
                            <th scope="col">Action</th>								
                        </tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($chains as $chain)
								@php $count ++ @endphp
								<tr>
									<td></td>
									<td>{{ $count }}</td>
									<td><img src="{{ asset('storage/chain_icons/'.$chain->chain->icon) }}" width="30" alt="" /></td>
									
	                                <td> {{ $chain->name }}</td>
	                                <td>{{ $chain->long_name }}</td>
	                                <td>{{ $chain->abbr }}</td>
	                                <td>{{ $chain->native_currency }}</td>
	                                <td>{{ $chain->native_usd }}</td>
									<td>
										<a href="javascript::void(0)"  data-toggle="modal" data-target="#updateChainModal-{{ $chain->id }}" class="btn btn-secondary btn-sm">Edit <i class="fa fa-eye"></i></a>
										
										<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-{{ $chain->name }}">Delete <i class="fa fa-trash"></i></button>
									</td> 
								</tr>

								<!--Delete Modal -->
								<div class="modal fade" id="delete-{{ $chain->name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								    	<form action="{{ route('delete-chain') }}" method="post">
								    		@csrf
										      <div class="modal-heade pt-3 row pr-1">
										      	<div class="col-11">
										      		<h6 class="text-center modal-title">Confirm action</h6>
										      	</div>
										      	<div class="col-1 text-left">
											      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
										      	</div>
										        

										        
										      </div>
										      <hr>
										      <div class="modal-bod text-center">
										      	Delete {{ $chain->name }}?
										        	<input type="hidden" name="chain_id" value="{{ $chain->id }}">
										        	
										      </div>
										      <hr>
										      <div class="modal-foote text-center py-3">
										        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Go back</button>
										        <button type="name" class="btn btn-primary">Proceed >></button>
										      </div>
								      	</form>
								    </div>
								  </div>
								</div>
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>



				<!-- Add Chain Modal -->
				<div class="modal fade" id="addChainModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    	<form action="{{ route('add-chain') }}" method="post" enctype="multipart/form-data">
				    		@csrf
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Add Chain</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						       		
					       			<div class="form-group">
					       				<label>Long Name</label>
					       				<input type="text" name="long_name" class="form-control" placeholder="e.g. Binance Smart Chain, Ethereum" value="{{ old('long_name') }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Short Name</label>
					       				<input type="text" name="short_name" class="form-control" placeholder="e.g. BSC, Ethereum" value="{{ old('short_name') }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Abbr</label>
					       				<input type="text" name="quote_currency" class="form-control" placeholder="e.g ETH, BSC" value="{{ old('quote_currency') }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Icon</label>
					       				<input type="file" name="icon" class="form-control">
					       			</div>
					       			
					       			<div class="form-group">
					       				<label>Native Currency</label>
					       				<input type="text" name="native_currency" class="form-control" placeholder="e.g ETH, BNB" value="{{ old('quote_address') }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Native USD</label>
					       				<input type="text" name="base_address" class="form-control" placeholder="Base Currency Address"  value="{{ old('base_address') }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Exchange</label>
					       				<select class="form-control" name="exchange" required>
					       					<option selected disabled>Select One</option>
					       					@foreach($exchanges as $exchange)
											<option value="{{ $exchange->id }}" @if(old('exchange')) @if(old('exchange')==$exchange->id) selected @endif @endif>{{ $exchange->name }}</option>
					       					@endforeach
					       				</select>
					       			</div>

					       			<div class="form-group">
					       				<label>Network/Chain</label>
					       				<select class="form-control" name="network" required>
					       					<option selected disabled>Select One</option>
					       					@foreach($networks as $network)
											<option value="{{ $network->id }}" @if(old('network')) @if(old('network')==$network->id) selected @endif @endif>{{ $network->name }}</option>
					       					@endforeach
					       				</select>
					       			</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary">Submit</button>
						      </div>
						  </form>
				    </div>
				  </div>
				</div>

				@php $cc = 0; @endphp
				@foreach($chains as $coin)
				@php $cc ++ @endphp
				<!-- Edit Chain Modal -->
				<div class="modal fade" id="updateChainModal-{{ $coin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    	<form action="{{ route('update-chain') }}" method="post" enctype="multipart/form-data">
				    		@csrf
				    		<input type="hidden" name="id" value="{{ $chain->id }}">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Edit Chain</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						       		
					       			<div class="form-group">
					       				<label>Name</label>
					       				<input type="text" name="long_name" class="form-control" placeholder="ToKen Name" value="{{ $coin->long_name }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Symbol</label>
					       				<input type="text" name="name" class="form-control" placeholder="ToKen Symbol" value="{{ $coin->name }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Icon</label>
					       				<input type="file" name="logo" class="form-control" >
					       				<input type="hidden" name="current_photo" value="{{ $coin->logo }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Quote Currency</label>
					       				<input type="text" name="quote_currency" class="form-control" placeholder="USDT" value="{{ $coin->quote_currency }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Quote Currency Address</label>
					       				<input type="text" name="quote_address" class="form-control" placeholder="Quote Currency Address" value="{{ $coin->quote_address }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Base Currency Address</label>
					       				<input type="text" name="base_address" class="form-control" placeholder="Base Currency Address" value="{{ $coin->base_address }}">
					       			</div>
					       			<div class="form-group">
					       				<label>Exchange</label>
					       				<select class="form-control" name="exchange" required>
					       					<option selected disabled>Select One</option>
					       					@foreach($exchanges as $exchange)
											<option value="{{ $exchange->id }}" @if($coin->exchange_id == $exchange->id) selected @endif>{{ $exchange->name }}</option>
					       					@endforeach
					       				</select>
					       			</div>

					       			<div class="form-group">
					       				<label>Network/Chain</label>
					       				<select class="form-control" name="network" required>
					       					<option selected disabled >Select One</option>
					       					@foreach($networks as $network)
											<option value="{{ $network->id }}" @if($coin->chain_id == $network->id) selected @endif>{{ $network->name }}</option>
					       					@endforeach
					       				</select>
					       			</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary">Submit</button>
						      </div>
						  </form>
				    </div>
				  </div>
				</div>
				@endforeach

@endsection