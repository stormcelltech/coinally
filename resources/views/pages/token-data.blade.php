@extends('layouts.app')
@section('title', 'Coinally')
@section('content')
    
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script>
        const tradeViewData = {
                "width": "100%",
                "height": 610,
                "symbol": "{{ $coin->exchange->name }}:{{ $coin->symbol.$coin->quote_currency }}",
                "timezone": "Etc/UTC",
                "theme": "dark",
                "style": "1",
                "locale": "en",
                "toolbar_bg": "#f1f3f6",
                "enable_publishing": false,
                "withdateranges": true,
                "range": "YTD",
                "hide_side_toolbar": false,
                "allow_symbol_change": true,
                "details": true,
                "hotlist": true,
                "calendar": true,
                "container_id": "tradingview_c53a1"
        }
    </script>
   
    {{-- <div id="token-data"></div> --}}
                
                <section>
                    <div class="container mt-5">

                        @include('layouts.components.center-logo')
                        @include('layouts.components.wide-search-form')
                    </div>
                </section>


                <section>
                    <div class="container-custom container-sm conntainer-md">
                         {{-- Breadcrumb --}} 
                        <ul>
                            <li class="custom-list"><a href="./index.html"><i class="fas fa-home"></i></a></li>
                            <li class="custom-list"><a href="#" class="font-weight-bold text-decoration-none small-text">{{ ucwords($network->long_name)}} Pools</a></li>
                            <li class="custom-list"><a href="#" class="text-decoration-none small-text">{{ $coin->symbol.'-'.$coin->quote_currency }} on {{ $coin->exchange->name }}</a></li>
                        </ul>
                         {{--  Breadcrumb end  --}}
                        <div class="row my-4">
                            <div class="col-md-3">
                                <div class="coin-breadcrumb text-white">
                                    <ul class="custom-ul">
                                        <li  style="display: inline;" class="icon-coin"><img src="{{ asset('storage/token_icons/'.$coin->logo) }}" width="20" alt="" />
                                        </li>
                                        <li  style="display: inline;" class="icon-coin"><img src="{{ asset('storage/token_icons/'.strtolower($coin->quote_currency).'.png') }}" width="20" alt="" /></li>
                                        <li  style="display: inline;" class="font-weight-bold text-white">{{ $coin->symbol }}</li>
                                        <li  style="display: inline;" class="text-white">{{ $coin->quote_currency }}</li>
                                    </ul>
                                </div>
                                <div class="coin-price">
                                    {{ strtoupper($coin->long_name)  }} Price ({{ $coin->symbol }})
                                </div>
                                <span class="coin-fiat">
                                    ${{ $coin->price }}
                                </span>
                                <span class="coin-pump">+7.78%</span>
                                <div class="coin-button my-2">
                                    <span>
                                        <a href="#" class="btn btn-secondary btn-sm"> Swap on <img src="{{ asset('storage/exchange_icons/'.$coin->exchange->icon) }}" width="20" alt="" /></a>
                                        <a href="#" class="btn btn-secondary btn-sm mx-2"><img src="{{ asset('assets/images/icons/coingecko-e47ba33be46bbde3f8bdf43fcc20f3e2b5835f8f7639f29db2f54d1748a91e27.pn') }}" width="20" alt="" /></a>
                                        <a href="#" class="btn btn-secondary btn-sm mr-2">Explorer</a>
                                        <a href="#" class="btn btn-secondary btn-sm facebook-brand"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" class="btn btn-secondary btn-sm twitter-brand"><i class="fab fa-twitter"></i></a>
                                    </span>
                                </div>
                                <form action="">
                                    {{-- Pair --}}
                                    <div class="pair text-white">Pair</div>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-address1" id="inputGroup-sizing-sm"><img src="{{asset('storage/exchange_icons/'.$coin->exchange->icon)}}" width="20px" alt="" /></span>
                                        </div>
                                        <input type="text" class="form-control custom-address" aria-label="Sizing example input" value=" 0x49859419c83465eeeedd7b1d30db99ce58c88ec3" />
                                        <div class="input-group-append custom-append">
                                            <button class="input-group-text custom-address2" id="inputGroup-sizing-sm"><i class="fas fa-clipboard"></i></button>
                                        </div>
                                    </div>
                                    {{-- Token --}}
                                    <div class="Tokems text-white">Tokens</div>
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-address1" id="inputGroup-sizing-sm"><img src="{{ asset('storage/token_icons/'.$coin->logo) }}" width="20px" alt="" /> <b class="px-1">{{ $coin->symbol }}</b></span>
                                        </div>
                                        <input type="text" class="form-control custom-address" aria-label="Sizing example input" value=" {{ $coin->base_address }}" aria-describedby="inputGroup-sizing-sm"/>
                                        <div class="input-group-append custom-append">
                                            <button class="input-group-text custom-address2" id="inputGroup-sizing-sm"><i class="fas fa-clipboard"></i></button>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text custom-address1" id="inputGroup-sizing-sm"><img src="{{ asset('storage/token_icons/'.strtolower($coin->quote_currency).'.png') }}" width="20px" alt="" /><b class="px-1">{{ $coin->quote_currency }}</b></span>
                                        </div>
                                        <input type="text" class="form-control custom-address" aria-label="Sizing example input" value=" {{ $coin->quote_address }}" 
                                        aria-describedby="inputGroup-sizing-sm" />
                                        <div class="input-group-append custom-append">
                                            <button class="input-group-text custom-address2" id="inputGroup-sizing-sm"><i class="fas fa-clipboard"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="custom-price-table">Name
                                    <div class="row my-2">
                                        <div class="col-6 text-left">
                                            Dex
                                        </div>
                                        <div class="col-6 text-right text-white">
                                            {{ $coin->exchange->name }}
                                        </div>
                                    </div>
                                    <hr class="custom-hr" />

                                    {{-- <div class="row my-2">
                                        <div class="col-6 text-left">
                                            Fully Diluted Valuation
                                        </div>
                                        <div class="col-6 text-right text-white">
                                            $154,670,838
                                        </div>
                                    </div>
                                    <hr class="custom-hr" />

                                    <div class="row my-2">
                                        <div class="col-6 text-left">
                                            Total Liquidity (USD)
                                        </div>
                                        <div class="col-6 text-right text-white">
                                            $1,264,286
                                        </div>
                                    </div>
                                    <hr class="custom-hr" /> --}}
                                    <div class="row my-2">
                                        <div class="col-6 text-left">
                                            24hr Trading Volume
                                        </div>
                                        <div class="col-6 text-right text-white">
                                            $ {{ number_format($coin->volume_24) }}
                                        </div>
                                    </div>
                                    <hr class="custom-hr" />
                                    <div class="row my-2">
                                        <div class="col-6 text-left">
                                            Market Cap
                                        </div>
                                        <div class="col-6 text-right text-white">
                                            N/A
                                        </div>
                                    </div>
                                    <hr class="custom-hr" />
                                </div>
                                <div class="card custom-card border-0 shadow my-3">Name
                                    <div class="card-body">
                                        <div class="custom-grade-point">100%</div>

                                        <div class="desc my-2 font-weight-bold">
                                            How do you feel about {{ $coin->symbol }} today?

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="small-text">
                                                    Vote to see community results!

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="#" class="btn btn-secondary"> Good</a>
                                                <a href="#" class="btn btn-warning"> Bad</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tradingview-widget-container">
                                    <div id="tradingview_c53a1"> </div>
                                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/{{ $coin->exchange->name }}:{{ $coin->symbol.$coin->quote_currency }}/?exchange={{ $coin->exchange->name }}" rel="noopener" target="_blank"><span class="blue-text">SHIBUSD Chart</span></a> by TradingView</div>
                                    
                                    <script>
                                        new TradingView.widget(tradeViewData)
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container-custom">
                        <div class="table-responsive">
                            <table class="table table-dark custom-table-dark" id="resultsTable">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th scope="col">type</th>
                                        {{-- <th scope="col">price (bnb)</th> --}}
                                        <th scope="col">price ({{ $coin->quote_currency }})</th>
                                        <th scope="col">amount ({{ $coin->symbol }})</th>
                                        <th scope="col">total {{ $coin->quote_currency }}</th>
                                        <th scope="col">time</th>
                                        <th scope="col">from</th>
                                        <th scope="col">tx</th>

                                    </tr>
                                </thead>
                                <tbody id="trade-history"></tbody>
                            </table>
                        </div>
                    </div>
                </section>


                <script>

                    function getTrades(){
                         $.ajax({
                            type: "GET",
                            url: "{{ route('latest-pair-trade') }}",
                            data:{
                                base_address: "{{ $coin->base_address }}",
                                quote_address: "{{ $coin->quote_address }}",
                                network: "{{ $coin->chain->name }}",
                                exchange: "{{ $coin->exchange->name }}",
                            },
                            success:function(feedback){
                                // feedback = JSON.parse(feedback);
                                const trades = feedback.data.ethereum.dexTrades
                                console.log(trades);
                                $('#trade-history').empty();
                                 $.each(trades, function( index, value ){
                                    // let sellCurrSym = value.sellCurrency.symbol
                                    className = value.sellCurrency.symbol == value.baseCurrency.symbol?'custom-red':'custom-green';
                                    tradeType = value.sellCurrency.symbol == value.baseCurrency.symbol?'sell':'buy';
                                    $('#trade-history').append(`<tr class="">
                                            <td scope="row" class="`+className+`">`+tradeType+`</td>
                                            
                                            <td class="`+className+`">$`+value.quotePrice+`</td>
                                            <td class="`+className+`">`+numberWithCommas(value.baseAmount)+`</td>
                                            <td class="`+className+`">`+numberWithCommas(value.tradeAmount)+`</td>
                                            <td>`+value.date.date+`</td>
                                            <td>`+value.transaction.txFrom.address.substring(0, 8)+`</td>
                                            <td><a href="https://etherscan.io/tx/`+value.transaction.hash+`" target="_blank">View</a></td>
                                        </tr>`)
                                 })
                            },
                            error:function(param1, param2, param3){
                                // alert(param3)
                                console.log(param3)
                            }
                        });
                    }


                    function getCurrentTokenPrice(){
                        $.ajax({
                            url: "{{ url('get-token-price') }}",
                            tpe:"GET",
                            data:{
                                token:"{{ $coin->symbol }}"
                            },

                            success:function(response){
                                let price = response.data.ethereum.dexTrades[0].quotePrice
                                // console.log(response.data.ethereum.dexTrades[0].quotePrice);
                                $('.coin-fiat').text(price.toFixed(8));

                            },
                            error:function(param1, param2, param3){
                                alert(param3);
                            }
                        })
                    }

                   getTrades();
                   getCurrentTokenPrice();

                   setInterval(getTrades, 60000);
                   setInterval(getCurrentTokenPrice, 60000);
                </script>


@endsection
   