<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactOther as Other;
use App\Models\ContactType as Type;
use App\Models\Location;
use Auth;

class OtherContactController extends Controller
{
   public function index()
    {
        $data['others'] = Other::with(['location','contactType'])->orderBy('Contact_Name','asc')->get();   
        
        return view('contacts.other.index', $data);        
    }


    public function create() {
        if(!Auth::user()->isAdmin()){
            return redirect()->back();
        }

        $data['locationDropDownOptions'] = Location::all(); 
        $data['typeDropDownOptions'] = Type::all(); 

        return view('contacts.other.create', $data);
    }

    public function store(Request $request)
    {
        if($request){          

            $other = Other::create($request->toArray()); 

            return redirect()->route('other.index')->with(['status'=>'Other Contact Created.' , 'statusCode'=>0]);  
        } else {
            return redirect()->back()->with(['status'=>'Form Submission Error!', 'statusCode'=>1]);
        }
    }

    public function edit($id)
    {
        $data['other'] = Other::find($id); 

        $data['locationDropDownOptions'] = Location::all(); 
        $data['typeDropDownOptions'] = Type::all();  

        return view('contacts.other.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $other = Other::find($id);

            foreach($other->getAttributes() as $key=>$value ){
                if ($request->has($key)){                        
                    $other->update([$key => ($request->input($key))] );
                }
            } 

            return redirect()->route('other.index')->with(['status'=>'Other Contact Updated!','statusCode' => 0]);
        } catch (\PDOException $e) {
            return redirect()->back()->with(['status' => 'Unable to Update Contact!', 'statusCode' => 1 ]);
        }
    }

    public function show($id){
        $data['other'] = Other::find($id); 

        $data['locationDropDownOptions'] = Location::all(); 
        $data['typeDropDownOptions'] = Type::all(); 

        return view('contacts.other.show', $data);
    }

    public function delete($id)
    {
        $data = Other::find($id); 
        
        $data->delete();

        return redirect()->back()->with(['status'=>'Other Contact Deleted!','statusCode' => 0]);
    }
}
