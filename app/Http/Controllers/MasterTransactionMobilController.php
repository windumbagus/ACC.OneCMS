<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MasterTransactionMobilExport;

class MasterTransactionMobilController extends Controller
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

         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterTransactionMobilAPI/GetAllMasterTransactionMobil"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('master_transaction_mobil',[
            'Transactions'=> $Hasils,
            'session' => $session                        
            ]);    
    }

    public function show(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterTransactionMobilAPI/GetMasterTransactionMobilById?MstTransactionMobilId=".$request->Id; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($Hasils);
        return json_encode($val);
    }

    public function delete($id = null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterTransactionMobilAPI/DeleteMasterTransactionMobil?MST_TransactionMobilId=".$id;
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

        return redirect('/master-transaction-mobil')->with('success','Data Master Transaction Mobil Delete Successfull !!!');
    }

    public function download()
    {
       //API GET
       $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterTransactionMobilAPI/GetAllMasterTransactionMobil"; 
       $ch = curl_init($url);                                                     
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
       $result = curl_exec($ch);
       $err = curl_error($ch);
       curl_close($ch);
       $Hasils= json_decode($result);
    //    dd($Hasils);

        $data=[];
        foreach ($Hasils as $Hasil) {

            if (property_exists($Hasil->User, 'Name')){
                $Name = $Hasil->User->Name;
            }else{
                $Name = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'NomorPlat')){
                $NomorPlat = $Hasil->MstTransactionMobil->NomorPlat;
            }else{
                $NomorPlat = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'DueDate')){
                $DueDate = $Hasil->MstTransactionMobil->DueDate;
            }else{
                $DueDate = "";
            }
        
            if (property_exists($Hasil->MstTransactionMobil, 'Colour')){
                $Colour = $Hasil->MstTransactionMobil->Colour;
            }else{
                $Colour = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'ColourSTNK')){
                $ColourSTNK = $Hasil->MstTransactionMobil->ColourSTNK;
            }else{
                $ColourSTNK = "";
            }

            if (property_exists($Hasil->MstTransactionMobil, 'PolicyNumber')){
                $PolicyNumber = $Hasil->MstTransactionMobil->PolicyNumber;
            }else{
                $PolicyNumber = "";
            }



            array_push($data,[
                "Nama"=>$Name,
                "NoPolisi"=>$NomorPlat,
                "NamaTertanggung"=>$Hasil->MstTransactionMobil->NamaTertanggung,
                "Kendaraan"=>$Hasil->MstTransactionMobil->Kendaraan,
                "Pertanggungan"=>$Hasil->MstTransactionMobil->Pertanggungan,
                "HargaPertanggungan"=>$Hasil->MstTransactionMobil->HargaPertanggungan,
                "Warna"=>$Colour,
                "ColorOnSTNK"=>$ColourSTNK,
                "NoKontrak"=>$PolicyNumber,
                "DueDate"=>$DueDate
            ]);
        }
    //   dd($data);
    
      return Excel::download(new MasterTransactionMobilExport($data), 'accone Master Transaction Mobil '. date("Y-m-d") .'.xlsx');   
    }
}