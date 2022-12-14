@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>

            <div class="panel-body">
                <ul class="nav nav-tabs" id='profileTabs'>
                    <li class="active"><a data-toggle="tab" href="#ContactTab">Contact Info</a></li> 
                    @if (Auth::user()->isAdmin())
                        <li><a data-toggle="tab" href="#AdminTab" >Admin</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div id="ContactTab" class="tab tab-pane fade in active">
                        <form id='contactInfo' action='{{ route('profile.store') }}' method='POST'>                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @include('forms.profile')
                            <input type='submit' class='btn btn-primary' value='Save'>  
                        <!-- </form>	 -->
                    </div>
                    @if (Auth::user()->isAdmin())
                        <div id="AdminTab" class="tab tab-pane fade " >
                            <!-- <form id='adminForm' action="{{ route('profile.store') }}" method='POST'>                            -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @include('forms.admin')    
                                <input type='submit' class='btn btn-primary' value='Save'>                         
                            </form>
                        </div>	
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
                  
    
@endsection