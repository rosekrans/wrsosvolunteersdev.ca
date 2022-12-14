@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <table style='width:100%'>
                    <tr>
                        <td>
                            <h4 class="panel-title" style='width: 50%'  >Volunteer Contacts</h4>
                        </td>
                        <td style='width: 35%; text-align: center'>
                            <input class="panel-title " style='width: 100%' id="filterTable-input" data-type="search" placeholder="Search...">
                        </td>
                        <td  style='width: 15%; text-align: center' >
        					<a href="#" id="contactExport" ><i class="far fa-file-excel fa-lg" aria-hidden="true" ></i> Export Contacts</a>
        				</td>
                        @if(Auth::user()->isAdmin())
                        <td style='width: 15%; text-align: center'>
                            <a class='btn btn-default ' href="{{ route('profile.create') }}" >Add Contact</a>
                        </td>
                        @endif
                    </tr>
                </table>
            </div>

            <div class="panel-body">
                <ul class="nav nav-tabs" id='VolunteerTabs'>
                    <li class="active"><a data-toggle="tab" href="#ActiveTab">Active Volunteers</a></li>
                    <li><a data-toggle="tab" href="#RescueTab" id="RescueClick">Rescue</a></li>
					<li><a data-toggle="tab" href="#TransportTab" id="TransportClick">Transport</a></li>
                    <li><a data-toggle="tab" href="#HotlineTab" id="HotlineClick">Hotline</a></li>
                    @if(Auth::user()->isAdmin())
                        <li><a data-toggle="tab" href="#AdminTab" id="AdminClick">Admin</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div id="ActiveTab" class="tab tab-pane fade in active " style='overflow: auto;'>
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
                                @if($volunteer->status == 1)
                                    <tr id="{{$volunteer->id}}" >
                                    <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                    <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                    <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                    <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                    <td style='vertical-align:middle;'>{{$volunteer['userDetail']->notes}}</td>
                                    <td style='vertical-align:middle;text-align:center; color: red;' data-toggle='tooltip' title='Rabies Vaccinated' data-text={{$volunteer['userDetail']->rabies_vaccine}}>
                                    @if ($volunteer['userDetail']->rabies_vaccine == 1)
                                        <i class="fas fa-syringe fa-lg"></i>
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
                    <div id="RescueTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 10%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Home #</th>
                                <th style="width: 10%; min-width:96px" >Cell #</th>
                                <th style="width: 25%; min-width:192px" >Notes</th>
                                <th style="width: 4%" >Rabies Vaccine</th>
								<th style="width: 4%" >Catch Pole</th>
                                <th style="width: 4%" >Mentor</th>
                                <th style="width: 8%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer['userDetail']['role']->rescue == 1 && $volunteer->status == 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->notes}}</td>
                                        <td style='vertical-align:middle;text-align:center; color: red;' data-toggle='tooltip' title='Rabies Vaccinated' data-text={{$volunteer['userDetail']->rabies_vaccine}}>
                                        @if ($volunteer['userDetail']->rabies_vaccine == 1)
                                            <i class="fas fa-syringe fa-lg"></i>
                                        @endif
                                        </td>
										<td style='vertical-align:middle;text-align:center; color: blue;' data-toggle='tooltip' title='Catch pole trained' data-text={{$volunteer['userDetail']->catch_pole}}>
                                        @if ($volunteer['userDetail']->catch_pole == 1)
                                            <i class="fas fa-book fa-lg"></i>
                                        @endif
                                        </td>
                                        <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Mentor' data-text={{ $volunteer['userDetail']->rescue_mentor }}>
                                        @if ($volunteer['userDetail']->rescue_mentor == 1)
                                            <i class="fas fa-seedling fa-lg"></i>
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
					
					<div id="TransportTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Home #</th>
                                <th style="width: 10%; min-width:96px" >Cell #</th>
                                <th style="width: 20%; min-width:192px" >Notes</th>
                                <th style="width: 5%" >Rabies Vaccine</th>
                                <th style="width: 5%" >Mentor</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer['userDetail']['role']->transport == 1 && $volunteer->status == 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->notes}}</td>
                                        <td style='vertical-align:middle;text-align:center; color: red;' data-toggle='tooltip' title='Rabies Vaccinated' data-text={{$volunteer['userDetail']->rabies_vaccine}}>
                                        @if ($volunteer['userDetail']->rabies_vaccine == 1)
                                            <i class="fas fa-syringe fa-lg"></i>
                                        @endif
                                        </td>
                                        <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Mentor' data-text={{ $volunteer['userDetail']->rescue_mentor }}>
                                        @if ($volunteer['userDetail']->rescue_mentor == 1)
                                            <i class="fas fa-seedling fa-lg"></i>
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
					
                    <div id="HotlineTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Home #</th>
                                <th style="width: 10%; min-width:96px" >Cell #</th>
                                <th style="width: 20%; min-width:192px" >Notes</th>
                                <th style="width: 5%" >Rabies Vaccine</th>
                                <th style="width: 5%" >Mentor</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer['userDetail']['role']->hotline == 1 && $volunteer->status == 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer->email}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->notes}}</td>
                                        <td style='vertical-align:middle;text-align:center; color: red;' data-toggle='tooltip' title='Rabies Vaccinated' data-text={{$volunteer['userDetail']->rabies_vaccine}}>
                                        @if ($volunteer['userDetail']->rabies_vaccine == 1)
                                            <i class="fas fa-syringe fa-lg"></i>
                                        @endif
                                        </td>
                                        <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Mentor' data-text={{ $volunteer['userDetail']->rescue_mentor }}>
                                        @if ($volunteer['userDetail']->hotline_mentor == 1)
                                            <i class="fas fa-seedling fa-lg"></i>
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
                    @if( Auth::user()->isAdmin())
                    <div id="AdminTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Status</th>
                                <th style="width: 10%; min-width:96px" >Home #</th>
                                <th style="width: 10%; min-width:96px" >Cell #</th>
                                <th style="width: 25%; min-width:192px" >Notes</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                    @if($volunteer->status > 1)
                                        <tr id="{{$volunteer->id}}" >
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->first_name . ' ' . $volunteer['userDetail']->last_name}} </td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['userDetail']['location']->location) ? $volunteer['userDetail']['location']->location : '' }}</td>
                                        <td style='vertical-align:middle;'>{{isset($volunteer['statusCode']->status_code) ? $volunteer['statusCode']->status_code : '' }}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->home_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->cell_number}}</td>
                                        <td style='vertical-align:middle;'>{{$volunteer['userDetail']->notes}}</td>
                                        <td style='vertical-align:middle'>
                                            <a href="{{ route('profile.edit', $volunteer->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>
                                            <a href="{{ route('profile.delete', $volunteer->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                        </td>

                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$( function() {

    $('#filterTable-input').keyup(function() {
        var $rows = $('#contactTable tbody tr');
        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;

        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });

    $("#contactExport").on('click', function (event) {
        var activeTab = $("ul#VolunteerTabs li.active a")
        console.log(activeTab[0]);
        var file_name = 'Contact_List_'+ activeTab[0].text +'.csv';
        exportTableToCSV.apply(this, [$(activeTab[0].hash), file_name]);

        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

    $(".tablesorter").tablesorter();
    $('.tablesorter th').mouseenter(function () {
        $(this).css("cursor", "s-resize");
	});
});
</script>


@endsection
