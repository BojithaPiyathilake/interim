<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Crime_report;
use App\Models\User;
use App\Models\Process_item;
class Crime_reportController extends Controller
{
    //
    public function index()
    {
    
        $Crime_report = new Crime_report;

    }
//
    public function crimehome()
    {
    
        $Check = "{{ Auth::user()->role }}";
        if ($Check=='5'){
            return view('general.crimeChome');
        }
        else{
            return view('welcome');
        }
        

    }

    public function assignauth(Request $request)
    {
        $request -> validate([
            'organization' => 'required|not_in:0',
            'create_by' => 'required',
            'authority_id' => 'required',
            'crimeid' => 'required',
            'comment'=>'required',
        ]);
        $Process_item =new Process_item;
        $Process_item->Created_by_user_id = $request['create_by'];
        $Process_item->activity_organization = $request['organization'];
        $Process_item->activity_user_id = $request['authority_id'];
        $Process_item->prerequisite = "4";
        $Process_item->prerequsite_id = $request['crimeid'];
        $Process_item->requst_organization = "0";
        $Process_item->status = "0";
        $Process_item->remark = $request['comment'];
        $Process_item->save();
        return view('general.general');
        
    }
    public function show($id) {
        
        $crime = Crime_report::find($id);
        $Users =User::all()->where('role',3);
        return view('general.crimeAssign',['crime' => $crime],['Users' => $Users],);
    }

    /* public function show($organization) {
        $crime = Crime_report::find($id);
        $users = User::all()->where('organization',$organization);
        return view('crimeAssign',['crime'=>$crime,],['users'=>$users,
        ]);
    } */

    public function track(Request $request)
    {
        $id=$request['create_by'];
        $Crimes = Crime_report::all()->where('created_by_user_id',$id)->toArray();
        return view('general.trackCrime',compact('Crimes'));
        //return view('index',['crime_repor'=>$users]);

    }

    public function admin()
    {
        // $id=$request['create_by'];
        $Crimes = Crime_report::all()->where('status',0)->toArray();
        return view('general.crimeAhome',compact('Crimes'));
        //return view('index',['crime_repor'=>$users]);

    }


    public function create(Request $request)
    {
        //ddd($request);
        $request -> validate([
            'crime_type' => 'required|not_in:0',
            'description' => 'required',
            'location' => 'required',
            'confirm' => 'required',
            'create_by'=>'required',
        ]);
        
        $Crime_report = new Crime_report;
        $Crime_report->Created_by_user_id = $request['create_by'];
        $Crime_report->crime_type = $request['crime_type'];
        $Crime_report->description = $request['description'];
        $Crime_report->polygon = $request['location'];
        $Crime_report->action_taken = "0";
        $Crime_report->status = "0";
        $Crime_report->save();
        return view('general.logComplaint',);

        
        
    }

    public function searchauth(Request $request){

        $request -> validate([
            'organization1' => 'required|not_in:0',
            'role' => 'required|not_in:0',
        ]);

        $id=$request['crimeid'];
        $Users = User::all()->where('organization_id',$request['organization1'])->where('role_id',$request['role']);
        $crime = Crime_report::find($id);
        return view('general.crimeAssign',['crime' => $crime],['Users'=>$Users,
        ]);
        
    }
}