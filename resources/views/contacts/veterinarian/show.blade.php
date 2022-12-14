@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Veterinarian Contact</div>
            <div class="panel-body">     
                <form id='veterinarianCreateForm'  method='POST'>
                    @include('forms.veterinarian')                    
                </form>              
                
            </div>
        </div>
    </div>
</div>
                  
    
@endsection