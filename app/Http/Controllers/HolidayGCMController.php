<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HolidayGCMExport;


class HolidayGCMController extends Controller
{
    public function index(Request $request)
    {
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId')
        ]);
        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterHolidayAPI/GetAllMasterHoliday"; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($data);
        
        return view('holiday_gcm',[
            'Holidays' => $data,
            'session' => $session            
            ]);    
    }

    public function add(Request $request)
    {
        $data = json_encode(array(
            "Description" => "$request->description_holiday_add",
            "TanggalHoliday" => "$request->tanggal_holiday_add",
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterHolidayAPI/CreateOrUpdateMasterHolidayCMS"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $hasils = json_decode($result);
        // dd($result);

        return redirect('/holiday-gcm')->with('success','Master Holiday Successfully Added !!!');;
    }

    public function update(Request $request)
    {
        $data = json_encode(array(
            "Id"=>"$request->id_holiday_update",
            "Description" => "$request->description_holiday_update",
            "TanggalHoliday" => "$request->tanggal_holiday_update",
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterHolidayAPI/CreateOrUpdateMasterHolidayCMS"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $hasils = json_decode($result);
        // dd($result);

        return redirect('/holiday-gcm')->with('success','Master Holiday Successfully Updated !!!');
    }

    public function delete($id=null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterHolidayAPI/DeleteMasterHolidayCMS?HolidayCMSId=".$id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($result);

        return redirect('/holiday-gcm')->with('success','Master Holiday Successfully Deleted !!!');
    }

    public function show(Request $request)
    {
        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterHolidayAPI/GetHolidayCMSById?HolidayCMSId=".$request->Id; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($Hasil);
        return json_encode($val);
    }

    public function download()
    {
        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterHolidayAPI/GetAllMasterHoliday"; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        $data=[];
        foreach ($Hasils as $Hasil) {

       
          array_push($data,[
              "Id"=>$Hasil->HolidayCMS->Id,
              "TanggalHoliday"=>$Hasil->HolidayCMS->TanggalHoliday,
              "Description"=>$Hasil->HolidayCMS->Description,
          ]);
        }
        // dd($data);
      
        return Excel::download(new HolidayGCMExport($data), 'accone Master Holiday '. date("Y-m-d") .'.xlsx');
    }
}
