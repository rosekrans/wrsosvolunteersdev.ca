<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactVeterinarian as Veterinarian;
use App\Models\Location;
use Auth;

class VeterinarianController extends Controller
{

    public function index(){
        $data['veterinarians'] = Veterinarian::with('location')->get(); 
        
        return view('contacts.veterinarian.index', $data);
        
    }

    public function show($id){

        $data['veterinarian'] = Veterinarian::find($id); 

        $data['locationDropDownOptions'] = Location::all();  

        return view('contacts.veterinarian.show', $data);
    }


    public function create() {
        if(!Auth::user()->isAdmin()){
            return redirect()->back();
        }

        $data['locationDropDownOptions'] = Location::all(); 

        return view('contacts.veterinarian.create', $data);
    }

    public function store(Request $request)
    {
        if($request){          

            $veterinarian = Veterinarian::create($request->toArray()); 

            return redirect()->route('veterinarian.index')->with(['status'=>'Veterinarian Contact Created.' , 'statusCode'=>0]);     
        } else {
            return redirect()->back()->with(['status'=>'Form Submission Error!', 'statusCode'=>1]);
        }
    }

    public function edit($id)
    {
        $data['veterinarian'] = Veterinarian::find($id); 

        $data['locationDropDownOptions'] = Location::all();  

        return view('contacts.veterinarian.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $veterinarian = Veterinarian::find($id);

            foreach($veterinarian->getAttributes() as $key=>$value ){
                if ($request->has($key)){                        
                    $veterinarian->update([$key => ($request->input($key))] );
                }
            } 

            return redirect()->route('veterinarian.index')->with(['status'=>'Contact Updated!','statusCode' => 0]);
        } catch (\PDOException $e) {
            return redirect()->back()->with(['status' => 'Unable to Update Contact!', 'statusCode' => 1 ]);
        }
    }

    public function delete($id)
    {
        $data = Veterinarian::find($id); 
        
        $data->delete();

        return redirect()->back()->with(['status'=>'Veterinarian Contact Deleted!','statusCode' => 0]);
    }
}
