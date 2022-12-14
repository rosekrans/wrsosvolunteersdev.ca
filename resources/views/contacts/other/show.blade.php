@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Other Contact</div>
            <div class="panel-body">     
                <form id='otherShowForm'>
                    @include('forms.other')                    
                </form>                              
            </div>
        </div>
    </div>
</div>
                  
    
@endsection