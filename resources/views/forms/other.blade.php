
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-12">
            <label for="contact_name" class=" control-label">Contact Name:</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name"  
                value="{{ isset($other->contact_name) ? $other->contact_name :  old('contact_name') }}"
            />
        </div>									
    </div>
</div>
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-6">
            <label for="contact_type_id" class=" control-label">Contact Type:</label>
            <select class="form-control" id="contact_type_id" name="contact_type_id">
                <option value="" disabled selected>Select Type</option>
                @foreach ($typeDropDownOptions as $typeDropDownOption)
                    <option value = "{{ $typeDropDownOption->id }}"
                        @if(isset($other->contact_type_id))
                            {{ $typeDropDownOption->id ==  $other->contact_type_id ? 'selected="selected"' : '' }}
                        @endif  >
                        {{ $typeDropDownOption-> contact_type}}
                    </option>                                
                @endforeach

            </select>
        </div>
        <div class="col-sm-6">
            <label for="contact_number" class=" control-label">Contact Number:</label>
            <input type="text" class="phone form-control" id="contact_number" name="contact_number" placeholder="Contact Number"  
                value="{{ isset($other->contact_number) ? $other->contact_number :  old('contact_number') }}"
            />
        </div>										
    </div>
</div>							
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-6">
            <label for="location_id" class=" control-label">Location:</label>
            <select class="form-control" id="location_id" name="location_id">
                <option value="" disabled selected>Select Location</option>
                @foreach ($locationDropDownOptions as $locationDropDownOption)
                    <option value = "{{ $locationDropDownOption->id }}"
                        @if(isset($other->location_id))
                            {{ $locationDropDownOption->id ==  $other->location_id ? 'selected="selected"' : '' }}
                        @endif  >
                        {{ $locationDropDownOption->location}}
                    </option>                                
                @endforeach

            </select>
        </div>
        <div class="col-sm-6">
            <label for="email" class=" control-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email or Website"  
                value="{{ isset($other->email) ? $other->email :  old('email') }}"
            />
        </div>											
    </div>
</div>
									
<div class="row" style="padding-bottom:10px">
    <div class="form-group" style="padding:10px">
        <div class="col-sm-12">
            <label for="notes" class=" control-label">Notes:</label>									
            <textarea id='notes' name="notes" style="height:50px; width:100%">{{ isset($other->notes) ? $other->notes :  old('notes') }}</textarea>		
        </div>
    </div>
</div>									
