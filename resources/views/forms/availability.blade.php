
<div class="form-group" >    
    <div class='row' style='padding: 10px 30px 10px;'>
        <div class="panel panel-default" >
            <div class="panel-heading" >Schedule a Shift</div>                        
            <div class="panel-body" >
                <div class="row" style="padding-bottom:10px">
                
                    <div class="col-sm-4 form-group {{ $errors->has('open_date') ? ' has-error' : '' }}" >
                        <label class='control-label col-xs-4' for='startDate'>Shift Start</label>                        
                        <div class= 'input-group'>
                            <input id='startDate' name='startDate' type='text' class="form-control "  />
                            <div class='input-group-addon'>
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>      
                    <div class="col-sm-4 form-group {{ $errors->has('open_date') ? ' has-error' : '' }}" >
                        <label class='control-label col-xs-4' for='endDate'>Shift End</label>
                        <div class= 'input-group'>
                            <input id='endDate' name='endDate' type='text' class="form-control "  />
                            <div class='input-group-addon'>
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group {{ $errors->has('open_date') ? ' has-error' : '' }}">                                                            
                        <select class="form-control" id="shift_type_id" name="shift_type_id">
                            <option value="" disabled selected>Select Shift Type</option>                                    
                            @foreach ($shiftTypeDropDownOptions as $shiftTypeDropDownOption)
                                <option value = "{{ $shiftTypeDropDownOption->id }}"
                                    @if(isset($user['userDetail']->shift_type))
                                        {{ $shiftTypeDropDownOption->id ==  $user['userDetail']->location_id ? 'selected="selected"' : '' }}
                                    @endif  >
                                    {{ $shiftTypeDropDownOption->shift_type}}
                                </option>
                                
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class='row' style='padding: 5px 30px 5px;'>
                <div <div class='col-sm-12' >
                    <label for="availability" class=" control-label">Availability Notes:</label>									
                    <textarea id='availability' name="availability" style="height:50px; width:100%" value="{{ old('availability') }}" 
                        >{{ isset($user['userDetail']->availability) ? $user['userDetail']->availability : old('availability') }}</textarea>		
                </div>
            </div>
            <div class='row ' style='padding: 5px 30px 5px;' >		
                <div <div class='col-sm-12' >					
                    <div id='shiftSpan' class='alert alert-warning' style='width:100%'>We recommend signing up for shifts in 4 hour blocks, if possible.</div>
                </div>
            </div>
            
            <div class='panel-footer clearfix'>
                <input type='submit' class='btn btn-default pull-right addShift' style='margin-left:5px' value='Add Shift'>                
            </div>
        </div>
    </div>
    <div class='row' style='padding: 10px 30px 10px;'>
        <div class="panel panel-default" >
            <div class="panel-heading" >Your Schedule</div>
            <div class="panel-body" >
                <div id="rescue_container" style="width:100%; height:500px;" class="fc fc-unthemed fc-ltr">
                    <div id="schedule_list">
                        <div class="fc-view-container" >
                            <div class="fc-view fc-listWeek-view fc-list-view fc-widget-content" style='border:none'>
                                <div class="fc-scroller" style="overflow-x: hidden; overflow-y: auto; height: 449.5px;">
                                    <table id='schedule_table' class="fc-list-table">
                                        <tbody>
                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

</div>


