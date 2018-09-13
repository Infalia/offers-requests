@extends('layouts.app')

@section('csslibs')
    <style>
        .content { padding: 0; }
    </style>
@endsection

@section('content')
    <div class="content">
        {{-- <div class="container">
            <h1 class="h3 teal-text text-lighten-1">{{ $heading1 }}</h1>
            <p class="h5">{{ $text1 }}</p>

            <div class="row home-options">
                <div class="col m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/goods.jpg">
                            <span class="card-title" style="color: #222222;">{{ $heading2 }}</span>
                        </div>
                        
                        <div class="card-content">
                            <p>{{ $text2 }}</p>
                        </div>

                        <div class="card-action">
                            <a href="{{ url('/offers') }}" class="teal-text text-lighten-1">{{ $link1 }}</a>
                        </div>
                    </div>
                </div>

                <div class="col m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/services.jpg">
                            <span class="card-title">{{ $heading3 }}</span>
                        </div>

                        <div class="card-content">
                            <p>{{ $text3 }}</p>
                        </div>

                        <div class="card-action">
                            <a href="{{ url('/associations') }}" class="teal-text text-lighten-1">{{ $link2 }}</a>

                            @if ($isAssociation == true)
                            <a href="{{ url('/association/register') }}" class="right teal-text text-lighten-1">{{ $link3 }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="wrapper">
            <div class="column col1">
                <div class="info">
    
                </div>
            </div>

            <div class="column col2">
                <div class="info">
                    <h2>{{ $text1 }}</h2>
                    <a class="btn waves-effect waves-light light-blue lighten-1" href="{{ url('offers') }}">{{ $link1 }}</a>
                    <p>{{ $text2 }}</p>

                    <h2>{{ $text3 }}</h2>
                    <a class="btn waves-effect waves-light light-blue lighten-1" href="{{ url('offer/new') }}">{{ $link2 }}</a>
                    <span class="info-or">or</span>
                    <a class="btn waves-effect waves-light light-blue lighten-1" href="{{ url('associations') }}">{{ $link3 }}</a>

                    <p>{{ $text4 }}</p>
                
                    <br /><br /><br /><br />

                    <h2>{{ $text5 }}</h2>
                    <a class="btn waves-effect waves-light light-blue lighten-1" href="{{ url('login/uwum') }}">{{ $link4 }}</a>
                    <p>{{ $text6 }}</p>
                </div>
            </div>
        </div>


        
    </div>
@endsection

@section('jslibs')
    <script>
    </script>
@endsection