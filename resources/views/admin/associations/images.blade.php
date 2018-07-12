@if($images->isNotEmpty())
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Images</h3>
    </div>

    <div class="panel-body">
        @foreach ($images as $image)
        <a href="{{ $image->url }}" target="_blank">
            {!! HTML::image('storage/associations/'.$image->name, $association->title, array('class' => 'img-rounded', 'style' => 'width: 200px; height: auto;')) !!}
        </a>
        @endforeach
    </div>
</div>
@endif