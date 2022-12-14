@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <table style='width:100%'>
                    <tr>
                        <td style='width: 70%'>
                            <h4 class="panel-title"  >Administrative Contacts</h4>
                        </td>
                        <td  style='width: 15%; text-align: center' >
        					<a href="#" id="contactExport" ><i class="far fa-file-excel fa-lg" aria-hidden="true" ></i> Export Contacts</a>
        				</td>
                        <td style='width: 15%'>
                            @if(Auth::user()->isAdmin())
                                <a class='btn btn-default pull-right' href="{{ route('profile.create') }}" >Add Contact</a>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="panel-body" >
                <ul class="nav nav-tabs" id='AdminTabs'>
                    <li class="active"><a data-toggle="tab" href="#BoardTab">Board Members</a></li>
                    <li><a data-toggle="tab" href="#ManagementTab" id="ManagementClick">Management Committee</a></li>
                    <li><a data-toggle="tab" href="#EventTab" id="EventClick">Event Volunteers</a></li>
                    <li><a data-toggle="tab" href="#FundraisingTab" id="FundraisingClick">Fundraising Volunteers</a></li>
                </ul>
                <div class="tab-content">
                    <div id="BoardTab" class="tab tab-pane fade in active" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Home #</th>
                                <th style="width: 10%; min-width:96px" >Cell #</th>
                                <th style="width: 25%" >Positions</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer['userDetail']['role']->board == 1 && $volunteer->status == 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->board_position}}</td>

                                        @if(Auth::user()->isAdmin())
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.edit', $volunteer->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                            </td>
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.delete', $volunteer->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                            </td>
                                        @else
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.show', $volunteer->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                            </td>
                                        @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="ManagementTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Home #</th>
                                <th style="width: 10%; min-width:96px" >Cell #</th>
                                <th style="width: 25%" >Position</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer['userDetail']['role']->management == 1 && $volunteer->status == 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->management_position}}</td>
                                        @if(Auth::user()->isAdmin())
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.edit', $volunteer->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                            </td>
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.delete', $volunteer->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                            </td>
                                        @else
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.show', $volunteer->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                            </td>
                                        @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="EventTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Home Contact</th>
                                <th style="width: 10%; min-width:96px" >Cell Contact</th>
                                <th style="width: 25%; min-width:192px" >Notes</th>
                                <th style="width: 5%" >Rabies Vaccine</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer['userDetail']['role']->event == 1 && $volunteer->status == 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->notes}}</td>
                                        <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Rabies Vaccinated'>
                                        @if ($volunteer['userDetail']->rabies_vaccine == 1)
                                            <i class="fas fa-check fa-lg"></i>
                                        @endif
                                        </td>
                                        @if(Auth::user()->isAdmin())
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.edit', $volunteer->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                            </td>
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.delete', $volunteer->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                            </td>
                                        @else
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.show', $volunteer->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                            </td>
                                        @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="FundraisingTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Home #</th>
                                <th style="width: 10%; min-width:96px" >Cell #</th>
                                <th style="width: 25%; min-width:192px" >Notes</th>
                                <th style="width: 5%" >Rabies Vaccine</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer['userDetail']['role']->fundraising == 1 && $volunteer->status == 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->notes}}</td>
                                        <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Rabies Vaccinated'>
                                        @if ($volunteer['userDetail']->rabies_vaccine == 1)
                                            <i class="fas fa-check fa-lg"></i>
                                        @endif
                                        </td>
                                        @if(Auth::user()->isAdmin())
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.edit', $volunteer->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                            </td>
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.delete', $volunteer->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                            </td>
                                        @else
                                            <td style='vertical-align:middle'>
                                                <a href="{{ route('profile.show', $volunteer->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                            </td>
                                        @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$( function() {
    $(".tablesorter").tablesorter();
    $('.tablesorter th').mouseenter(function () {
        $(this).css("cursor", "s-resize");
	});

    $("#contactExport").on('click', function (event) {
        var activeTab = $("ul#AdminTabs li.active a")
        console.log(activeTab[0]);
        var file_name = 'Contact_List_'+ activeTab[0].text +'.csv';
        exportTableToCSV.apply(this, [$(activeTab[0].hash), file_name]);

        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});
</script>


@endsection
