<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather App</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito';
                background-color: white;
            }
            #weather-search_filter, #weather-search_paginate{
                float: right;
            }
        </style>
    </head>
    <body>
    <div id="app">
        <div class="container">
            <div class="row mt-5">
               <div class="col-sm-10 offset-sm-1">
                   @if ($errors->any())
                       <div class="alert alert-danger">
                           <ul>
                               @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                       </div>
                   @endif
                   @isset($exception)
                       <div class="alert alert-danger">{{ $exception }}</div>
                   @endisset

                   <nav>
                       <div class="nav nav-tabs" id="nav-tab" role="tablist">
                           <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#zip-code" role="tab" aria-controls="zip-code" aria-selected="true">Weather Search</a>
                           <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#search-history" role="tab" aria-controls="search-history" aria-selected="false">Search History</a>
                       </div>
                   </nav>
               </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="zip-code" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <x-zip-code></x-zip-code>
                    </div>
                    @isset($weatherByZipCode)
                        <div class="row">
                            <x-weather-card :weatherByZipCode="$weatherByZipCode"></x-weather-card>
                        </div>
                    @endisset
                </div>
                <div class="tab-pane fade" id="search-history" role="tabpanel" aria-labelledby="nav-profile-tab">
                    @isset($searchHistory)
                        <div class="row">
                            <x-search-history :searchHistory="$searchHistory"></x-search-history>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#weather-search').dataTable({
                "ordering": false
            });
            $('.zip-code-search').on('click', function (){
                $('.spinner-border-sm').addClass('spinner-border');
            });
        });
    </script>
    </body>
</html>
