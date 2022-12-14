<div class='col-sm-12'>
    <fieldset style='margin:10px'>
    <legend style='color:DarkBlue'>Call Info</legend>
        <div class="row" >
            <div class="col-sm-4 form-group{{ $errors->has('call_type_id') ? ' has-error' : '' }}">
                <label for="call_type_id" class=" control-label">Call Type:</label>
                <select class="form-control" id="call_type_id" name="call_type_id">
                    <option value="" disabled selected>Select Call Type</option>
                    @foreach ($callTypeDropDownOptions as $callTypeDropDownOption)
                        <option value = "{{ $callTypeDropDownOption->id }}"
                            @if(isset($call_log->call_type_id))
                                {{ $callTypeDropDownOption->id ==  $call_log->call_type_id ? 'selected="selected"' : '' }}
                            @else
                                {{ $callTypeDropDownOption->id ==  old('call_type_id') ? 'selected="selected"' : '' }}
                            @endif  >
                            {{ $callTypeDropDownOption->call_type}}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('call_type_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('call_type_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-sm-5 form-group{{ $errors->has('open_date') ? ' has-error' : '' }}" >
                <label class='control-label' for='open_date'>Opened Date/time</label>
                <div class= 'input-group'>
                    <input id="open_date" name="open_date" placeholder="YYYY-MM-DD hh:mm" type='text' class="form-control "
                        value="{{ isset($call_log->open_date) ? Carbon\Carbon::parse($call_log->open_date)->format('m/d/Y g:i a') : old('open_date')  }}"  />
                    <div class='input-group-addon'>
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
                @if ($errors->has('open_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('open_date') }}</strong>
                    </span>
                @endif
            </div>

        </div>
        <div class='row' >
            <div class="col-sm-4 form-group{{ $errors->has('call_status') ? ' has-error' : '' }}">
                <label for="call_status" class=" control-label">Call Status:</label>
                <select class="form-control" id="call_status" name="call_status">
                    <option value = "Open"
                        @if(isset($call_log->call_status))
                            {{ $call_log->call_status ==  "Open" ? 'selected="selected"' : '' }}
                        @endif  >
                        Open
                    </option>
                    <option value = "Closed"
                        @if(isset($call_log->call_status))
                            {{ $call_log->call_status ==  "Closed" ? 'selected="selected"' : '' }}
                        @elseif (old('call_status') == 'Closed')
                            {{ 'selected="selected"' }}
                        @endif  >
                        Closed
                    </option>
                </select>
                @if ($errors->has('call_status'))
                    <span class="help-block">
                        <strong>{{ $errors->first('call_status') }}</strong>
                    </span>
                @endif
            </div>

           <div class='col-sm-5' >
                <label class='control-label' for='close_date'>Closed Date/time</label>
                <div class= 'input-group'>
                    <input id="close_date" name="close_date" placeholder="YYYY-MM-DD hh:mm" type='text' class="form-control "
                        value="{{ isset($call_log->close_date) ? Carbon\Carbon::parse($call_log->close_date)->format('m/d/Y g:i a') : old('close_date')  }}" />
                    <div class='input-group-addon'>
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group {{ $errors->has('animal_species') ? ' has-error' : '' }}">
            <div class="col-sm-6">
                <label for="animal_species_id" class=" control-label">Species:</label>
                <input type="hidden" class="form-control" id="animal_species_id" name="animal_species_id"
                    value="{{ isset($call_log->animal_species_id) ? $call_log->animal_species_id : old('animal_species_id') }}" />
                <input type="text" class="form-control" id="animal_species" name="animal_species" placeholder="Species"
                    value="{{ isset($call_log->animal_species_id) ? $call_log['species']->species_name : old('animal_species') }}" />
                @if ($errors->has('animal_species'))
                    <span class="help-block">
                        <strong>{{ $errors->first('animal_species') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class='row' >
            <div class="col-sm-12 form-group" >
                <label for="animal_situation" class=" control-label">Situation:</label>
                <textarea id='animal_situation' name="animal_situation" style="height:50px;" class='col-sm-12'>{{isset($call_log->animal_situation) ? $call_log->animal_situation : old('animal_situation') }}</textarea>
            </div>
        </div>
    </fieldset >
</div>

<div class='col-sm-12'>
    <fieldset style='margin:10px' >
    <legend style='color:DarkBlue'>Caller Info</legend>
        <div class='row'>
            <div class="col-sm-6 form-group">
                <label for="caller_first_name" class="control-label">First Name:</label>
                <input type="text" class="form-control" id="caller_first_name" name="caller_first_name" placeholder="First Name"
                    value="{{ isset($call_log->caller_first_name) ? $call_log->caller_first_name : old('caller_first_name') }}"   />
            </div>

            <div class="col-sm-6 form-group">
                <label for="caller_last_name" class=" control-label">Last Name:</label>
                <input type="text" class="form-control" id="caller_last_name" name="caller_last_name" placeholder="Last Name"
                    value="{{ isset($call_log->caller_last_name) ? $call_log->caller_last_name : old('caller_last_name') }}" />
            </div>
        </div>
        <div class='row' >
            <div class="col-sm-6 form-group {{ $errors->has('caller_phone_number') ? ' has-error' : '' }}">
                <label for="caller_phone_number" class=" control-label">Phone Number:</label>
                <input type="text" class="form-control phone" id="caller_phone_number" name="caller_phone_number" placeholder="Phone Number"
                    value="{{ isset($call_log->caller_phone_number) ? $call_log->caller_phone_number : old('caller_phone_number') }}" />
                @if ($errors->has('caller_phone_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('caller_phone_number') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-sm-6 form-group {{ $errors->has('caller_location_id') ? ' has-error' : '' }}">
                <label for="caller_location_id" class=" control-label">Location:</label>
                <select class="form-control" id="caller_location_id" name="caller_location_id" placeholder='Enter a location name'>
                    <option value="" disabled selected>Enter a location name</option>
                    @foreach ($locationDropDownOptions as $locationDropDownOption)
                        <option value = "{{ $locationDropDownOption->id }}"
                            @if(isset($call_log->caller_location_id))
                                {{ $locationDropDownOption->id ==  $call_log->caller_location_id ? 'selected="selected"' : '' }}
                            @else
                                {{ $locationDropDownOption->id ==  old('caller_location_id') ? 'selected="selected"' : '' }}
                            @endif  >{{ $locationDropDownOption->location}}</option>
                    @endforeach

                </select>
                @if ($errors->has('caller_location_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('caller_location_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-3">
                <label for="postal_code_id" class=" control-label">Postal Code:</label>
                <input type="hidden" class="form-control" id="postal_code_id" name="caller_postal_code_id"
                    value="{{ isset($call_log->caller_postal_code_id) ? $call_log->caller_postal_code_id : old('caller_postal_code_id') }}" />
                <input type="text" class="form-control" id="postal_code" name="caller_postal_code" placeholder="Postal Code"
                    value="{{ isset($call_log->caller_postal_code_id) ? $call_log['postalCode']->postal_code : old('postal_code') }}" maxlength="10" />
                @if ($errors->has('postal_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('postal_code') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-sm-6 form-group">
                <label for="caller_address" class=" control-label">Mailing Address:</label>
                <input type="text" class="form-control" id="caller_address" name="caller_address" placeholder="Mailing Address"
                    value="{{ isset($call_log->caller_address) ? $call_log->caller_address : old('caller_address') }}" />
            </div>
			<div class="col-sm-3 form-group" style="padding-top: 30px;">
				<label for="caller_thanks" class=" control-label">Thank you card</label>
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="caller_thanks" value=0 />
                                    <input id="caller_thanks" name="caller_thanks" type="checkbox" value="1" {{ isset($call_log->caller_address)  ? $call_log->caller_address == 1 ? 'checked' : '' : '' }} /> 
									<label for="caller_thanks" class="label-primary"></label>
                                </div>
                            </div>
        </div>

        <div class='row' >

            <div class="col-sm-12 form-group" >
                <label for="caller_notes" class="control-label">Call Notes:</label>
                <textarea id='caller_notes' name="caller_notes" style="height:50px;" class='col-sm-12'>{{isset($call_log->caller_notes) ? $call_log->caller_notes : old('caller_notes') }}</textarea>
            </div>

        </div>
    </fieldset >
</div>

<div class='col-sm-12'>
    <fieldset style='margin:10px'>
    <legend style='color:DarkBlue'>Volunteer Info</legend>
        <div class='row' >

            <div class="col-sm-6 form-group{{ $errors->has('volunteer_hotline') ? ' has-error' : '' }}">
                <label for="volunteer_hotline" class="control-label">Hotline Volunteer(s):</label>
                <input type="hidden" class="form-control" id="volunteer_hotline_old" name="volunteer_hotline_old"
                    value="{{ old('volunteer_hotline') }}" />
                <input type="text" class="form-control" id="volunteer_hotline_select" name="volunteer_hotline_select" placeholder="Hotline Volunteer(s)"
                    value="{{ isset($call_log->volunteer_hotline) ? $call_log->volunteer_hotline : '' }}" />

                <label for="volunteer_hotline_list" class="control-label">Hotline Volunteer List:</label>
                <table id='volunteer_hotline_table'>
                    <tbody>
                    <tr />
                    </tbody>
                </table>
                <input type='hidden' id='volunteer_hotline' name="volunteer_hotline">
                @if ($errors->has('volunteer_hotline'))
                    <span class="help-block">
                        <strong>{{ $errors->first('volunteer_hotline') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-sm-6 form-group{{ $errors->has('volunteer_rescue') ? ' has-error' : '' }}">
                <label for="volunteer_rescue" class="control-label">Rescue Volunteer(s):</label>
                <input type="hidden" class="form-control" id="volunteer_rescue_old" name="volunteer_rescue_old"
                    value="{{ old('volunteer_rescue') }}" />
                <input type="text" class="form-control" id="volunteer_rescue_select" name="volunteer_rescue_select" placeholder="Rescue Volunteer(s)"
                    value="{{ isset($call_log->volunteer_rescue) ? $call_log->volunteer_rescue : '' }}" />

                <label for="volunteer_rescue_list" class="control-label">Rescue Volunteer List:</label>
                <table id='volunteer_rescue_table'>
                    <tbody>
                    <tr />
                    </tbody>
                </table>
                <input type='hidden' id='volunteer_rescue' name="volunteer_rescue">
            </div>
        </div>

    </fieldset >
</div>

<div class='col-sm-12'>
    <fieldset style='margin:10px'>
    <legend style='color:DarkBlue'>Solution Info</legend>


        <div class='row' >

            <div class="col-sm-6 form-group">
                <label for="animal_responder_type_id" class=" control-label">Responder Type:</label>
                <select class="form-control" id="animal_responder_type_id" name="animal_responder_type_id">
                    <option value="-1" selected>Select Responder Type</option>
                    @foreach ($responderTypeDropDownOptions as $responderTypeDropDownOption)
                        <option value = "{{ $responderTypeDropDownOption->id }}"
                            @if(isset($call_log->animal_responder_type_id))
                                {{ $responderTypeDropDownOption->id ==  $call_log->animal_responder_type_id ? 'selected="selected"' : '' }}
                            @else
                                {{ $responderTypeDropDownOption->id ==  old('animal_responder_type_id') ? 'selected="selected"' : '' }}
                            @endif  >
                            {{ $responderTypeDropDownOption->responder_type}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 form-group {{ $errors->has('animal_solution_type_id') ? ' has-error' : '' }}">
                <label for="animal_solution_type_id" class=" control-label">Solution Type:</label>
                <select class="form-control" id="animal_solution_type_id" name="animal_solution_type_id">
                    <option value="" selected>Select Solution Type</option>
                    @foreach ($solutionTypeDropDownOptions as $solutionTypeDropDownOption)
                        <option value = "{{ $solutionTypeDropDownOption->id }}"
                            @if(isset($call_log->animal_solution_type_id))
                                {{ $solutionTypeDropDownOption->id ==  $call_log->animal_solution_type_id ? 'selected="selected"' : '' }}
                            @else
                                {{ $solutionTypeDropDownOption->id ==  old('animal_solution_type_id') ? 'selected="selected"' : '' }}
                            @endif  >
                            {{ $solutionTypeDropDownOption->solution_type}}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('animal_solution_type_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('animal_solution_type_id') }}</strong>
                    </span>
                @endif
            </div>

        </div>
        <div class='row' >
            <div class="col-sm-6 form-group">
                <label for="rehabilitator_id" class=" control-label">Rehab Center:</label>
                <select class="form-control" id="rehabilitator_id" name="rehabilitator_id">
                    <option value="-1"  selected>Select Rehab Center</option>
                    @foreach ($rehabilitatorDropDownOptions as $rehabilitatorDropDownOption)
                        <option value = "{{ $rehabilitatorDropDownOption->id }}"
                            @if(isset($call_log->rehabilitator_id))
                                {{ $rehabilitatorDropDownOption->id ==  $call_log->rehabilitator_id ? 'selected="selected"' : '' }}
                            @else
                                {{ $rehabilitatorDropDownOption->id ==  old('rehabilitator_id') ? 'selected="selected"' : '' }}
                            @endif  >
                            {{ $rehabilitatorDropDownOption->center_name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 form-group">
                <label for="veterinarian_id" class=" control-label">Vet Clinic:</label>
                <select class="form-control" id="veterinarian_id" name="veterinarian_id">
                    <option value="-1"  selected>Select Vet Clinic</option>
                    @foreach ($veterinarianDropDownOptions as $veterinarianDropDownOption)
                        <option value = "{{ $veterinarianDropDownOption->id }}"
                            @if(isset($call_log->veterinarian_id))
                                {{ $veterinarianDropDownOption->id ==  $call_log->veterinarian_id ? 'selected="selected"' : '' }}
                            @else
                                {{ $veterinarianDropDownOption->id ==  old('veterinarian_id') ? 'selected="selected"' : '' }}
                            @endif  >
                            {{ $veterinarianDropDownOption->clinic_name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-12 form-group" >
                <label for="animal_solution" class=" control-label">Solution Notes:</label>
                <textarea id='animal_solution' name="animal_solution" style="height:50px;" class='col-sm-12'>{{isset($call_log->animal_solution) ? $call_log->animal_solution : old('animal_solution') }}</textarea>
            </div>
        </div>
    </fieldset >
</div>

<script>
$( function() {
    var hotlineVolunteers = {};
    var rescueVolunteers = {};

    $('#open_date, #close_date').datetimepicker({
        controlType: 'select',
        timeFormat: "hh:mm tt"
    });

    var speciesOptions = {
        url: function(phrase) {
            var url = '{{ route("call_log.searchSpecies", ":term") }}';
            url = url.replace(':term', phrase);
            return url;
        },
        getValue: "species_name",
        list :{
			maxNumberOfElements: 15,
			onSelectItemEvent: function() {
				var value = $("#animal_species").getSelectedItemData().id;
				$("#animal_species_id").val(value);
			}
		},
		adjustWidth: false

    };

    var hotlineOptions = {
        url: function(phrase) {
            var url = '{{ route("call_log.searchVolunteers", ":term") }}';
            url = url.replace(':term', phrase);
            return url;
        },
        getValue: "Name",
        list :{
			maxNumberOfElements: 15,
			onClickEvent: function() {
				var name = $("#volunteer_hotline_select").getSelectedItemData().Name;
                var id = $("#volunteer_hotline_select").getSelectedItemData().id;

                if (!(id in hotlineVolunteers)) {
                    var addRow = '<tr id = "' + id + '" ><td class="col-sm-3">' + name + ' </td><td class="col-sm-1"> <span ><i class="fa fa-times removeHotline" aria-hidden="true"></i></span></sup></td></tr> ';
                    $('#volunteer_hotline_table tr:last').after(addRow);
                    hotlineVolunteers[id] = name;
                    $('#volunteer_hotline').val(JSON.stringify(hotlineVolunteers));
                    $("#volunteer_hotline_select").val('');
                }

			}
		},
		adjustWidth: false

    };

    var rescueOptions = {
        url: function(phrase) {
            var url = '{{ route("call_log.searchVolunteers", ":term") }}';
            url = url.replace(':term', phrase);
            return url;
        },
        getValue: "Name",
        list :{
			maxNumberOfElements: 15,
			onClickEvent: function() {
				var name = $("#volunteer_rescue_select").getSelectedItemData().Name;
                var id = $("#volunteer_rescue_select").getSelectedItemData().id;

                if (!(id in rescueVolunteers)) {
                    var addRow = '<tr id = "' + id + '" ><td class="col-sm-3">' + name + ' </td><td class="col-sm-1"> <span ><i class="fa fa-times removeRescue" aria-hidden="true"></i></span></sup></td></tr> ';
                    $('#volunteer_rescue_table tr:last').after(addRow);
                    rescueVolunteers[id] = name;
                    $('#volunteer_rescue').val(JSON.stringify(rescueVolunteers));
                    $("#volunteer_rescue_select").val('');
                }

			}
		},
		adjustWidth: false

    };

    var postalOptions = {
        url: function(phrase) {
            var url = '{{ route("profile.searchPostalCodes", ":term") }}';
            url = url.replace(':term', phrase);
            return url;
        },
        getValue: "postal_code",
        requestDelay: 300,
        list :{
            maxNumberOfElements: 10,
            onSelectItemEvent: function() {
                var value = $("#postal_code").getSelectedItemData().id;
                $("#postal_code_id").val(value);
            }
        },
        adjustWidth: false

    };

    $("#postal_code").easyAutocomplete(postalOptions);

    $("#postal_code").keypress(function( e ) {
        if(e.which === 32) {
            return false;
        }
    });

    $("#postal_code").on('blur', function() {
        var url = '{{ route("profile.searchPostalCodes", ":term") }}';
        url = url.replace(':term', this.value);
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#postal_code_id').value = data[0].id;
                $('#postal_code').value = data[0].postal_code;
            },
            error: function(data) {
                $('#postal_code_id').attr('value', null) ;
                $('#postal_code').value = '';
            }

        });

    });

    $("#animal_species").easyAutocomplete(speciesOptions);
    $("#volunteer_hotline_select").easyAutocomplete(hotlineOptions);
    $("#volunteer_rescue_select").easyAutocomplete(rescueOptions);
    buildVolunteerTables();


    $(document).on('click', '.removeRescue, .removeHotline', function (){

        if($(this).hasClass('removeHotline')){
            var id = $(this).closest('tr').attr('id');

            delete hotlineVolunteers[id];

            $(this).closest('tr').remove();
            $('#volunteer_hotline').val(JSON.stringify(hotlineVolunteers));
        };

		if($(this).hasClass('removeRescue')){
            var id = $(this).closest('tr').attr('id');

            delete rescueVolunteers[id];

            $(this).closest('tr').remove();
            $('#volunteer_rescue').val(JSON.stringify(rescueVolunteers));
        };

	});

    function buildVolunteerTables(){

        if ($.trim( $('#volunteer_hotline_old').val() ).length > 1 ) {
            var oldHotline = JSON.parse($('#volunteer_hotline_old').val());

            for (var key in oldHotline) {
                var obj = oldHotline[key];
                var hotlineHTML = '<tr id = "' + key + '" ><td class="col-sm-3">' + obj + ' </td><td class="col-sm-1"> <span ><i class="fa fa-times removeHotline" aria-hidden="true"></i></span></sup></td></tr> ';
                $('#volunteer_hotline_table tr:last').after(hotlineHTML);
                hotlineVolunteers[key] = obj;
                $('#volunteer_hotline').val(JSON.stringify(hotlineVolunteers));
                $("#volunteer_hotline_select").val('');
            }

        }

        if ($.trim( $('#volunteer_rescue_old').val() ).length > 1 ) {
            var oldRescue = JSON.parse($('#volunteer_rescue_old').val());

            for (var key in oldRescue) {
                var obj = oldRescue[key];
                var rescueHTML = '<tr id = "' + key + '" ><td class="col-sm-3">' + obj + ' </td><td class="col-sm-1"> <span ><i class="fa fa-times removeRescue" aria-hidden="true"></i></span></sup></td></tr> ';
                $('#volunteer_rescue_table tr:last').after(rescueHTML);
                rescueVolunteers[key] = obj;
                $('#volunteer_rescue').val(JSON.stringify(rescueVolunteers));
                $("#volunteer_rescue_select").val('');
            }

        }

        var data = {};
        @if(isset($call_log))
            @foreach($call_log['callActivity'] as $callActivity )
                data ={
                    id: '{{ $callActivity->id }}',
                    call_id: '{{ $callActivity->call_id }}',
                    user_detail_id: '{{ $callActivity->user_detail_id }}',
                    user_name: '{{ $callActivity['userDetail']->first_name . " " . $callActivity['userDetail']->last_name  }}',
                    activity_type_id: '{{ $callActivity->activity_type_id }}'
                };

                if(data.activity_type_id == 1){
                    var hotlineHTML = '<tr id = "' + data.user_detail_id + '" ><td class="col-sm-3">' + data.user_name + ' </td><td class="col-sm-1"> <span ><i class="fa fa-times removeHotline" aria-hidden="true"></i></span></sup></td></tr> ';
                    $('#volunteer_hotline_table tr:last').after(hotlineHTML);
                    hotlineVolunteers[data.user_detail_id] = data.user_name;
                    $('#volunteer_hotline').val(JSON.stringify(hotlineVolunteers));
                    $("#volunteer_hotline_select").val('');

                } else if(data.activity_type_id == 2){
                    var rescueHTML = '<tr id = "' + data.user_detail_id + '" ><td class="col-sm-3">' + data.user_name + ' </td><td class="col-sm-1"> <span ><i class="fa fa-times removeRescue" aria-hidden="true"></i></span></sup></td></tr> ';
                    $('#volunteer_rescue_table tr:last').after(rescueHTML);
                    rescueVolunteers[data.user_detail_id] = data.user_name;
                    $('#volunteer_rescue').val(JSON.stringify(rescueVolunteers));
                    $("#volunteer_rescue_select").val('');

                }


            @endforeach
        @endif

    }

    $( function() {
        $('.phone').keyup(function() {
            var val = this.value.replace(/\D/g, '');
            var newVal = '';
            while (val.length > 3 && newVal.length < 8) {
            newVal += val.substr(0, 3) + '-';
            val = val.substr(3);
            }
            newVal += val;
            this.value = newVal;
        });

        $.widget( "custom.combobox", {
            _create: function() {
                this.wrapper = $( "<span>" )
                .addClass( "custom-combobox" )
                .insertAfter( this.element );

            this.element.hide();
            this._createAutocomplete();
            this._createShowAllButton();
        },

        _createAutocomplete: function() {
            var selected = this.element.children( ":selected" ),
                value = selected.val() ? selected.text() : "";

            this.input = $( "<input>" )
            .appendTo( this.wrapper )
            .val( value )
            .attr( "title", "" )
            .addClass( "form-control custom-combobox-input ui-widget-content ui-state-default ui-corner-left" )
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: $.proxy( this, "_source" )
            })
            .tooltip({
                classes: {
                "ui-tooltip": "ui-state-highlight"
                }
            });

            this._on( this.input, {
            autocompleteselect: function( event, ui ) {
                ui.item.option.selected = true;
                this._trigger( "select", event, {
                item: ui.item.option
                });
            },

            autocompletechange: "_removeIfInvalid"
            });
        },

        _createShowAllButton: function() {
            var input = this.input,
            wasOpen = false;

            $( "<a>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "Show All Items" )
            .tooltip()
            .appendTo( this.wrapper )
            .button({
                icons: {
                primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
            .removeClass( " ui-corner-all" )
            .addClass( " custom-combobox-toggle ui-corner-right" )
            .on( "mousedown", function() {
                wasOpen = input.autocomplete( "widget" ).is( ":visible" );
            })
            .on( "click", function() {
                input.trigger( "focus" );

                // Close if already visible
                if ( wasOpen ) {
                    return;
                }

                // Pass empty string as value to search for, displaying all results
                input.autocomplete( "search", "" );
            });
        },

        _source: function( request, response ) {
            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
            response( this.element.children( "option" ).map(function() {
            var text = $( this ).text();
            if ( this.value && ( !request.term || matcher.test(text) ) )
                return {
                label: text,
                value: text,
                option: this
                };
            }) );
        },

        _removeIfInvalid: function( event, ui ) {

            // Selected an item, nothing to do
            if ( ui.item ) {
                return;
            }

            // Search for a match (case-insensitive)
            var value = this.input.val(),
            valueLowerCase = value.toLowerCase(),
            valid = false;
            this.element.children( "option" ).each(function() {
            if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                this.selected = valid = true;
                return false;
            }
            });

            // Found a match, nothing to do
            if ( valid ) {
                return;
            }

            // Remove invalid value
            this.input
            .val( "" )
            .attr( "title", value + " didn't match any item" )
            .tooltip( "open" );

            this.element.val( "" );
            this._delay(function() {
                this.input.tooltip( "close" ).attr( "title", "" );
            }, 2500 );
            this.input.autocomplete( "instance" ).term = "";
        },

        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        }
        });

        $( "#caller_location_id" ).combobox();

    } );

} );
</script>
