<td>
    <form action="{{route($base . '.destroy', ['label' => $item])}}" style="display: inline" method="POST" class="trash-icon">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger">{{$remove_label}}</button>
    </form>
    <a href="{{route($base . '.edit', ['label' => $item])}}" class="btn btn-info" role="button">{{$edit_label}}</a>
    <a href="{{route($base . '.show', ['label' => $item])}}" class="btn btn-default" role="button">{{$show_label}}</a>
</td>