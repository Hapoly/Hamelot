<div class="panel panel-default">
    <h2>{{ $title }}</h2>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                @csrf
                {{$slot}}
            </form>
        </div>
    </div>
</div>