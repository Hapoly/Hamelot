@if($hasAny)
    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach($cols as $k=>$col)
                    @if($k=='NuLL')
                        <th>{{$col}}</th>
                    @else
                        <th><a href="{{route($route,[$search,'sort' => $k,'page' => $items->currentPage()])}}">{{$col}}</a></th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{$slot}}
        </tbody>
    </table>
@else
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            {{$not_found}}
        </div>
    </div>
@endif