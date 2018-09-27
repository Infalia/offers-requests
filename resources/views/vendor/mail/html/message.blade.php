@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot


    {{-- Panel with link --}}
    @slot('panel')
        @component('mail::panel', ['slot' => $panelText])
            {{ $panelText }}
        @endcomponent
    @endslot


    {{-- Body --}}
    {{ $slot }}


    {{-- Button --}}
    @slot('button')
        @component('mail::button', ['url' => $replyUrl, 'slot' => $replyBtn])
            {{ $replyBtn }}
        @endcomponent
    @endslot



    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
