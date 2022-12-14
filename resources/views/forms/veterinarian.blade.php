
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-12">
            <label for="clinic_name" class=" control-label">Clinic Name:</label>
            <input type="text" class="form-control" id="clinic_name" name="clinic_name" placeholder="Clinic Name" 
                value="{{ isset($veterinarian->clinic_name) ? $veterinarian->clinic_name :  old('clinic_name') }}"
            />
        </div>									
    </div>
</div>
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-8">
            <label for="contact_name" class=" control-label">Contact Name:</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" 
                value="{{ isset($veterinarian->contact_name) ? $veterinarian->contact_name :  old('contact_name') }}"
            />
        </div>
        <div class="col-sm-4">
            <label for="number" class=" control-label">Phone:</label>
            <input type="text" class="phone form-control" id="number" name="number" placeholder="Clinic Phone"  
                value="{{ isset($veterinarian->number) ? $veterinarian->number :  old('number') }}"
            />
        </div>										
    </div>
</div>
<div class="row" style="padding-bottom:10px">	
    <div class="form-group" style="padding:10px">
        <div class="col-sm-6">
            <label for="website" class=" control-label">Website:</label>
            <input type="text" class="form-control" id="website" name="website" placeholder="Clinic Website"  
                value="{{ isset($veterinarian->website) ? $veterinarian->website :  old('website') }}"
            />
        </div>
        <div class="col-sm-6">
            <label for="email" class=" control-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Clinic Email" 
                value="{{ isset($veterinarian->email) ? $veterinarian->email :  old('email') }}"
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
                            @if(isset($veterinarian->location_id))
                                {{ $locationDropDownOption->id ==  $veterinarian->location_id ? 'selected="selected"' : '' }}
                            @endif  >
                            {{ $locationDropDownOption->location}}
                        </option>                                
                    @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="address" class=" control-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Clinic Address"  
                value="{{ isset($veterinarian->address) ? $veterinarian->address :  old('address') }}"
            />
        </div>											
    </div>
</div>
<div class="row" style="padding-bottom:10px">
    <div class="form-group" style="padding:10px">
        <div class="col-sm-12">
            <label for="hours" class=" control-label">Hours:</label>									
            <input type="text" class="form-control" id="hours" name="hours" placeholder="Clinic Hours"  
                value="{{ isset($veterinarian->hours) ? $veterinarian->hours :  old('hours') }}"
            />		
        </div>
    </div>
</div>										
<div class="row" style="padding-bottom:10px">
    <div class="form-group" style="padding:10px">
        <div class="col-sm-12">
            <label for="notes" class=" control-label">Notes:</label>									
            <textarea id='notes' name="notes" style="height:50px; width:100%">{{ isset($veterinarian->notes) ? $veterinarian->notes :  old('notes') }}</textarea>		
        </div>
    </div>
</div>
