<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactRehabilitator as Rehabilitator;
use App\Models\Location;
use Auth;

class RehabilitatorController extends Controller
{

    public function index()
    {
        $data['rehabilitators'] = Rehabilitator::with('location')->get();
   
        
        return view('contacts.rehabilitator.index', $data);        
    }


    public function create() {
        if(!Auth::user()->isAdmin()){
            return redirect()->back();
        }

        $data['locationDropDownOptions'] = Location::all(); 

        return view('contacts.rehabilitator.create', $data);
    }

    public function store(Request $request)
    {
        if($request){          

            $rehabilitator = Rehabilitator::create($request->toArray()); 

            return redirect()->route('rehabilitator.index')->with(['status'=>'Rehabilitator Contact Created.' , 'statusCode'=>0]);  
        } else {
            return redirect()->back()->with(['status'=>'Form Submission Error!', 'statusCode'=>1]);
        }
    }

    public function edit($id)
    {
        $data['rehabilitator'] = Rehabilitator::find($id); 

        $data['locationDropDownOptions'] = Location::all();  

        return view('contacts.rehabilitator.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $rehabilitator = Rehabilitator::find($id);

            foreach($rehabilitator->getAttributes() as $key=>$value ){
                if ($request->has($key)){                        
                    $rehabilitator->update([$key => ($request->input($key))] );
                }
            } 

            return redirect()->route('rehabilitator.index')->with(['status'=>'Rehabilitator Contact Updated!','statusCode' => 0]);
        } catch (\PDOException $e) {
            return redirect()->back()->with(['status' => 'Unable to Update Contact!', 'statusCode' => 1 ]);
        }
    }

    public function show($id){
        $data['rehabilitator'] = Rehabilitator::find($id); 

        $data['locationDropDownOptions'] = Location::all(); 

        return view('contacts.rehabilitator.show', $data);
    }

    public function delete($id)
    {
        $data = Rehabilitator::find($id); 
        
        $data->delete();

        return redirect()->back()->with(['status'=>'Rehabilitator Contact Deleted!','statusCode' => 0]);
    }
}
