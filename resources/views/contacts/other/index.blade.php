@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <table style='width:100%'>
                    <tr>
                        <td>
                            <h4 class="panel-title" style='width: 50%'  >Other Contacts</h4>
                        </td>
                        <td style='width: 35%'>
                            <input class="panel-title " style='width: 100%' id="filterTable-input" data-type="search" placeholder="Search...">
                        </td>
                        @if(Auth::user()->isAdmin())
                        <td style='width: 15%'>                            
                            <a class='btn btn-default pull-right' href="{{ route('other.create') }}" >Add Contact</a>                            
                        </td> 
                        @endif                           
                    </tr>
                </table>
            </div>

            <div class="panel-body">
                <ul class="nav nav-tabs" id='otherTabs'>
                    <li class="active"><a data-toggle="tab" href="#EnviroTab" id="EnviroClick">Environmental Offices</a></li>
                    <li><a data-toggle="tab" href="#EmerTab" id="EmerClick">Emergency</a></li>
                    <li><a data-toggle="tab" href="#SpcaTab" id="SpcaClick">SPCA and Related</a></li>
                    <li><a data-toggle="tab" href="#PestTab" id="PestClick">Pest Control</a></li>
                    <li><a data-toggle="tab" href="#MiscTab" id="MiscClick">Miscellaneous</a></li>
                </ul>
                <div class="tab-content">
                    <div id="EnviroTab" class="tab tab-pane fade in active " style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>                    	
                                <th style="width: 20%" >Contact Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 10%; min-width:96px" >Primary Contact</th>
                                <th style="width: 15%" >Email or Website</th>	
                                <th style="width: 35%; min-width:192px" >Notes</th>	
                                <th style="width: 10%" colspan="2">Actions </th>			
                            </thead>
                            <tbody>
                                @foreach($others as $other)
                                @if($other->contact_type_id == 3)
                                    <tr id="{{$other->id}}" >
                                    <td style='vertical-align:middle;'>{{$other->contact_name}} </td>	
                                    <td style='vertical-align:middle;'>{{isset($other['location']->location) ? $other['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{$other->contact_number}}</td>
                                    <td style='vertical-align:middle;'>{{$other->email}}</td>
                                    <td style='vertical-align:middle;'>{{$other->notes}}</td>	
                                    <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Rabies Vaccinated'>
                                    </td>
                                    @if(Auth::user()->isAdmin())
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.edit', $other->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>       
                                            <a href="{{ route('other.delete', $other->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                        </td>
                                    @else
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.show', $other->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                        </td>
                                    @endif
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="EmerTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>                    	
                                <th style="width: 20%" >Contact Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 10%; min-width:96px" >Primary Contact</th>
                                <th style="width: 15%" >Email or Website</th>	
                                <th style="width: 35%; min-width:192px" >Notes</th>	
                                <th style="width: 10%" colspan="2">Actions </th>			
                            </thead>
                            <tbody>
                                @foreach($others as $other)
                                @if($other->contact_type_id == 2)
                                    <tr id="{{$other->id}}" >
                                    <td style='vertical-align:middle;'>{{$other->contact_name}} </td>	
                                    <td style='vertical-align:middle;'>{{isset($other['location']->location) ? $other['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{$other->contact_number}}</td>
                                    <td style='vertical-align:middle;'>{{$other->email}}</td>
                                    <td style='vertical-align:middle;'>{{$other->notes}}</td>	
                                    <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Rabies Vaccinated'>
                                    </td>
                                    @if(Auth::user()->isAdmin())
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.edit', $other->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>       
                                            <a href="{{ route('other.delete', $other->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                        </td>
                                    @else
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.show', $other->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                        </td>
                                    @endif
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="SpcaTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>                    	
                                <th style="width: 20%" >Contact Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 10%; min-width:96px" >Primary Contact</th>
                                <th style="width: 15%" >Email or Website</th>	
                                <th style="width: 35%; min-width:192px" >Notes</th>	
                                <th style="width: 10%" colspan="2">Actions </th>			
                            </thead>
                            <tbody>
                                @foreach($others as $other)
                                @if($other->contact_type_id == 1)
                                    <tr id="{{$other->id}}" >
                                    <td style='vertical-align:middle;'>{{$other->contact_name}} </td>	
                                    <td style='vertical-align:middle;'>{{isset($other['location']->location) ? $other['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{$other->contact_number}}</td>
                                    <td style='vertical-align:middle;'>{{$other->email}}</td>
                                    <td style='vertical-align:middle;'>{{$other->notes}}</td>	
                                    <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Rabies Vaccinated'>
                                    </td>
                                    @if(Auth::user()->isAdmin())
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.edit', $other->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>       
                                            <a href="{{ route('other.delete', $other->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                        </td>
                                    @else
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.show', $other->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                        </td>
                                    @endif
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="PestTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>                    	
                                <th style="width: 20%" >Contact Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 10%; min-width:96px" >Primary Contact</th>
                                <th style="width: 15%" >Email or Website</th>		
                                <th style="width: 35%; min-width:192px" >Notes</th>	
                                <th style="width: 10%" colspan="2">Actions </th>			
                            </thead>
                            <tbody>
                                @foreach($others as $other)
                                @if($other->contact_type_id == 4)
                                    <tr id="{{$other->id}}" >
                                    <td style='vertical-align:middle;'>{{$other->contact_name}} </td>	
                                    <td style='vertical-align:middle;'>{{isset($other['location']->location) ? $other['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{$other->contact_number}}</td>
                                    <td style='vertical-align:middle;'>{{$other->email}}</td>
                                    <td style='vertical-align:middle;'>{{$other->notes}}</td>	
                                    <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Rabies Vaccinated'>
                                    </td>
                                    @if(Auth::user()->isAdmin())
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.edit', $other->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>       
                                            <a href="{{ route('other.delete', $other->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                        </td>
                                    @else
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.show', $other->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                        </td>
                                    @endif
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                     <div id="MiscTab" class="tab tab-pane fade in" style='overflow: auto;'>
                        <table class="table table-striped table-hover tablesorter ui-responsive" id="contactTable" sytle='width:200vw' >
                            <thead>                    	
                                <th style="width: 20%" >Contact Name</th>
                                <th style="width: 10%" >Location</th>
                                <th style="width: 10%; min-width:96px" >Primary Contact</th>
                                <th style="width: 15%" >Email or Website</th>		
                                <th style="width: 35%; min-width:192px" >Notes</th>	
                                <th style="width: 10%" colspan="2">Actions </th>			
                            </thead>
                            <tbody>
                                @foreach($others as $other)
                                @if($other->contact_type_id == 5)
                                    <tr id="{{$other->id}}" >
                                    <td style='vertical-align:middle;'>{{$other->contact_name}} </td>	
                                    <td style='vertical-align:middle;'>{{isset($other['location']->location) ? $other['location']->location : '' }}</td>
                                    <td style='vertical-align:middle;'>{{$other->contact_number}}</td>
                                    <td style='vertical-align:middle;'>{{$other->email}}</td>
                                    <td style='vertical-align:middle;'>{{$other->notes}}</td>	
                                    <td style='vertical-align:middle;text-align:center; color: #45a04e;' data-toggle='tooltip' title='Rabies Vaccinated'>
                                    </td>
                                    @if(Auth::user()->isAdmin())
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.edit', $other->id ) }}" data-toggle='tooltip' title='Edit Contact' ><i class='fas fa-edit fa-lg' ></i></a>
                                        </td>
                                        <td style='vertical-align:middle'>       
                                            <a href="{{ route('other.delete', $other->id ) }}" onclick='return confirm("Are you sure?")' data-toggle='tooltip' title='Delete Contact'   ><i class='far fa-trash-alt fa-lg' ></i></a>
                                        </td>
                                    @else
                                        <td style='vertical-align:middle'>                                    
                                            <a href="{{ route('other.show', $other->id ) }}" data-toggle='tooltip' title='Show Contact' ><i class='fas fa-eye fa-lg' ></i></a>
                                        </td>
                                    @endif
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$( function() {

    $('#filterTable-input').keyup(function() {
        var $rows = $('#contactTable tbody tr');
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
});
</script>
                
    
@endsection