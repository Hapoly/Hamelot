<div class="panel panel-default create-form">
    <h2>{{ $title }}</h2>
    <div class="row">
        <div class="col-md-12">
        <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            {{$slot}}
        </form>
        </div>
    </div>
</div>