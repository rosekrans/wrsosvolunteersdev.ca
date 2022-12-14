
<fieldset>
    <div class="row" style="padding-bottom:10px">
        <div class="form-group" style="padding:10px">
            <div class='col-sm-6'>
                <label for="first_name" class=" control-label">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ isset($user['UserDetail']->first_name) ? $user['UserDetail']->first_name : old('first_name') }}"  />
            </div>
            <div class='col-sm-6'>
                <label for="last_name" class="control-label">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value= "{{ isset($user['UserDetail']->last_name) ? $user['UserDetail']->last_name : old('last_name') }}" />
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom:10px">
        <div class="form-group" style="padding:10px">
            <div class="col-sm-8">
                <label for="email" class="control-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ isset($user->email) ? $user->email : old('email') }}"  />
            </div>
            <label for="rabies_vaccine" class="col-xs-2 control-label" style='padding-top:15px'>Rabies Vaccine?</label>
            <div class=" col-sm-2" style='padding-top:15px'>
                <div class="material-switch ">
                    <input type="hidden" name="rabies_vaccine" value=0 />
                    <input id="rabies_vaccine" name="rabies_vaccine" type="checkbox" value="1"
                        {{ isset($user['userDetail']->rabies_vaccine)  ? $user['userDetail']->rabies_vaccine == 1 ? 'checked' : '' : '' }}
                    />
                    <label for="rabies_vaccine" class="label-primary"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom:10px">
        <div class="form-group" style="padding:10px">
            <div class='col-sm-12'>
                <label for="primary_number" class="control-label ">Phone Number:</label>
                <div class='col-sm-12' style='padding-left:0px'>
                    <div class="col-sm-4" style='padding-left:0px'>
                        <input type="text" class="form-control phone" id="home_number" name="home_number" placeholder="Home #" maxlength="12" value="{{ isset($user['UserDetail']->home_number) ? $user['UserDetail']->home_number :  old('home_number') }}"/>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control phone" id="cell_number" name="cell_number" placeholder="Cell #" maxlength="12" value="{{ isset($user['UserDetail']->cell_number) ? $user['UserDetail']->cell_number : old('cell_number')}}"/>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control phone" id="other_number" name="other_number" placeholder="Other #" maxlength="12" value="{{ isset($user['UserDetail']->other_number) ? $user['UserDetail']->other_number : old('other_number') }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom:10px">
        <div class="form-group" style="padding:10px">
            <div class="col-sm-6">
                <label for="location_id" class="control-label">Location:</label>
                <div >
                    <select class="form-control" id="location_id" name="location_id">
                        <option value="" disabled selected>Select Location</option>
                        @foreach ($locationDropDownOptions as $locationDropDownOption)
                            <option value = "{{ $locationDropDownOption->id }}"
                                @if(isset($user['userDetail']->location_id))
                                    {{ $locationDropDownOption->id ==  $user['userDetail']->location_id ? 'selected="selected"' : '' }}
                                @endif  >
                                {{ $locationDropDownOption->location}}
                            </option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="postal_code_id" class=" control-label">Postal Code:</label>
                <input type="hidden" class="form-control" id="postal_code_id" name="postal_code_id"
                    value="{{ isset($user['UserDetail']->postal_code_id) ? $user['UserDetail']->postal_code_id : old('postal_code_id') }}" />
                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code"
                    value="{{ isset($user['UserDetail']->postal_code_id) ? $user['UserDetail']['postalCode']->postal_code : old('postal_code') }}" maxlength="6" />
                @if ($errors->has('postal_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('postal_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom:10px">
        <div class="form-group" style="padding:10px">
            <div class="col-sm-12">
                <label for="notes" class=" control-label">Notes:</label>
                <textarea id='notes' name="notes" style="height:50px; width:100%">{{ isset($user['userDetail']->notes) ? $user['userDetail']->notes : old('notes') }}</textarea>
            </div>
        </div>
    </div>
	@if (Auth::user()->isAdmin())
	    <div id='waiverPanel' class="row col-xs-12" style="padding-left:25px">
        <div class="panel panel-default" >
            <div class="panel-heading" >Waiver</div>
            <div class="panel-body" >
                <div class="row">
					<div class="form-group" >
                        <label for="waiverPanel" class="col-sm-1 control-label"></label>
                            <div class=" col-sm-3">
                                Waiver on file
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="waiver_complete" value=0 />
                                    <input id="waiver_complete" name="waiver_complete" type="checkbox" value="1"
                                        {{ isset($user['userDetail']->waiver_complete)  ? $user['userDetail']->waiver_complete == 1 ? 'checked' : '' : '' }}
                                    />
                                    <label for="waiver_complete" class="label-primary"></label>
                                </div>
                            </div>
							<div class=" col-sm-4">
                                Catch pole training
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="catch_pole" value=0 />
                                    <input id="catch_pole" name="catch_pole" type="checkbox" value="1"
                                        {{ isset($user['userDetail']->catch_pole)  ? $user['userDetail']->catch_pole == 1 ? 'checked' : '' : '' }}
                                    />
                                    <label for="catch_pole" class="label-primary"></label>
                                </div>
                         	</div>
						
						</div>
                	</div>
            	</div>
        	</div>
    	</div>						
							
    <div id='rolePanel' class="row col-xs-12" style="padding-left:25px">
        <div class="panel panel-default" >
            <div class="panel-heading" >Roles</div>
            <div class="panel-body" >
                <div class="row">
                    <div class="form-group" >
                        <label for="roles" class="col-sm-1 control-label"></label>
                        <ul>
                            <div class=" col-sm-3">
                                Hotline
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="hotline" value=0 />
                                    <input id="hotline" name="hotline" type="checkbox" value="1"
                                        {{ isset($user['userDetail']['role']->hotline)  ? $user['userDetail']['role']->hotline == 1 ? 'checked' : '' : '' }}
                                    />
                                    <label for="hotline" class="label-primary"></label>
                                </div>
                            </div>
                            <div class=" col-sm-4">
                                Rescue
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="rescue" value=0 />
                                    <input id="rescue" name="rescue" type="checkbox" value="1"
                                        {{ isset($user['userDetail']['role']->rescue)  ? $user['userDetail']['role']->rescue == 1 ? 'checked' : '' : '' }}
                                    />
                                    <label for="rescue" class="label-primary"></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                Transport
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="transport" value=0 />
                                    <input id="transport" name="transport" type="checkbox" value="1"
                                        {{ isset($user['userDetail']['role']->transport)  ? $user['userDetail']['role']->transport == 1 ? 'checked' : '' : '' }}
                                    />
                                    <label for="transport" class="label-primary"></label>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" >
                        <label for="roles" class="col-sm-1 control-label" ></label>
                        <ul>
                            <div class=" col-sm-3">
                                Events
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="event" value=0 />
                                    <input id="event" name="event" type="checkbox"  value="1"
                                        {{ isset($user['userDetail']['role']->event)  ? $user['userDetail']['role']->event == 1 ? 'checked' : '' : '' }}
                                    />
                                    <label for="event" class="label-primary"></label>
                                </div>
                            </div>
                            <div class=" col-sm-4">
                                Fundraising
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="fundraising" value=0 />
                                    <input id="fundraising" name="fundraising" type="checkbox" value="1"
                                        {{ isset($user['userDetail']['role']->fundraising)  ? $user['userDetail']['role']->fundraising == 1 ? 'checked' : '' : '' }}
                                    />
                                    <label for="fundraising" class="label-primary"></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                Management
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="management" value=0 />
                                     @if (Auth::user()->isAdmin())
                                        <input  id="management" name="management" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->management)  ? $user['userDetail']['role']->management == 1 ? 'checked' : '' : '' }}
                                        />
                                    @else
                                        <input disabled id="management" name="management" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->management)  ? $user['userDetail']['role']->management == 1 ? 'checked' : '' : '' }}
                                        />
                                    @endif

                                    <label for="management" class="label-primary"></label>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" >
                        <label for="roles" class="col-sm-1 control-label"></label>
                        <ul>
                            <div class=" col-sm-3">
                                Board
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="board" value=0 />
                                     @if (Auth::user()->isAdmin())
                                        <input id="board" name="board" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->board)  ? $user['userDetail']['role']->board == 1 ? 'checked' : '' : '' }}
                                        />
                                    @else
                                        <input disabled id="board" name="board" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->board)  ? $user['userDetail']['role']->board == 1 ? 'checked' : '' : '' }}
                                        />
                                    @endif
                                    <label for="board" class="label-primary"></label>
                                </div>
                            </div>
                            <div class=" col-sm-4">
                                Rehabilitator
                                <div class="material-switch pull-right">
                                    <input type="hidden" name="rehabilitator" value=0 />
                                    @if (Auth::user()->isAdmin())
                                        <input  id="rehabilitator" name="rehabilitator" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->rehabilitator)  ? $user['userDetail']['role']->rehabilitator == 1 ? 'checked' : '' : '' }}
                                        />
                                    @else
                                        <input disabled id="rehabilitator" name="rehabilitator" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->rehabilitator)  ? $user['userDetail']['role']->rehabilitator == 1 ? 'checked' : '' : '' }}
                                        />
                                    @endif

                                    <label for="rehabilitator" class="label-primary"></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                Veterinarian
                                <div class="material-switch pull-right disabled">
                                    <input type="hidden" name="veterinarian" value=0 />
                                    @if (Auth::user()->isAdmin())
                                        <input id="veterinarian" name="veterinarian" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->veterinarian)  ? $user['userDetail']['role']->veterinarian == 1 ? 'checked' : '' : '' }}
                                        />
                                    @else
                                        <input disabled id="veterinarian" name="veterinarian" type="checkbox" value="1"
                                            {{ isset($user['userDetail']['role']->veterinarian)  ? $user['userDetail']['role']->veterinarian == 1 ? 'checked' : '' : '' }}
                                        />
                                    @endif

                                    <label for="veterinarian" class="label-primary"></label>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='row' style="padding-left:15px">
        <div id='HotlinePanel' class="row col-xs-6" style="padding-left:25px">
            <div class="panel panel-default" >
                <div class="panel-heading" >Hotline</div>
                <div class="panel-body" >
                    <div class="row">
                        <div class="form-group" >
                            <label for="hotline_mentor" class=" col-sm-8 control-label" style='padding-top:15px'>Hotline Mentor:</label>
                            <div class=" col-sm-4" style='padding-top:15px'>
                                <div class="material-switch">
                                    <input type="hidden" name="hotline_mentor" value=0 />
                                    <input id="hotline_mentor" name="hotline_mentor" type="checkbox" value="1"
                                        {{ isset($user['userDetail']->hotline_mentor)  ? $user['userDetail']->hotline_mentor == 1 ? 'checked' : '' : '' }} />
                                    <label for="hotline_mentor" class="label-primary"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id='RescuePanel' class="row col-xs-6" style="padding-left:25px">
            <div class="panel panel-default" >
                <div class="panel-heading" >Rescue</div>
                <div class="panel-body" >
                    <div class="row">
                        <div class="form-group" >
                            <label for="rabies" class=" col-sm-8 control-label" style='padding-top:15px'>Rescue Mentor:</label>
                            <div class=" col-sm-4" style='padding-top:15px'>
                                <div class="material-switch">
                                    <input type="hidden" name="rescue_mentor" value=0 />
                                    <input id="rescue_mentor" name="rescue_mentor" type="checkbox" value="1"
                                        {{ isset($user['userDetail']->rescue_mentor)  ? $user['userDetail']->rescue_mentor == 1 ? 'checked' : '' : '' }} />
                                    <label for="rescue_mentor" class="label-primary"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='row ' style="padding-left:15px" >
        <div id='ManagementPanel' class="row col-xs-6" style="padding-left:25px">
            <div class="panel panel-default" >
                <div class="panel-heading" >Management Committee</div>
                <div class="panel-body" >
                    <div class="row">
                        <div class="form-group" >
                            <div class="col-sm-12">
                                <label for="management_position" class="control-label">Position:</label>
                                <input type="text" class="form-control" id="management_position" name="management_position" placeholder="Position"
                                    value="{{ isset($user['UserDetail']->management_position) ? $user['UserDetail']->management_position :  old('management_position') }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id='BoardPanel' class="row col-xs-6" style="padding-left:25px">
            <div class="panel panel-default" >
                <div class="panel-heading" >Board of Directors</div>
                <div class="panel-body" >
                    <div class="row">
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <label for="board_position" class=" control-label">Position:</label>
                                <input type="text" class="form-control" id="board_position" name="board_position" placeholder="Position"
                                    value="{{ isset($user['UserDetail']->board_position) ? $user['UserDetail']->board_position :  old('board_position') }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='row' style="padding-left:15px" >
        <div id='RehabPanel' class="row col-xs-6" style="padding-left:25px">
            <div class="panel panel-default" >
                <div class="panel-heading" >Rehabilitator</div>
                <div class="panel-body" >
                    <div class="row" style="padding-bottom:10px">
                        <div class="form-group" style="padding:10px">
                            <div class="col-xs-12">
                                <label for="rehab_center" class=" control-label">Center Name:</label>
                                <input type="text" class="form-control" id="rehab_center" name="rehab_center" placeholder="Center Name"
                                    value="{{ isset($user['UserDetail']->rehab_center) ? $user['UserDetail']->rehab_center :  old('rehab_center') }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id='VetPanel' class="row col-xs-6" style="padding-left:25px">
            <div class="panel panel-default" >
                <div class="panel-heading" >Veterinarian</div>
                <div class="panel-body" >
                    <div class="row" style="padding-bottom:10px">
                        <div class="form-group" style="padding:10px">
                            <div class="col-xs-12">
                                <label for="vet_clinic" class=" control-label">Clinic Name:</label>
                                <input type="text" class="form-control" id="vet_clinic" name="vet_clinic" placeholder="Clinic Name"
                                    value="{{ isset($user['UserDetail']->vet_clinic) ? $user['UserDetail']->vet_clinic :  old('vet_clinic') }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	@endif
