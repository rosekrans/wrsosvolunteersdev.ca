@extends('layouts.master')

@section('content')

@if(!Auth::guest())
<div class="row">
    <div class="col-md-12 ">        
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                     <table style='width:100%'>
                        <tr>
                            <td>
                                <h4 class="panel-title"  >
                                    <a data-toggle="collapse" href="#hotlineScheduleDiv"  >Hotline Schedule</a>
                                </h4>
                            </td>
                        </tr>
                    </table>

                </div>
                <div id="hotlineScheduleDiv" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div id='hotline_schedule' style="width:100%; height:500px;"></div>
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
                                    <a data-toggle="collapse" href="#oncallScheduleDiv"  >Management Schedule</a>
                                </h4>
                            </td>
                        </tr>
                    </table>

                </div>
                <div id="oncallScheduleDiv" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div id='oncall_schedule' style="width:100%; height:500px;"></div>
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
                                    <a data-toggle="collapse" href="#rescueScheduleDiv"  >Rescue Schedule</a>
                                </h4>
                            </td>
                        </tr>
                    </table>

                </div>
                <div id="rescueScheduleDiv" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div id='rescue_schedule' style="width:100%; height:500px;"></div>
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
                                    <a data-toggle="collapse" href="#callLogDiv"  >Open Calls</a>
                                </h4>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="callLogDiv" class="panel-collapse collapse in">
                    <div class="panel-body" style='overflow: auto;'>
                        <table class="table table-hover tablesorter" id="callLogTable" style="width: 100hv;" >
                            <thead>
                                <tr >
                                    <th style="width: 5%">Status</th>
									<th style="width: 5%">ID</th>
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
                                    <td style='vertical-align:middle'><a href="{{ route('call_log.edit', $call->id ) }}" data-toggle='tooltip' title='Edit Call' style='padding:5px'><i class='fas fa-edit fa-lg' ></i></a></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>

@endif
<script>
$( function() {

    var hotlineShifts = {!! isset($hotlineShifts) ? json_encode($hotlineShifts) : ''  !!};
	var oncallShifts = {!! isset($oncallShifts) ? json_encode($oncallShifts) : ''  !!};
    var rescueShifts = {!! isset($rescueShifts) ? json_encode($rescueShifts) : ''  !!};

    var schedule = {
        showCalendar: function(options){
            options.target.fullCalendar({
                header: {
                    left:'prev, next',
                    center: 'title',
                    right: 'month,agendaWeek,listWeek'
                },
                defaultDate: moment().format('LL'),
                columnFormat: 'ddd',
                defaultView: options.defaultView,
                height: 498,
                firstDay:1,
                minTime: '08:00:00',
                maxTime: '21:00:00',
                navLinks: false, // can click day/week names to navigate views
                selectable: false,
                allDaySlot: false,
                editable: false,
                eventLimit: true,
                timeFormat: 'h:mm a',
                displayEventTime: true,
                displayEventEnd: true
            });
            (function (){

            if (!(options.shifts == null)){
                var backgroundColor = 'CornflowerBlue';
                for (i = 0, l = options.shifts.length; i < l; i++){
                    var title = options.shifts[i]['user_detail'].first_name + ' ' + options.shifts[i]['user_detail'].last_name;
                    if (options.shifts[i].shift_type_id == 2) {
                            title = title + ' - ' + options.shifts[i]['user_detail']['location'].location
                    }
					var link = '/profile/' + options.shifts[i]['user_detail'].user_id;
                    var event = {title: title, start: options.shifts[i].shift_start, end: options.shifts[i].shift_end, allDay:false, url: link};
                    options.target.fullCalendar('renderEvent', event, stick = 'true');
                }
            } else {
                // create a single empty event so the calendar at least shows up
                var event = {title: '', start: '2017-01-01 00:00:00', end:'2017-01-01 00:30:00', allDay:false};
                options.target.fullCalendar('renderEvent', event, stick = 'true');
            }
        })();

        }
    };

    schedule.showCalendar({shifts: hotlineShifts, target: $('#hotline_schedule'), defaultView: 'agendaWeek'});
	schedule.showCalendar({shifts: oncallShifts, target: $('#oncall_schedule'), defaultView: 'agendaWeek'});
    schedule.showCalendar({shifts: rescueShifts, target: $('#rescue_schedule'), defaultView: 'listWeek'});
    $('[data-toggle="tooltip"]').tooltip();
	$('#oncallScheduleDiv').removeClass('in');
    $('#rescueScheduleDiv').removeClass('in');
});
</script>

@endsection
