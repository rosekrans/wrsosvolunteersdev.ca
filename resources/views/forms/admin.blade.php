<fieldset>
    <div class="col-xs-8 col-md-offset-1">
        <div class='row' >
            <div class="form-group" style="padding:10px">
                <div class="col-xs-6">                            
                    <label for="user_name" class="control-label">User Name:</label>
                    <div>
                        <input type="text" class="form-control ad" id="user_name" name="user_name" placeholder="UserID" 
                            value="{{ isset($user->user_name) ? $user->user_name : old('user_name') }}"
                        >
                    </div>
                </div>
            </div>
        </div>		

        <div class="row " >												
            <div class="form-group " style="padding:10px">
                <div class='col-xs-6' >
                    <label for="status" class="control-label">Status:</label>
                    <div>
                        <select class="form-control" id="status" name="status" >
                            <option value="" disabled selected>Select Status</option>
                            @foreach ($statusCodeDropDownOptions as $statusCodeDropDownOption)
                                <option value = "{{ $statusCodeDropDownOption->id }}"
                                    @if(isset($user->status))
                                        {{ $statusCodeDropDownOption->id ==  $user->status ? 'selected="selected"' : '' }}
                                    @endif  
                                >
                                    {{ $statusCodeDropDownOption->status_code}}
                                </option>
                                
                            @endforeach                                        
                        </select>
                    </div>
                </div>
                    
            </div>
        </div>
        <div class="row " >												
            <div class="form-group " style="padding:10px">  
                <div class='col-xs-6'>
                    <label for="isAdmin" class=" control-label">Access:</label>
                    <div>
                        <select class="form-control ad" id="isAdmin" name="isAdmin">
                            <option value = 0>Volunteer</option>
                            <option value = 1
                            @if(isset($user->isAdmin))
                                {{ $user->isAdmin ==  1 ? 'selected="selected"' : '' }}
                            @endif  
                            >Admin</option>																
                        </select>
                    </div>
                </div>											
            </div>
        </div>
    </div>                
</fieldset>	