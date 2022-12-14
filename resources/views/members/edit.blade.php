@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-xs-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Member Profile</div>

            <div class="panel-body">
                <div id="Membership" >
                    <form id='contactInfo' action='{{ route('membership.update', $member->id) }}' method='POST'>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('forms.member')
                        <input type='submit' class='btn btn-primary' value='Save'>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
