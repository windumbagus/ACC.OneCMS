<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function index()
    {
        //API
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PushNotificationAPI/GetAllPushNotification"; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($data);
        
        return view('push_notification',['Push_Notifications' => $data]);    
    }

    public function show(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PushNotificationAPI/GetPushNotificationById?MplNotifikasiUser_Id=".$request->Id; 
        $ch = curl_init($url);                                                     
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function update(Request $request) {
        $data = json_encode(array(
            "Id" => "$request->push_notification_Id_update_data",
            "Message" => "$request->push_notification_Message_update_data",
            "UserId" => "$request->push_notification_UserId_update_data",
            "InvoiceId" => "$request->push_notification_InvoiceId_update_data",
            "CreatedDate" => "$request->push_notification_CreatedDate_update_data",
            "CodePushNotif" => "$request->push_notification_CodePushNotif_update_data",
            "ProductOwner" => "$request->push_notification_ProductOwner_update_data",
            "HasNewPushNotif" => "$request->push_notification_HasNewPushNotif_update_data",
            "DataId" => "$request->push_notification_DataId_update_data",
        ));
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PushNotificationAPI/UpdatePushNotification"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($result);

        // if ($request->push_notification_isApproving_update_data == true) {
        //     Alert::success('User has been Approve');
        // } else {
        //     Alert::success('User has been Rejected');
        // }
        
        return redirect('/push-notification')->with('success',' Update Data Successfully!');
    }
    
    public function delete($id=null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/PushNotificationAPI/DeletePushNotificationById?MplNotifikasiUser_Id=".$id;
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

        return redirect('/push-notification')->with('success',' Delete Data Successfully!');
    }
}