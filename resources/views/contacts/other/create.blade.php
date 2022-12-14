@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Other Contact</div>
            <div class="panel-body">                  
                <form id='OtherCreateForm' action='{{ route('other.store') }}' method='POST'>                        
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('forms.other')
                    <input type='submit' class='btn btn-primary' value='Save'>  
                </form>	
            </div>
        </div>
    </div>
</div>
                  
    
@endsection