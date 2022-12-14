@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Call Log</div>

            <div class="panel-body">
                <form id='call_log' action='{{ route('call_log.update', $call_log->id) }}' method='POST'>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('forms.call_log')
                    <input type='submit' class='btn btn-primary' value='Save'>                       
                </form>
            </div>
        </div>
    </div>
</div>
                  
    
@endsection