@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Rehabilitator Contact</div>
            <div class="panel-body">     
                <form id='rehabilitatorCreateForm'>
                    @include('forms.rehabilitator')                    
                </form>                              
            </div>
        </div>
    </div>
</div>
                  
    
@endsection