<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //
    public function index(){
        $customers = Customer::all();
        $hocvienthidau = DB::table('customers')->where('statusExam','Đậu')->get();
        $rotlythuyet = DB::table('customers')->where('statusExam','Rớt lý thuyết')->get();
        $rotthuchanh = DB::table('customers')->where('statusExam','Rớt thực hành')->get();
        return response()->json(['customer'=>$customers,'hocviendau'=>$hocvienthidau,'rotlythuyet'=>$rotlythuyet,'rotthuchanh'=>$rotthuchanh]);
    }
   
    public function all( Request $request)
    {
        $customers = Customer::all();
        if ( $request->input('client') ) {
    	    return Customer::select('id','CodeCustomer','name','birthday','phone',
            'address','location','Type','Owner','Facebook','dukienthi',
            'createdBy','photo','email','school','first','datefirst','second',
            'datesecond','third','datethird','fourth','datefour','healthyMoney','statusExam','needMoney')->get();
    	}

        $columns = ['id','CodeCustomer','name','birthday','phone',
        'address','location','Type','Owner','Facebook','dukienthi',
        'createdBy','photo','email','school','first','datefirst','second',
        'datesecond','third','datethird','fourth','datefour','healthyMoney','statusExam','needMoney'];

        $length = $request->input('length');
        // dd($length);
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Customer::select('id','CodeCustomer','name','birthday','phone',
        'address','location','Type','Owner','Facebook','dukienthi',
        'createdBy','photo','email','school','first','datefirst','second',
        'datesecond','third','datethird','fourth','datefour','healthyMoney','statusExam','needMoney')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('phone', 'like', '%' . $searchValue . '%')
                ->orWhere('CodeCustomer', 'like', '%' . $searchValue . '%');
            });
        }

        $data = $query->paginate($length);
        return response()->json(['customers'=>$customers,'data' => $data, 'draw' => $request->input('draw')]);
    }
    public function get($id)
    {

        $customer = Customer::find($id);
        return response()->json([
            'customer' => $customer
        ], 200);
    }
    public function editcustomer(Request $request, $id){
        $customer = Customer::findOrFail($id);
        $needMoney = (int)$request['totalMoney'] - (int)$request['first'] - (int)$request['second'] -(int)$request['thirddday']-(int)$request['fourday'];
      
        $name =$request['name']; 
        if($request->file('image') != null){
            $photoName = $name.'.'.$request->file('image')->extension();
           $customer->name = $request['name'];
           $customer->birthday = $request['birthday'];
           $customer->phone = $request['phone'];
           $customer->address = $request['address'];
           $customer->location = $request['location'];
           $customer->Owner = $request['Owner'];
           $customer->Facebook = $request['Facebook'];
           $customer->dukienthi = $request['dukienthi'];
           $customer->photo = $photoName;
           $customer->email = $request['email'];
           $customer->school = $request['school'];
           $customer->Type = $request['type'];
           $customer->first = $request['first'];
           $customer->second = $request['second'];
           $customer->third = $request['third'];
           $customer->fourth = $request['four'];
           $customer->datefirst = $request['firstday'];
           $customer->datesecond = $request['secondday'];
           $customer->datethird = $request['thirddday'];
           $customer->datefour = $request['fourday'];
           $customer->dayhealth=$request['dayhealth'];
           $customer->healthyMoney=$request['healthyMoney'];
           $customer->totalMoney=$request['totalMoney'];
           $customer->statusExam=$request['status'];
           $customer->needMoney= $needMoney;
        $customer->save();
        return response()->json(['mesg'=>'update successfull']);
        }else{
            $customer->name = $request['name'];
            $customer->birthday = $request['birthday'];
            $customer->phone = $request['phone'];
            $customer->address = $request['address'];
            $customer->location = $request['location'];
            $customer->Owner = $request['Owner'];
            $customer->Facebook = $request['Facebook'];
            $customer->dukienthi = $request['dukienthi'];
            $customer->email = $request['email'];
            $customer->school = $request['school'];
            $customer->Type = $request['type'];
            $customer->first = $request['first'];
            $customer->second = $request['second'];
            $customer->third = $request['third'];
            $customer->fourth = $request['four'];
            $customer->datefirst = $request['firstday'];
            $customer->datesecond = $request['secondday'];
            $customer->datethird = $request['thirddday'];
            $customer->datefour = $request['fourday'];
            $customer->dayhealth=$request['dayhealth'];
            $customer->healthyMoney=$request['healthyMoney'];
            $customer->totalMoney=$request['totalMoney'];
            $customer->statusExam=$request['status'];
            $customer->needMoney= $needMoney;

            $customer->save();
            return response()->json(['mesg'=>'update successfull']);
        }
        
    }
    public function new(Request $request)
    {
        $phone = $request['phone'];
        $checkphone = DB::table('customers')->where('phone',$phone)->first();
        $name =$request['name']; 
        $type = $request['type'];
        if($type === 'B2'){
            $totalMoney = 12000000;
        }if($type === 'C'){
            $totalMoney = 15000000;
        }else{
            $totalMoney = 14000000;
        }
        $needMoney = (int)$totalMoney - (int)$request['first'] - (int)$request['second'] -(int)$request['thirddday']-(int)$request['fourday'];
        if($checkphone == null){
            if($request->file('image') != null){
                $photoName = $name.'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads'),$photoName);
                $customer = Customer::create([
                    "CodeCustomer"=> $request['CodeCustomer'],
                    "name"=> $name,
                    "birthday"=> $request['birthday'],
                    "phone"=> $request['phone'],
                    "address"=> $request['address'],
                    "location"=> $request['location'],
                    "Owner"=> $request['Owner'],
                    "Facebook"=> $request['Facebook'],
                    "dukienthi"=> $request['dukienthi'],
                    "createdBy"=> $request['createBy'],
                    "photo"=>  $photoName ,
                    "email"=> $request['email'],
                    "school"=> $request['school'],
                    "Type"=>$request['type'],
                    "first"=>  $request['first'],
                    "second"=> $request['second'],
                    "third"=> $request['third'],
                    "four"=>$request['fourth'],
                    "datefirst"=> $request['firstday'],
                    "datesecond"=> $request['secondday'],
                    "datethird"=> $request['thirddday'],
                    "datefour"=>$request['fourday'],
                    'dayhealth'=>$request['dayhealth'],
                    "healthyMoney"=>$request['healthyMoney'],
                    "totalMoney"=>$totalMoney,
                    "needMoney"=> $needMoney

                ]);
                return response()->json(['customer' => $customer], 200);
            }else{
    
                $customer = Customer::create([
                    "CodeCustomer"=> $request['CodeCustomer'],
                    "name"=> $name,
                    "birthday"=> $request['birthday'],
                    "phone"=> $request['phone'],
                    "address"=> $request['address'],
                    "location"=> $request['location'],
                    "Owner"=> $request['Owner'],
                    "Facebook"=> $request['Facebook'],
                    "dukienthi"=> $request['dukienthi'],
                    "createdBy"=> $request['createBy'],
                    "email"=> $request['email'],
                    "school"=> $request['school'],
                    "Type"=>$request['type'],
                    "first"=>  $request['first'],
                    "second"=> $request['second'],
                    "third"=> $request['third'],
                    "four"=>$request['fourth'],
                    "datefirst"=>  $request['firstday'],
                    "datesecond"=> $request['secondday'],
                    "datethird"=> $request['thirddday'],
                    "datefour"=>$request['fourday'],
                    'dayhealth'=>$request['dayhealth'],
                    "healthyMoney"=>$request['healthyMoney'],
                    "totalMoney"=>$totalMoney,
                    "needMoney"=> $needMoney

                ]);
               
               
                return response()->json(['customer' => $customer], 200);
            }
        }if($checkphone === $phone ){
            return response()->json(['mesg'=>'Mã học viên hoặc số điện thoại đã tồn tại vui lòng kiểm tra lại'],300);
        }


    }
 
    
}