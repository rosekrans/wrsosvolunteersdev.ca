<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-xs-12">
            <label for="center_name" class=" control-label">Center Name:</label>
            <input type="text" class="form-control" id="center_name" name="center_name" placeholder="Center Name"  
                value="{{ isset($rehabilitator->center_name) ? $rehabilitator->center_name :  old('center_name') }}"
            />
        </div>									
    </div>
</div>
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-8">
            <label for="contact_name" class=" control-label">Contact Name:</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name"  
                value="{{ isset($rehabilitator->contact_name) ? $rehabilitator->contact_name :  old('contact_name') }}"
            />
        </div>
        <div class="col-sm-4">
            <label for="number" class=" control-label">Contact Number:</label>
            <input type="text" class="phone form-control" id="number" name="number" placeholder="Contact Number"  
                value="{{ isset($rehabilitator->number) ? $rehabilitator->number :  old('number') }}"
            />
        </div>										
    </div>
</div>
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-6">
            <label for="website" class=" control-label">Website:</label>
            <input type="text" class="form-control" id="website" name="website" placeholder="Center Website"  
                value="{{ isset($rehabilitator->website) ? $rehabilitator->website :  old('website') }}"
            />
        </div>
        <div class="col-sm-6">
            <label for="email" class=" control-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Center Email"  
                value="{{ isset($rehabilitator->email) ? $rehabilitator->email :  old('email') }}"
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
                        @if(isset($rehabilitator->location_id))
                            {{ $locationDropDownOption->id ==  $rehabilitator->location_id ? 'selected="selected"' : '' }}
                        @endif  >
                        {{ $locationDropDownOption->location}}
                    </option>                                
                @endforeach

            </select>
        </div>
        <div class="col-sm-6">
            <label for="address" class=" control-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Center Address"  
                value="{{ isset($rehabilitator->address) ? $rehabilitator->address :  old('address') }}"
            />
        </div>											
    </div>
</div>
<div class="row" style="padding-bottom:10px">
    <div class="form-group" style="padding:10px">
        <div class="col-sm-12">
            <label for="species_notes" class=" control-label">Species Notes:</label>									
            <textarea id='species_notes' name="species_notes" style="height:50px; width:100%">{{ isset($rehabilitator->species_notes) ? $rehabilitator->species_notes :  old('species_notes') }}</textarea>		
        </div>
    </div>
</div>										
<div class="row" style="padding-bottom:10px">
    <div class="form-group" style="padding:10px">
        <div class="col-sm-12">
            <label for="notes" class=" control-label">Notes:</label>									
            <textarea id='notes' name="notes" style="height:50px; width:100%">{{ isset($rehabilitator->notes) ? $rehabilitator->notes :  old('notes') }}</textarea>		
        </div>
    </div>
</div>									
