@extends('layouts.app')

@section('csslibs')
    <style>
        .content { padding: 0; }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="home-content">
            <div class="column col1"></div>

            <div class="column col2">
                <div class="section valign-wrapper">
                    <div>
                        <h1 class="h5">{{ $text1 }}</h1>
                        <a class="btn waves-effect waves-light light-blue lighten-1" href="{{ url('offers') }}">{{ $link1 }}</a>
                        <p>{{ $text2 }}</p>
                    </div>
                </div>

                <div class="section valign-wrapper">
                    <div>
                        <h2 class="h5">{{ $text3 }}</h2>

                        <a class="btn waves-effect waves-light light-blue lighten-1" href="{{ url('offer/new') }}">{{ $link2 }}</a>
                        <span class="info-or">or</span>
                        <a class="btn waves-effect waves-light light-blue lighten-1" href="{{ url('associations') }}">{{ $link3 }}</a>

                        <p>{{ $text4 }}</p>
                    </div>
                </div>
                    
                <div class="section valign-wrapper">
                    <div>
                        <h3 class="h5">{{ $text5 }}</h3>
                        <a class="btn waves-effect waves-light teal lighten-1" href="{{ url(env('UWUM_REGISTER_ASSOC_URL')) }}">{{ $link4 }}</a>
                        <p>{{ $text6 }}</p>
                    </div>
                </div>
            </div>
        </div>


        
    </div>
@endsection

@section('jslibs')
    <script>
    </script>
@endsection