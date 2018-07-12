@if($tags->isNotEmpty())
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Tags</h3>
    </div>

    <div class="panel-body">
        <ul>
            @foreach ($tags as $tag)
            <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif