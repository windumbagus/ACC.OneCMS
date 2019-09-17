<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisteredContractController extends Controller
{
    public function index()
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetAllRegisteredContract"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('registered_contract',['Contracts'=>$Hasils]);  
    }

    public function show(Request $request)
    {
        // API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetRegisteredContractById?Id=".$request->Id; 
         $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val= json_decode($result);
        //  dd($val);
         return json_encode($val);
    }

    public function TransactionHistory(Request $request)
    {
        $data = json_encode(array(
            "MstRegisteredContractId"=>$request->Id,
            "NoKontrak"=>$request->ContractNo,
            "Username"=>$request->Username,
            )); 
        // $data = json_encode(array(
        //     "MstRegisteredContractId"=>"3333",
        //     "NoKontrak"=>"01100129001800019",
        //     "Username"=>"April1@mailinator.com",
        //     )); 
            // dd($data);
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/RegisteredContractAPI/GetAllTransactionHistoryRegisteredContractId"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result); 
        // dd($Hasils);
       $val= [
            "MstTransactionHistory"=> $Hasils,
            "MstRegisteredContractId"=>$request->Id,
            "NoKontrak"=>$request->ContractNo,
            "Username"=>$request->Username,
       ];
        return $val;
    }


    
}