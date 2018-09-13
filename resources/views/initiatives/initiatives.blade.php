@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="initiatives">

            <div class="row">
                <div class="col m8">
                    <div class="row">
                        @if(Auth::check())
                        <div class="col s12 action-buttons right-align">
                            <a class="waves-effect waves-light btn" href="{{ url('offer/new') }}"><i class="material-icons left">add</i> {{ $postBtn }}</a>
                        </div>
                        @endif


                        <div class="col s12 l6 xl4">
                            <div class="card">
                                
                                <div class="card-image">
                                    <a href="{{ url('offer/new') }}">
                                        {!! HTML::image('images/icon-plus.png', '', array('class' => '')) !!}
                                    </a>
                                </div>
                                

                                <div class="card-content">
                                    <h5 class="initiative-title">
                                        <a href="{{ url('offer/new') }}">{{ $heading1 }}</a>
                                    </h5>

                                    <div class="initiative-info">{{ $message1 }}</div>

                                    <div class="initiative-info"></div>
                                </div>


                                <div class="card-action card-action-footer">
                                    <a href="{{ url('offer/new') }}">{{ $offerFormBtn }}</a>
                                </div>
                            </div>
                        </div>



                        @forelse($initiatives as $initiative)
                        <div class="col s12 l6 xl4">
                            <div class="card">
                                
                                <div class="card-image">
                                    <a href="{{ url('offer/'.$initiative->id.'/'.str_slug($initiative->title)) }}">
                                        @if($initiative->images->isNotEmpty())
                                        {!! HTML::image('storage/initiatives/'.$initiative->images->first()->name, $initiative->title, array('class' => '')) !!}
                                        @else
                                        {!! HTML::image('images/placeholder.png', $initiative->title, array('class' => '')) !!}
                                        @endif
                                    </a>

                                    @if(Auth::check() && Auth::id() == $initiative->user->id)
                                    <a class="waves-effect waves-light btn" href="{{ url('offer/edit/'.$initiative->id.'/'.str_slug($initiative->title)) }}"><i class="material-icons left">mode_edit</i> {{ $editBtn }}</a>
                                    @endif

                                    @if(1 == $initiative->initiativeType->id)
                                    <div class="chip chip-type green accent-4 white-text">{{ $initiative->initiativeType->name }}</div>
                                    @else
                                    <div class="chip chip-type light-blue white-text">{{ $initiative->initiativeType->name }}</div>
                                    @endif

                                    @php
                                        $endDate = \Carbon\Carbon::parse($initiative->end_date);
                                        $now = \Carbon\Carbon::now();
                                        $diffLength = $endDate->diffInDays($now);
                                    @endphp

                                    @if(1 >= $diffLength)
                                    <div class="chip chip-ends red accent-4 white-text">{{ $message2 }}</div>
                                    @endif
                                </div>
                                

                                <div class="card-content">
                                    <h5 class="initiative-title">
                                        <a href="{{ url('offer/'.$initiative->id.'/'.str_slug($initiative->title)) }}">{{ $initiative->title }}</a>
                                    </h5>

                                    <div class="initiative-info">
                                        <span class="initiative-created grey-text text-darken-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date)->diffForHumans() }}</span>
                                        <span>- by {{ $initiative->user->name }}</span>
                                    </div>

                                    <div class="initiative-info">
                                        @isset($initiative->start_date)
                                        <span class="initiative-start-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->end_date)->format('l, j M Y H:i') }}</span>
                                        @endisset
                                    </div>
                                </div>


                                <div class="card-action card-action-footer">
                                    <span class="initiative-engagement"><i class="material-icons tiny inline-icon grey-text text-darken-3">comment</i> {{ $comments = $initiative->comments->count() }} {{ $comments == 1 ? $commentSingularLbl : $commentPluralLbl }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col s12 xl10 offset-xl1">
                            <p>{{ $noRecordsMsg }}</p>
                        </div>
                        @endforelse

                    </div>
                </div>

                <iframe class="col m4 input-map" title="input a location" src="{{ env('AREAVIEWER_URL') }}?domain={{ config('app.url') }}&zoom=14&contrast=false"></iframe>
            </div>
        </div>
    </div>
@endsection

@section('jslibs')
    {{-- <script src="plugins/image-load/imagesloaded.pkgd.min.js"></script>
    <script src="plugins/masonry/masonry.pkgd.min.js"></script>
    <script>
        // Masonry settings
        var $container = $('.masonry-cols');

        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.masonry-col'
            });
        });
    </script> --}}
@endsection
