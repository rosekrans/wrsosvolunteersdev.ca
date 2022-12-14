@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-xs-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>

            <div class="panel-body">
                <ul class="nav nav-tabs" id='profileTabs'>
                    <li class="active"><a data-toggle="tab" href="#ContactTab">Contact Info</a></li>
                    <li><a data-toggle="tab" href="#AvailabilityTab" id="AvailabilityClick">Availability</a></li>                    
                    @if (Auth::user()->isAdmin())
                        <li><a data-toggle="tab" href="#AdminTab" >Admin</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div id="ContactTab" class="tab tab-pane fade in active">
                        <form id='contactInfo' action='{{ route('profile.update', $user->id) }}' method='POST'>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @include('forms.profile')
                            <input type='submit' class='btn btn-primary' value='Save'>
                    </div>
                     @if (Auth::user()->isAdmin())
                        <div id="AdminTab" class="tab tab-pane fade " >
                                @include('forms.admin')
                                <input type='submit' class='btn btn-primary' value='Save'>
                        </form>
                        </div>
                    @else
                        </form>
                    @endif
                    <div id="AvailabilityTab" class="tab tab-pane fade">
                        <form id='availabilityForm' action='{{ route('schedule.update', $user['userDetail']->id) }}' method='POST'>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @include('forms.availability')
                        </form>
                    </div>                    

                </div>

            </div>
        </div>
    </div>
</div>


@endsection
