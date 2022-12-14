@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                     <table style='width:100%'>
                        <tr>
                            <td>
                                <h4 class="panel-title"  >
                                    <a data-toggle="collapse" href="#dashboardDiv"  >Dashboard</a>
                                </h4>
                            </td>                            
                        </tr>
                    </table>
                    
                </div>
                <div id="dashboardDiv" class="panel-collapse collapse">
                    <div class="panel-body">Coming Soon!</div>
                    
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <table style='width:100%'>
                        <tr>
                            <td style='width: 45%' >
                                <h4 class="panel-title"  >
                                    <a data-toggle="collapse" href="#callLogDiv"  >Call Log</a>
                                </h4>
                            </td>
                            <td style='width: 30%' align="right">
                                <input class="panel-title form-control" style='width: 100%' data-toggle='tooltip' title='Search within Displayed Records' id="filterTable-input" data-type="search" placeholder=" Search...">
                            </td>
                            <td style='width: 5%' align="center"><h5>Show: </h5></td>                                
                            <td style='width: 10%' align="right">                                
                                <input class="panel-title form-control " style='width: 100%' data-toggle='tooltip' title='Number of Records to Display' id="recordCount" name="recordCount" type="number" value="{{$recordCount}}">
                            </td>
                            <td style='width: 10%'  >
                                <a class='btn btn-default pull-right' data-toggle='tooltip' title='Create New Call Record' href="{{ route('call_log.create') }}" >Add Call</a>
                            </td>                            
                        </tr>
                    </table>
                </div>
                <div id="callLogDiv" class="panel-collapse collapse in">
                    <div class="panel-body" style='overflow: auto;'>
                        <table class="table table-hover tablesorter" id="callLogTable" style="width: 100%;" >
                            <thead>
                                <tr >	
                                    <th style="width: 5%">Status</th>
									<th style="width: 5%">Status</th>
                                    <th style="width: 15%">Open Date</th>  
                                    <th style="width: 11%">Location</th>
                                    <th style="width: 15%">Animal</th>                                    
                                    <th style="width: 12%">Hotline Volunteer</th>	
                                    <th style="width: 12%">Rescue Volunteer</th>	
                                    <th style="width: 10%">Responder Type</th>
                                    <th style="width: 10%">Solution Type</th>
                                    <th colspan="2" style="width: 5%">Actions</th>    
                                </tr>
                            </thead>
                            <tbody >                                 
                            @foreach($calls as $call)
                                <tr id="{{$call->id}}" >
                                    <td style='vertical-align:middle;'>{{$call->call_status}} </td>	
									<td style='vertical-align:middle;'>{{$call->id}} </td>	
                                    <td style='vertical-align:middle;'>{{Carbon\Carbon::parse($call->open_date)->format('m/d/Y g:i a') }}</td>
                                    <td style='vertical-align:middle;'>{{isset($call['location']->location) ? $call['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{isset($call['species']->species_name) ? $call['species']->species_name : '' }}</td>                                    
                                    <td style='vertical-align:middle;'>
                                        @foreach($call['callActivity'] as $callActivity )
                                            @if ($callActivity->activity_type_id == 1)
                                                {{$callActivity['userDetail']->first_name . ' ' . $callActivity['userDetail']->last_name }}
                                                @break
                                            @else
                                                @continue
                                            @endif
                                            
                                        @endforeach
                                    </td>
                                    <td style='vertical-align:middle;'>
                                        @foreach($call['callActivity'] as $callActivity )
                                            @if ($callActivity->activity_type_id == 2)
                                                {{$callActivity['userDetail']->first_name . ' ' . $callActivity['userDetail']->last_name}}
                                                @break
                                            @else
                                                @continue
                                            @endif
                                        
                                        @endforeach
                                    </td>	
                                    <td style='vertical-align:middle;'>{{isset($call['responderType']->responder_type) ? $call['responderType']->responder_type : '' }}</td>
                                    <td style='vertical-align:middle;'>{{isset($call['solutionType']->solution_type) ? $call['solutionType']->solution_type : '' }}</td>
                                    @if(Auth::user()->isAdmin())
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('call_log.edit', $call->id ) }}" data-toggle='tooltip' title='Edit Call' style='padding:5px'><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('call_log.delete', $call->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Call' style='padding:5px'  ><i class='far fa-trash-alt fa-lg' ></i></a>
                                        </td>                    
                                    @else
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('call_log.edit', $call->id ) }}" data-toggle='tooltip' title='Edit Call' style='padding:5px'><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach        
                            </tbody>
                        </table>
                        <div class='text-center'>
                        {{ $calls->appends(['recordCount' => $recordCount])->links() }}
                        </div>
                    </div> 
                    
                        
                                       
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <table style='width:100%'>
                        <tr>
                            <td>
                                <h4 class="panel-title"  >
                                    <a data-toggle="collapse" href="#mapDiv"  >Map</a>
                                </h4>
                            </td>                            
                        </tr>
                    </table>
                </div>
                <div id="mapDiv" class="panel-collapse collapse">
                    <div class="panel-body">Coming Soon!</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$( function() { 
    $('[data-toggle="tooltip"]').tooltip(); 


    $('#filterTable-input').keyup(function() {
        var $rows = $('#callLogTable tbody tr');
        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;

        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });  

    $(".tablesorter").tablesorter();
    $('.tablesorter th').mouseenter(function () {
        $(this).css("cursor", "s-resize");
	});

    $('#recordCount').on('blur keyup', function(e) {
        if (e.type === 'blur' || e.keyCode === 13) {

            let oldCount = getParameterByName('recordCount');
            let newCount =  $('#recordCount').val();
            let params = ["recordCount=" + newCount];
            let url = "?";
            if (oldCount != newCount){
                window.location = url + params.join('&');
            }

        }
        
    });

});

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return 1;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
</script>              
    
@endsection