</fieldset>


<script>
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

    checkToggles();
    $('#hotline').click(function() {
        $("#HotlinePanel").fadeToggle(this.checked);
    });
    $('#rescue').click(function() {
        $("#RescuePanel").fadeToggle(this.checked);
    });
    $('#management').on('click',function() {
        $("#ManagementPanel").fadeToggle(this.checked);
    });
    $('#board').click(function() {
        $("#BoardPanel").fadeToggle(this.checked);
    });
    $('#rehabilitator').click(function() {
        $("#RehabPanel").fadeToggle(this.checked);
    });
    $('#veterinarian').click(function() {
        $("#VetPanel").fadeToggle(this.checked);
    });

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
        $.ajax({url: url, type: 'GET'})
          .done(function(response){
            $('#postal_code_id').value = response[0].id;
            $('#postal_code').value = response[0].postal_code;

          })
    });
});

function checkToggles(){
    if ($('#rescue').is(':checked')) {
        $("#RescuePanel").show();
    } else {
        $("#RescuePanel").hide();
    }

    if ($('#hotline').is(':checked')) {
        $("#HotlinePanel").show();
    } else {
        $("#HotlinePanel").hide();
    }

    if ($('#management').is(':checked')) {
        $("#ManagementPanel").show();
    } else {
        $("#ManagementPanel").hide();
    }

    if ($('#board').is(':checked')) {
        $("#BoardPanel").show();
    } else {
        $("#BoardPanel").hide();
    }

    if ($('#rehabilitator').is(':checked')) {
        $("#RehabPanel").show();

    } else {
        $("#RehabPanel").hide();
    }

    if ($('#veterinarian').is(':checked')) {
        $("#VetPanel").show();
    } else {
        $("#VetPanel").hide();
    }
}
</script>
