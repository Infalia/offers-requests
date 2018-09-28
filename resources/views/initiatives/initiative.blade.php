@extends('layouts.app')

@section('csslibs')
    {!! HTML::style('plugins/owl/assets/owl.carousel.min.css') !!}
    {!! HTML::style('plugins/owl/assets/owl.theme.green.min.css') !!}
    {!! HTML::style('plugins/baguettebox/baguetteBox.min.css') !!}
    {!! HTML::style('plugins/jquery-comments/jquery-comments.css') !!}
    {{-- {!! HTML::style('plugins/leaflet/leaflet.css') !!} --}}
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="initiative">
                @if(!empty($initiative))
                
                <div class="row">
                    <div class="action-buttons">
                        <div class="row">
                            <div class="col s6">
                                <a class="waves-effect waves-light btn grey darken-1" href="{{ url('offers') }}"><i class="material-icons left">arrow_back</i>{{ $backBtn }}</a>
                            </div>

                            @if(Auth::check() && Auth::id() == $initiative->user->id)
                            <div class="col s6 right-align">
                                <a class="waves-effect waves-light btn" href="{{ url('offer/edit/'.$initiative->id.'/'.str_slug($initiative->title)) }}"><i class="material-icons left">edit</i>{{ $editBtn }}</a>
                                {!! Form::button('<i class="material-icons left">delete</i>'.$deleteBtn, array('id' => 'delete-btn', 'class' => 'btn waves-effect waves-light red darken-1', 'onclick' => 'confirmDelete()')) !!}
                            </div>
                            @endif
                        </div>
                    </div>



                    <div class="col s12 l6">
                        <h1 class="h5 initiative-title">{{ $initiative->title }}</h1>

                        <div class="initiative-info">
                            <span class="initiative-created grey-text text-darken-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->created_at)->diffForHumans() }}</span>
                            <span>- by {{ $initiative->user->name }}</span>
                        </div>

                        <p>
                            @if(1 == $initiative->initiativeType->id)
                            <div class="chip green accent-4 white-text">{{ $initiative->initiativeType->name }}</div>
                            @else
                            <div class="chip light-blue white-text">{{ $initiative->initiativeType->name }}</div>
                            @endif

                            @if(\Carbon\Carbon::now()->lt(Carbon\Carbon::parse($initiative->end_date)) && 1 >= $diffLength)
                            <div class="chip chip-ends red accent-4 white-text">{{ $message2 }}</div>
                            @endif
                        </p>

                        <div class="initiative-info">
                            @isset($initiative->start_date)
                            <span class="initiative-start-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date)->format('l, j M Y H:i') }}</span>
                            @endisset
                            
                            @isset($initiative->address)
                            <span class="initiative-address">{{ $initiative->address }}</span>
                            @endisset

                            <br>

                            @if(!empty($initiative->tags))
                            <div class="tags">
                                @foreach ($initiative->tags as $tag)
                                <div class="chip">{{ $tag->name }}</div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        @isset($initiative->description)
                        <div class="initiative-descr">
                            <h3 class="h5">{{ $heading1 }}</h3>
                            <p>{!! nl2br(e($initiative->description)) !!}</p>
                        </div>
                        @endisset

                        @if(!empty($initiative->images))
                        <div class="owl-carousel owl-theme">
                            @foreach ($initiative->images as $image)
                            <div class="item carousel-item">
                                <a href="{{ env('APP_URL') }}/storage/initiatives/{{ $image->name }}" data-caption="{{ $initiative->title }}">
                                    {!! HTML::image('storage/initiatives/'.$image->name, $initiative->title, array('class' => '')) !!}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @endif


                        @if(Auth::check() && Auth::id() != $initiative->user_id && \Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($initiative->end_date)))
                        <div class="action-buttons">
                            {!! Form::button('<i class="material-icons left">email</i>'.$contactBtn, array('id' => 'contact-btn', 'class' => 'btn waves-effect waves-light light-blue darken-4 modal-trigger', 'data-target' => 'contact-modal')) !!}
                        </div>

                        <!-- Modal Structure -->
                        <div id="contact-modal" class="modal">
                            <div class="modal-content">
                                <h4 class="h5">{{ $contactFormHeading1 }}</h4>
                                <br><br>

                                <div class="input-field">
                                    {!! Form::textarea('message', '', ['id' => 'message', 'class' => 'materialize-textarea', 'placeholder' => $contactFormMessagePldr]) !!}
                                    {!! Form::label('message', $contactFormMessageLbl, ['class' => 'active']) !!}
                                </div>
                            </div>

                            <div class="modal-footer">
                                {!! Form::button('<i class="material-icons left">send</i>'.$contactFormSendBtn, array('id' => 'send-btn', 'class' => 'waves-effect waves-light btn')) !!}
                            </div>
                        </div>

                        @endif
                    </div>

                    <div class="col s12 l6">
                        <iframe class="input-map" title="input a location" src="{{ env('INPUTMAP_URL') }}?domain={{ config('app.url') }}&lat={{ $initiative->latitude }}&lon={{ $initiative->longitude }}&zoom=14&state=view&mode=lite"></iframe>
                    </div>
                </div>


                <div class="initiative-engagements">
                    <span class="initiative-engagement"><i class="material-icons tiny inline-icon grey-text text-darken-3">comment</i> {{ $comments = $initiative->comments->count() }} {{ $comments == 1 ? $commentSingularLbl : $commentPluralLbl }}</span>
                </div>

                <div class="divider"></div>

                <div class="comments-container"></div>
                

                @else
                    <p>{{ $noRecordsMsg }}</p>
                @endif
            </div>
        </div>


        <div class="loader-overlay">
            <div class="loader">
                <div class="loader-inner line-scale-pulse-out-rapid">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('plugins/owl/owl.carousel.min.js') !!}
    {!! HTML::script('plugins/baguettebox/baguetteBox.min.js') !!}
    {!! HTML::script('plugins/jquery-comments/jquery-comments.min.js') !!}

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


        $(document).ready(function() {
            $('.modal').modal();
        });


        $('.comments-container').comments({
            profilePictureURL: "{{ $userImg }}",
            spinnerIconURL: "{{ url('/') }}/images/loader.gif",
            textareaPlaceholderText: '{{ $commentAddPldr }}',
            sendText: '{{ $commentAddBtn }}',
            replyText: '{{ $commentReplyBtn }}',
            viewAllRepliesText: '{{ $commentViewRepliesBtn }}',
            hideRepliesText: '{{ $commentHideRepliesBtn }}',
            noCommentsText: '{{ $noCommentsMsg }}',
            enableEditing: false,
            enableUpvoting: false,
            enableDeleting: false,
            enableDeletingCommentWithReplies: false,
            enableNavigation: false,
            postCommentOnEnter: true,
            maxRepliesVisible: 10,
            fieldMappings: {
                id: 'id',
                parent: 'parent_id',
                created: 'created_at',
                modified: 'updated_at',
                content: 'body',
                fullname: 'user_fullname'
            },
            getComments: function(success, error) {
                $.ajax({
                    type: "get",
                    url: "{{ url('offer/comments') }}?init_id={{ $initiativeId }}",
                    success: function(commentsArray) {
                        success(commentsArray)
                    },
                    error: error
                });
            },
            postComment: function(commentJSON, success, error) {
                $.ajax({
                    type: "post",
                    url: "{{ url('offer/save/comment') }}?init_id={{ $initiativeId }}",
                    data: commentJSON,
                    success: function(comment) {
                        success(commentJSON)
                        $('#init-comments').html(comment.total_comments);
                        
                        $.post("{{ url('offer/ontomap/comment') }}", { 'initId': comment.initId, 'commentId': comment.commentId }, function(response){});
                    },
                    error: error
                });
            }
            <?php if(!Auth::check()) { ?>
            ,
            refresh: function() {
                $('div.commenting-field').remove();
            },
            enableReplying: false
            <?php } ?>
        });


        $(document).on("click", "#send-btn", function(e) {
            data = new Object();
            var btn = $(this);
            btn.addClass('disabled');

            data['message'] = $('#message').val();
            

            var url = "{{ url('offer/send-message/'.$initiative->id.'/'.$initiative->user->id) }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    if((data.errors)) {
                        var errorCount = 0;

                        $.each(data.errors, function(key, value) {
                            if(0 == errorCount) {
                                Materialize.toast(value, 5000, 'red darken-1')
                            }

                            errorCount++;
                        })

                        btn.removeClass('disabled');
                    }
                    else {
                        Materialize.toast('<?php echo $contactMailSuccess; ?>', 5000, 'green darken-1')
                        $('#contact-modal').modal('close');
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });


        


        function confirmDelete() {
            if(confirm('{{ $deleteConfirmMsg }}')) {
                data = new Object();

                data['initiative_id'] = {{ $initiativeId }};
                

                var url = "{{ url('offer/delete/'.$initiative->id) }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        $('.loader-overlay').fadeIn(0);

                        $.post("{{ url('offer/delete/ontomap/'.$initiative->id) }}", {}, function(response){});

                        setTimeout(function() {
                            window.location.href = "{{ url('offers') }}";
                        }, 2500);
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {}
                });
            }
        }
    </script>
@endsection
