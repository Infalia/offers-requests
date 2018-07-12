@extends('layouts.app')

@section('csslibs')
    {!! HTML::style('plugins/owl/assets/owl.carousel.min.css') !!}
    {!! HTML::style('plugins/owl/assets/owl.theme.green.min.css') !!}
    {!! HTML::style('plugins/baguettebox/baguetteBox.min.css') !!}
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="association">
                @if(!empty($association))

                
                <div class="row">
                    @if(Auth::check() && Auth::id() == $association->user->id)
                    <div class="col s12 right-align" style="margin-bottom: 10px;">
                        <a class="waves-effect waves-light btn" href="{{ url('association/register') }}">{{ $editBtn }}</a>
                        {!! Form::button($deleteBtn, array('id' => 'delete-btn', 'class' => 'btn waves-effect waves-light red darken-1', 'onclick' => 'confirmDelete()')) !!}
                    </div>
                    @endif


                    <div class="col s12">
                        <h1 class="h5 association-title">{{ $association->title }}</h1>

                        <div class="initiative-info">
                            @isset($association->address)
                            <span class="valign-wrapper"><i class="material-icons material-icons-custom-size">location_on</i> {{ $association->address }}</span>
                            @endisset

                            <ul>
                                <li class="valign-wrapper">
                                    <span>
                                        @isset($association->phone_1)
                                        <i class="material-icons material-icons-custom-size">local_phone</i> {{ $association->phone_1 }}
                                        @endisset

                                        @isset($association->phone_2)
                                        - {{ $association->phone_2 }}
                                        @endisset
                                    </span>
                                </li>

                                @isset($association->email)
                                <li class="valign-wrapper"><i class="material-icons material-icons-custom-size">email</i> <a href="mailto:{{ $association->email }}" class="assoc-email">{{ $association->email }}</a></li>
                                @endisset

                                @isset($association->website)
                                @if(!preg_match("~^(?:f|ht)tps?://~i", $association->website))
                                <li class="valign-wrapper"><i class="material-icons material-icons-custom-size">link</i> <a href="http://{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                @else
                                <li class="valign-wrapper"><i class="material-icons material-icons-custom-size">link</i> <a href="{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                @endif
                                @endisset
                            </ul>

                        </div>


                        <iframe class="input-map input-map-areaviewer" title="input a location" src="{{ env('AREAVIEWER_URL') }}?domain={{ config('app.url') }}&lat={{ $association->latitude }}&lon={{ $association->longitude }}&zoom=14&state=view&mode=lite"></iframe>


                        @isset($association->description)
                        <div class="initiative-descr">
                            <h4 class="h5"> {{ $heading1 }}</h4>
                            <p>{!! nl2br(e($association->description)) !!}</p>
                        </div>
                        @endisset

                        @if(!empty($association->images))
                        <div class="owl-carousel owl-theme">
                            @foreach ($association->images as $image)
                            <div class="item carousel-item">
                                <a href="{{ env('APP_URL') }}/storage/associations/{{ $image->name }}" data-caption="{{ $association->title }}">
                                    {!! HTML::image('storage/associations/'.$image->name, $association->title, array('class' => '')) !!}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>


                @else
                    <p>{{ $noRecordsMsg }}</p>
                @endif
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('plugins/owl/owl.carousel.min.js') !!}
    {!! HTML::script('plugins/baguettebox/baguetteBox.min.js') !!}
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 5,
                autoWidth:true,
                responsive: {
                    // breakpoint from 0 up
                    0 : {
                        items: 1
                    },
                    // breakpoint from 480 up
                    480 : {
                        items: 2
                    },
                    // breakpoint from 768 up
                    768 : {
                        items: 3
                    }
                    // breakpoint from 1024 up
                    //1024 : {
                    //    items: 4
                    //},
                    // breakpoint from 1200 up
                    //1200 : {
                    //    items: 5
                    //},
                    // breakpoint from 1400 up
                    //1400 : {
                    //    items: 6
                    //}
                }
            });
        });


        baguetteBox.run('.owl-carousel', {});
    </script>
@endsection