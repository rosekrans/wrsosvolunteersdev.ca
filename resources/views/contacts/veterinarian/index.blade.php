@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <table style='width:100%'>
                    <tr>
                        <td style='width: 70%'>
                            <h4 class="panel-title"  >Veterinarian Contacts</h4>
                        </td>
                        <td  style='width: 15%; text-align: center' >
        					<a href="#" id="contactExport" ><i class="far fa-file-excel fa-lg" aria-hidden="true" ></i> Export Contacts</a>
        				</td>
                        <td style='width: 15%'>
                            @if(Auth::user()->isAdmin())
                                <a class='btn btn-default pull-right' href="{{ route('veterinarian.create') }}" >Add Contact</a>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="panel-body"  style='overflow: auto;'>

                <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" style="width: 100%;" >
                    <thead>
                        <th style="width: 15%">Clinic Name</th>
                        <th style="width: 15%">Contact Name</th>
                        <th style="width: 10%">Location</th>
                        <th style="width: 10%; min-width:96px">Phone Number</th>
                        <th style="width: 40%; min-width:192px">Notes</th>
                        <th colspan="2" style="width: 10%">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($veterinarians as $veterinarian)
                            <tr id="{{$veterinarian->id}}" >
                                <td style='vertical-align:middle;'>{{$veterinarian->clinic_name}} </td>
                                <td style='vertical-align:middle;'>{{$veterinarian->contact_name}}</td>
                                <td style='vertical-align:middle;'>{{isset($veterinarian['location']->location) ? $veterinarian['location']->location : '' }}</td>
                                <td style='vertical-align:middle;'>{{$veterinarian->number}}</td>
                                <td style='vertical-align:middle;'>{{$veterinarian->notes}}</td>
                                @if(Auth::user()->isAdmin())
                                    <td style='vertical-align:middle'>
                                        <a href="{{ route('veterinarian.edit', $veterinarian->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                    </td>
                                    <td style='vertical-align:middle'>
                                        <a href="{{ route('veterinarian.delete', $veterinarian->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                    </td>
                                @else
                                    <td style='vertical-align:middle'>
                                        <a href="{{ route('veterinarian.show', $veterinarian->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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

        var file_name = 'Contact_List_Veterinarians.csv';
        exportTableToCSV.apply(this, [$('#contactTable'), file_name]);

        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});
</script>

@endsection
