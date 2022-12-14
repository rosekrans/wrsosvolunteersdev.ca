<fieldset>
    @if ( isset($member->expire_at)  )
        @if ($member->expire_at < date("Y-m-d") )
            <div class="row" style="padding:10px">
                <div class="alert alert-danger" style='font-size:16px'>
                    Membership Expired!
                </div>
            </div>
        @endif
    @endif
    <div id='contactPanel' class="row col-xs-12" style="padding-left:25px">
        <div class="panel panel-default" >
            <div class="panel-heading" >Contact Details</div>
                <div class="panel-body" >
                    <div class="row" style="padding-bottom:10px">
                        <div class="form-group" style="padding:10px">
                            <div class='col-sm-6'>
                                <label for="first_name" class=" control-label">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ isset($member->first_name) ? $member->first_name : old('first_name') }}"  />
                            </div>
                            <div class='col-sm-6'>
                                <label for="last_name" class="control-label">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value= "{{ isset($member->last_name) ? $member->last_name : old('last_name') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:10px">
                        <div class="form-group" style="padding:10px">
                            <div class="col-sm-8">
                                <label for="email" class="control-label">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ isset($member->email) ? $member->email : old('email') }}"  />
                            </div>
                            <div class="col-sm-4" style='padding-left:0px'>
                                <label for="primary_number" class="control-label ">Phone Number:</label>
                                <input type="text" class="form-control phone" id="phone_number" name="phone_number" placeholder="Primary #" maxlength="12" value="{{ isset($member->phone_number) ? $member->phone_number :  old('phone_number') }}"/>
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
                                                @if(isset($member->location_id))
                                                    {{ $locationDropDownOption->id ==  $member->location_id ? 'selected="selected"' : '' }}
                                                @endif  >
                                                {{ $locationDropDownOption->location}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="postal_id" class=" control-label">Postal Code:</label>
                                <input type="hidden" class="form-control" id="postal_id" name="postal_id"
                                    value="{{ isset($member->postal_id) ? $member->postal_id : old('postal_id') }}" />
                                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code"
                                    value="{{ isset($member->postal_id) ? $member['postal']->postal_code : old('postal_code') }}" maxlength="6" />
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
                                <label for="address" class=" control-label">Address:</label>
                                <textarea id='address' name="address" style="height:50px; width:100%">{{ isset($member->address) ? $member->address : old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='membershipPanel' class="row col-xs-12" style="padding-left:25px">
        <div class="panel panel-default" >
            <div class="panel-heading" >Membership Details</div>
            <div class="panel-body" >
                @if ( isset($member->created_at) )
                <div class="row" style="padding:10px">
                    <div class="alert alert-info" style='font-size:16px'>
                        Member Since: {{ date_format($member->created_at, 'F d, Y') }}
                    </div>
                </div>
                @endif
                <div class="row" style="padding-bottom:10px">
                    <div class="form-group" style="padding:10px">
                        <div class='col-sm-4'>
                            <label class='control-label' for='expire_at'>Expiry Date:</label>
                            <div class= 'input-group'>
                                <input id="expire_at" name="expire_at" placeholder="YYYY-MM-DD" type='text' class="form-control "
                                    value="{{ isset($member->expire_at) ? Carbon\Carbon::parse($member->expire_at)->format('Y-m-d') : old('expire_at')  }}"  />
                                <div class='input-group-addon'>
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class='col-sm-4'>
                            <label class='control-label' for='payment_at'>Last Payment Date:</label>
                            <div class= 'input-group'>
                                <input id="payment_at" name="payment_at" placeholder="YYYY-MM-DD" type='text' class="form-control "
                                    value="{{ isset($member->payment_at) ? Carbon\Carbon::parse($member->payment_at)->format('Y-m-d') : old('payment_at')  }}"  />
                                <div class='input-group-addon'>
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class='col-sm-2'>
                            <label for="complementary" class="control-label" >Complementary:</label>
                            <div class="material-switch" style='margin-top:5px; margin-left:10px'>
                                <input type="hidden" name="complementary" value=0 />
                                <input id="complementary" name="complementary" type="checkbox" value="1"
                                    {{ isset($member->complementary)  ? $member->complementary == 1 ? 'checked' : '' : '' }} />
                                <label for="complementary" class="label-primary"></label>
                            </div>

                        </div>
                        @if (isset($member->id))
                        <div class='col-sm-2'>
                            <label for="cancel" class="control-label" >Cancel:</label>
                            <div style="margin-top: 5px;">
                                <a style="color: #b36362" href="{{ route('membership.delete', $member->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Cancel Membership'   ><i class='fas fa-times fa-2x' ></i></a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row" style="padding-bottom:10px">
                    <div class="form-group" style="padding:10px">
                        <div class="col-sm-12">
                            <label for="notes" class=" control-label">Notes:</label>
                            <textarea id='notes' name="notes" style="height:50px; width:100%">{{ isset($member->notes) ? $member->notes : old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>


<script>
$( function() {

    $('#expire_at, #payment_at').datetimepicker({
        dateFormat: 'yy-mm-dd',
        controlType: 'select'
    });

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
                $("#postal_id").val(value);
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
            $('#postal_id').value = response[0].id;
            $('#postal_code').value = response[0].postal_code;

          })
    });
});

</script>
