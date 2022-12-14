@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <table style='width:100%'>
                    <tr>
                        <td style='width: 70%'>
                            <h4 class="panel-title"  >Rehabilitator Contacts</h4>
                        </td>
                        <td  style='width: 15%; text-align: center' >
        					<a href="#" id="contactExport" ><i class="far fa-file-excel fa-lg" aria-hidden="true" ></i> Export Contacts</a>
        				</td>
                        <td style='width: 15%' >
                            @if(Auth::user()->isAdmin())
                                <a class='btn btn-default pull-right' href="{{ route('rehabilitator.create') }}" >Add Contact</a>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="panel-body" style='overflow: auto;'>

                <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" style="width: 100%;" >
                    <thead>
                        <th style="width: 25%">Center Name</th>
                        <th style="width: 15%">Contact Name</th>
                        <th style="width: 10%; min-width:96px">Number</th>
                        <th style="width: 10%">Location</th>
                        <th style="width: 25%; min-width:192px">Species Notes</th>
                        <th colspan="2" style="width: 10%">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($rehabilitators as $rehabilitator)
							@if($rehabilitator->inactive == 0)
								<tr id="{{$rehabilitator->id}}" >
                                <td style='vertical-align:middle;'>{{$rehabilitator->center_name}} </td>
                                <td style='vertical-align:middle;'>{{$rehabilitator->contact_name}} </td>
                                <td style='vertical-align:middle;'>{{$rehabilitator->number}}</td>
                                <td style='vertical-align:middle;'>{{isset($rehabilitator['location']->location) ? $rehabilitator['location']->location : '' }}</td>
                                <td style='vertical-align:middle;'>{{$rehabilitator->species_notes}}</td>
                                @if(Auth::user()->isAdmin())
                                    <td style='vertical-align:middle'>
                                        <a href="{{ route('rehabilitator.edit', $rehabilitator->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                    </td>
                                    <td style='vertical-align:middle'>
                                        <a href="{{ route('rehabilitator.delete', $rehabilitator->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                    </td>
                                @else
                                    <td style='vertical-align:middle'>
                                        <a href="{{ route('rehabilitator.show', $rehabilitator->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
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
<script>
$( function() {
    $(".tablesorter").tablesorter();
    $('.tablesorter th').mouseenter(function () {
        $(this).css("cursor", "s-resize");
	});

    $("#contactExport").on('click', function (event) {

        var file_name = 'Contact_List_Rehabilitators.csv';
        exportTableToCSV.apply(this, [$('#contactTable'), file_name]);

        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});
</script>

@endsection
