<a href="{{route($base . '.destroy', ['label' => $item])}}" class="btn btn-danger" role="button">{{$remove_label}}</a>
<a href="{{route($base . '.edit', ['label' => $item])}}" class="btn btn-info" role="button">{{$edit_label}}</a>
<a href="{{route($base . '.show', ['label' => $item])}}" class="btn btn-default" role="button">{{$show_label}}</a>