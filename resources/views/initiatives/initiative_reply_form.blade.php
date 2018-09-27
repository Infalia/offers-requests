@extends('layouts.app')


@section('content')
    <div class="content">
        <div class="container">
            @if(Auth::check() && \Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($initiative->end_date)))

            {!! Form::open(['id' => 'initiative-form']) !!}
                <h1 class="h5">{!! $contactFormHeading1 !!}</h1>
                <br><br>

                <h2 class="h6">{{ $contactFormHeading2 }}</h2>
                <br><br>

                <div class="input-field">
                    {!! Form::textarea('message', '', ['id' => 'message', 'class' => 'materialize-textarea', 'placeholder' => $contactFormMessagePldr]) !!}
                    {!! Form::label('message', $contactFormMessageLbl, ['class' => 'active']) !!}
                </div>

                {!! Form::button('<i class="material-icons left">send</i>'.$contactFormSendBtn, array('id' => 'send-btn', 'class' => 'waves-effect waves-light btn')) !!}
            {!! Form::close() !!}

            <div class="row">
                <div class="col s12">
                    <div id="response" class="hide">
                        <div id="response-msg" class="center-align"></div>
                    </div>
                </div>
            </div>

            @else
            <p>{{ $noRecordsMsg }}</p>
            @endif
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
    <script>
        $(document).on("click", "#send-btn", function(e) {
            data = new Object();
            var btn = $(this);
            btn.addClass('disabled');

            data['message'] = $('#message').val();
            

            var url = "{{ url('offer/send-message/'.$initiative->id.'/'.$sender->id) }}";

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
                        $('#initiative-form').fadeOut(0);
                        $('.loader-overlay').fadeIn(0);

                        setTimeout(function() {
                            $('#response').removeClass('hide');
                            $('#response-msg').text('<?php echo $contactMailSuccess; ?>');
                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });
    </script>
@endsection