<script>
$( function() {

    var startDateTextBox = $('#startDate');

    var endDateTextBox = $('#endDate');
    
    var shifts = {!! json_encode($shifts) !!};
    
    var schedule = {
        showCalendar: function(options){ 
            
            var headerDates = [];
            // loop through the shifts and create an array of 'header' dates
            for (i = 0, l = options.shifts.length; i < l; i++){
                headerDates[i] = moment(options.shifts[i].shift_start).format('MMMM DD, YYYY');
            }
            // clean up the list of header dates and make them unique
            var uniqueNames = [];
            $.each(headerDates, function(i, el){
                if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
            });
            headerDates = uniqueNames;
            
            // loop through the unique header dates and display them
            for(i = 0, l = headerDates.length; i < l; i++){
                var headerHTML = '<tr class="fc-list-heading" data-date="' + headerDates[i] + '"><td class="fc-widget-header" colspan="3"><span class="fc-list-heading-main">' + moment(headerDates[i]).format('dddd') + '</span><span class="fc-list-heading-alt">' +  moment(headerDates[i]).format('MMMM DD, YYYY') + '</span></td></tr>'
                $('#schedule_table tbody:last').before(headerHTML);
                
                // loop through the shifts and compare to the headerDate...
                for (j = 0, k = options.shifts.length; j < k; j++){
                    if (moment(options.shifts[j].shift_start).format('MMMM DD, YYYY') == headerDates[i] ) {
                        var shiftHTML = '<tr class="fc-list-item" id="' + options.shifts[j].id  + '"><td class="fc-list-item-time fc-widget-content">' + moment(options.shifts[j].shift_start).format('h:mm a')  + ' - ' + moment(options.shifts[j].shift_end).format('h:mm a')  + '</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>' + options.shifts[j]['shift_type'].shift_type + '</a><a data-toggle="tooltip" title="Delete Shift" style="padding-right:15px" class="pull-right removeShift"  ><i class="far fa-trash-alt" ></i></a></td></tr>'                  
                        $('#schedule_table tr:last').after(shiftHTML);
                    }
                }                
            }
        },
        showErrors: function(options){
            var errors = options.errors;
            console.log(errors);
            $.each(errors, function (key, value) {
                $('#' + key).parent().addClass('has-error');
            });
        }
     };

    function removeShifts(){
        $('.removeShift').on('click', function (e){
            var url = "{{ route('schedule.delete', ':term') }}";        
            var id = $(this).closest('tr').attr('id');
            url = url.replace(':term', id);
            var removeRow = $(this).closest('tr');
            e.preventDefault();        
            $.ajax({
            type: "POST",
            data: {_method: 'delete', _token:"{{ csrf_token() }}"},
            url: url,
            success: function(data) { 
                removeRow.remove();   
                }
            });
        });
    }

    function timePicker(){
        // $('#startDate, #endDate' ).datetimepicker(
        //     {
        //         controlType: 'select',
        //         timeFormat: "hh:mm tt",  
        //         hourMin: 9,
        //         hourMax: 21,
        //         stepMinute: 30,
        //         showButtonPanel: false
			
        //     }
        // );

        startDateTextBox.datetimepicker({ 
            controlType: 'select',
            timeFormat: "hh:mm tt",  
            hourMin: 9,
            hourMax: 21,
            stepMinute: 30,
            showButtonPanel: false,
            onClose: function(dateText, inst) {
                if (endDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datetimepicker('getDate');
                    var testEndDate = endDateTextBox.datetimepicker('getDate');
                    if (testStartDate >= testEndDate)
                        endDateTextBox.datetimepicker('setDate', moment(testStartDate).add(1,'h').format('L hh:mm a'));
                }
                else {
                    endDateTextBox.val(moment(dateText).add(1,'h').format('L hh:mm a'));
                }
            },
            onSelect: function (dateText){
                 if (endDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datetimepicker('getDate');
                    var testEndDate = endDateTextBox.datetimepicker('getDate');
                    if (testStartDate >= testEndDate)
                        endDateTextBox.datetimepicker('setDate', moment(testStartDate).add(1,'h').format('L hh:mm a') );
                }
                else {
                    endDateTextBox.val(moment(dateText).add(1,'h').format('L hh:mm a'));
                }   
            }
        });
        endDateTextBox.datetimepicker({ 
            controlType: 'select',
            timeFormat: "hh:mm tt",  
            hourMin: 9,
            hourMax: 21,
            stepMinute: 30,
            showButtonPanel: false,
            onClose: function(dateText, inst) {
                if (startDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datetimepicker('getDate');
                    var testEndDate = endDateTextBox.datetimepicker('getDate');
                    if (testStartDate >= testEndDate)
                        startDateTextBox.datetimepicker('setDate', moment(testEndDate).subtract(1,'h').format('L hh:mm a'));
                }
                else {
                    startDateTextBox.val(moment(dateText).subtract(1,'h').format('L hh:mm a'));
                }
            },
            onSelect: function (dateText){
                if (startDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datetimepicker('getDate');
                    var testEndDate = endDateTextBox.datetimepicker('getDate');
                    if (testStartDate >= testEndDate)
                        startDateTextBox.datetimepicker('setDate', moment(testEndDate).subtract(1,'h').format('L hh:mm a'));
                }
                else {
                    startDateTextBox.val(moment(dateText).subtract(1,'h').format('L hh:mm a'));
                } 
            }
        });
    }
   
    schedule.showCalendar({shifts: shifts}); 
    removeShifts();
    timePicker();

    $('#availabilityForm').on('submit', function (e) {
        e.preventDefault();        
        $.ajax({
            type: "POST",
            url: "{{ route('schedule.update', $user['userDetail']->id) }}",
            data: $(this).serialize(),
            success: function( data ) { 
                if (data.error){
                    schedule.showErrors({errors: data.errors});
                } else {
                    $("#schedule_table tr").remove(); 
                    $('#startDate, #endDate, #shift_type_id').val('');
                    schedule.showCalendar({shifts: data.shifts});  
                    removeShifts();  
                    timePicker();
                }                
            },
            error: function(data){                
                if (data.responseText){
                    schedule.showErrors($.parseJSON(data.responseText)); 
                    schedule.showCalendar({shifts: data.shifts});  
                    removeShifts();  
                    timePicker();
                }
            }
        });
    });



    $('input, select').on('focus, change', function(){
        $(this).parent().removeClass('has-error');
    });

} );
</script>