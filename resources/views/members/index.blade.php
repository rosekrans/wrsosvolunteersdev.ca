@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <table style='width:100%'>
                    <tr>
                        <td>
                            <h4 class="panel-title" style='width: 50%'  >Member Contacts</h4>
                        </td>
                        <td style='width: 35%; text-align: center'>
                            <input class="panel-title " style='width: 100%' id="filterTable-input" data-type="search" placeholder="Search...">
                        </td>
                        <td  style='width: 15%; text-align: center' >
        					<a href="#" id="contactExport" ><i class="far fa-file-excel fa-lg" aria-hidden="true" ></i> Export Contacts</a>
        				</td>
                        @if(Auth::user()->isAdmin())
                        <td style='width: 15%; text-align: center'>
                            <a class='btn btn-default ' href="{{ route('membership.create') }}" >Add Member</a>
                        </td>
                        @endif
                    </tr>
                </table>
            </div>

            <div class="panel-body">
                <ul class="nav nav-tabs" id='MemberTabs'>
                    @if(Auth::user()->isAdmin())
                        <li class="active"><a data-toggle="tab" href="#ActiveTab">Active Members</a></li>
                        <li ><a data-toggle="tab" href="#ExpiredTab">Expired Members</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div id="ActiveTab" class="tab tab-pane fade in active " style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="memberTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Primary Contact</th>
                                <th style="width: 10%; min-width:96px" >Expiry Date</th>
                                <th style="width: 10%; min-width:192px" >Last Payment Date</th>
                                <th style="width: 5%; " >Complementary</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                    @if ($member->status == 1 && $member->expire_at > date("Y-m-d") )
                                        <tr id="{{$member->id}}" >
                                            <td style='vertical-align:middle;'>{{$member->first_name . ' ' . $member->last_name}} </td>
                                            <td style='vertical-align:middle;'>{{isset($member['location']->location) ? $member['location']->location : '' }}</td>
                                            <td style='vertical-align:middle;'>{{$member->email}}</td>
                                            <td style='vertical-align:middle;'>{{$member->phone_number}}</td>
                                            <td style='vertical-align:middle;'>{{$member->expire_at}}</td>
                                            <td style='vertical-align:middle;'>{{$member->payment_at}}</td>
                                            @if ($member->complementary == 1)
                                                <td style='vertical-align:middle;'><p>Yes</p></td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if(Auth::user()->isAdmin())
                                                <td style='vertical-align:middle'>
                                                    <a href="{{ route('membership.edit', $member->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                                </td>
                                                <td style='vertical-align:middle'>
                                                    <a href="{{ route('membership.delete', $member->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Cancel Membership'   ><i class='fas fa-times fa-lg' ></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="ExpiredTab" class="tab tab-pane fade in " style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="memberTable" sytle='width:200vw' >
                            <thead>
                                <th style="width: 15%" >Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 15%" >Email</th>
                                <th style="width: 10%; min-width:96px" >Primary Contact</th>
                                <th style="width: 10%; min-width:96px" >Expiry Date</th>
                                <th style="width: 10%; min-width:192px" >Last Payment Date</th>
                                <th style="width: 5%;" >Complementary</th>
                                <th style="width: 10%" colspan="2">Actions </th>
                            </thead>
                            <tbody>

                                @foreach($members as $member)

                                @if ($member->expire_at < date("Y-m-d"))
                                    <tr id="{{$member->id}}" >
                                    <td style='vertical-align:middle;'>{{$member->first_name . ' ' . $member->last_name}} </td>
                                    <td style='vertical-align:middle;'>{{isset($member['location']->location) ? $member['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{$member->email}}</td>
                                    <td style='vertical-align:middle;'>{{$member->phone_number}}</td>
                                    <td style='vertical-align:middle;'>{{$member->expire_at}}</td>
                                    <td style='vertical-align:middle;'>{{$member->payment_at}}</td>
                                    @if ($member->complementary == 1)
                                        <td style='vertical-align:middle;'><p>Yes</p></td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(Auth::user()->isAdmin())
                                        <td style='vertical-align:middle'>
                                            <a href="{{ route('membership.edit', $member->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>
                                            <a href="{{ route('membership.delete', $member->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
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

    $('#filterTable-input').keyup(function() {
        var $rows = $('#memberTable tbody tr');
        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;

        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });

    $("#contactExport").on('click', function (event) {
        var activeTab = $("ul#MemberTabs li.active a")
        var file_name = 'Member_List_'+ activeTab[0].text +'.csv';
        exportTableToCSV.apply(this, [$(activeTab[0].hash), file_name]);
    });

    $(".tablesorter").tablesorter();
    $('.tablesorter th').mouseenter(function () {
        $(this).css("cursor", "s-resize");
	});
});
</script>


@endsection
