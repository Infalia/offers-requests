@extends('layouts.app')


@section('content')
    <div class="content">
        {{-- <div class="container"> --}}
            <div class="associations">
                <div class="row">
                    <div class="col m8">

                        @if($isAssociation)
                        <div class="action-buttons right-align">
                            <a href="{{ url('/association/register') }}" class="btn waves-effect waves-light"><i class="material-icons left">{{ $registerIcon }}</i>{{ $registerBtn }}</a>
                        </div>
                        @endif


                        @if(!$isAssociation)
                        <div class="card light-blue darken-3">
                            <div class="card-content white-text">
                                <h5>{{ $heading4 }}</h5>
                                <span>{{ $message1 }}</span>
                            </div>

                            <div class="card-action">
                                <a class="white-text" href="{{ url(env('UWUM_REGISTER_ASSOC_URL')) }}">{{ $registerBtn }}</a>
                            </div>
                        </div>
                        @endif


                        @if(!empty($featuredAssociations))
                            @foreach($featuredAssociations as $association)
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col m4 push-m8 l3 push-l9 xl2 push-xl10">
                                            @if($association->images->isNotEmpty())
                                            <div class="card-image">
                                            {!! HTML::image('storage/associations/'.$association->images->first()->name, $association->title, array('class' => 'responsive-img')) !!}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="col m8 pull-m4 l9 pull-l3 xl10 pull-xl2">
                                            <a href="{{ url('association/'.$association->id.'/'.str_slug($association->title)) }}">
                                                <span class="card-title">{{ $association->title }}</span>
                                            </a>

                                            @isset($association->address)
                                            <span class="card-post-address">{{ $association->address }}</span>
                                            @endisset

                                            <div class="card-post-tags">
                                                <div class="chip teal lighten-2 white-text">{{ $heading3 }}</div>
                                            </div>

                                            <div class="card-assoc-contacts">
                                                <ul>
                                                    <li class="card-assoc-contact">
                                                        <span class="assoc-phone">
                                                            @isset($association->phone_1)
                                                            {{ $association->phone_1 }}
                                                            @endisset

                                                            @isset($association->phone_2)
                                                            <br>{{ $association->phone_2 }}
                                                            @endisset
                                                        </span>
                                                    </li>

                                                    @isset($association->email)
                                                    <li class="card-assoc-contact"><a href="mailto:{{ $association->email }}" class="assoc-email">{{ $association->email }}</a></li>
                                                    @endisset

                                                    @isset($association->website)
                                                    @if(!preg_match("~^(?:f|ht)tps?://~i", $association->website))
                                                    <li class="card-assoc-contact"><a href="http://{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                    @else
                                                    <li class="card-assoc-contact"><a href="{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                    @endif
                                                    @endisset
                                                </ul>
                                            </div>

                                            @if(!empty($association->tags))
                                            <div class="card-assoc-contacts card-assoc-tags">
                                                @foreach ($association->tags as $tag)
                                                <div class="chip">{{ $tag->name }}</div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>


                                    {{-- <div class="right-align">
                                        <a class="waves-effect waves-light btn" href="{{ url('association/'.$association->id.'/'.str_slug($association->title)) }}">{{ $detailsBtn }}</a>
                                    </div> --}}
                                </div>


                                <div class="card-action card-assoc-related teal accent-4 white-text"><i class="material-icons left blue-grey-text text-darken-2">info</i>{{ $message2 }}</div>

                                @isset($association->description)
                                <div class="card-action card-assoc-description grey lighten-3">{!! str_limit($association->description, 300) !!}</div>
                                @endisset
                            </div>
                            @endforeach
                        @endif



                        @if(!empty($associations))

                            @foreach($associations as $association)
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col m4 push-m8 l3 push-l9 xl2 push-xl10">
                                            @if($association->images->isNotEmpty())
                                            <div class="card-image">
                                            {!! HTML::image('storage/associations/'.$association->images->first()->name, $association->title, array('class' => 'responsive-img')) !!}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="col m8 pull-m4 l9 pull-l3 xl10 pull-xl2">
                                            <a href="{{ url('association/'.$association->id.'/'.str_slug($association->title)) }}">
                                                <span class="card-title">{{ $association->title }}</span>
                                            </a>

                                            @isset($association->address)
                                            <span class="card-post-address">{{ $association->address }}</span>
                                            @endisset

                                            <div class="card-assoc-contacts">
                                                <ul>
                                                    <li class="card-assoc-contact">
                                                        <span class="assoc-phone">
                                                            @isset($association->phone_1)
                                                            {{ $association->phone_1 }}
                                                            @endisset

                                                            @isset($association->phone_2)
                                                            <br>{{ $association->phone_2 }}
                                                            @endisset
                                                        </span>
                                                    </li>

                                                    @isset($association->email)
                                                    <li class="card-assoc-contact"><a href="mailto:{{ $association->email }}" class="assoc-email">{{ $association->email }}</a></li>
                                                    @endisset

                                                    @isset($association->website)
                                                    @if(!preg_match("~^(?:f|ht)tps?://~i", $association->website))
                                                    <li class="card-assoc-contact"><a href="http://{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                    @else
                                                    <li class="card-assoc-contact"><a href="{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                    @endif
                                                    @endisset
                                                </ul>
                                            </div>

                                            @if(!empty($association->tags))
                                            <div class="card-assoc-contacts card-assoc-tags">
                                                @foreach ($association->tags as $tag)
                                                <div class="chip">{{ $tag->name }}</div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>


                                    {{-- <div class="right-align">
                                        <a class="waves-effect waves-light btn" href="{{ url('association/'.$association->id.'/'.str_slug($association->title)) }}">{{ $detailsBtn }}</a>
                                    </div> --}}
                                </div>

                                @isset($association->description)
                                <div class="card-action card-assoc-description">{!! str_limit($association->description, 300) !!}</div>
                                @endisset
                            </div>
                            @endforeach

                        @else
                            <p>{{ $noRecordsMsg }}</p>
                        @endif
                    </div>

                    <iframe class="col m4 input-map" title="input a location" src="{{ env('AREAVIEWER_URL') }}?domain={{ config('app.url') }}&zoom=14&contrast=false"></iframe>
                </div>

                {{ $associations->links('vendor.pagination.default') }}

            </div>
        {{-- </div> --}}

    </div>
@endsection
