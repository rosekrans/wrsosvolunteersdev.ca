@if (session('status'))
    @if(session('statusCode') == 0)
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif(session('statusCode') == 1)
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @else
        <div class="alert alert-info" style='font-size:16px'>
            {{ session('status') }}

        </div>
    @endif
@endif
@if (count($errors->all()))
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
