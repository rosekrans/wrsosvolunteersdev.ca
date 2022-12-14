@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-xs-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>

            <div class="panel-body">
                <ul class="nav nav-tabs" id='profileTabs'>
                    <li class="active"><a data-toggle="tab" href="#ContactTab">Contact Info</a></li>                    
                </ul>
                <div class="tab-content">
                    <div id="ContactTab" class="tab tab-pane fade in active">
                        <form id='contactInfo'>
                            @include('forms.profile')
                        </form> 
                    </div>

                    <div id="StatsTab" class="tab tab-pane fade">
                        
                    </div>
                   
                </div>
                
            </div>
        </div>
    </div>
</div>
                  
    
@endsection