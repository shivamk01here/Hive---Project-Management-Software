<?php

namespace App\Http\Controllers;

use Session;
use App\singlemodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use View;

class admincontroller extends Controller
{

//------------------------------------------Email curl function---------------------------------------
function email_curl($content, $subject, $to, $senderName, $receivername)
    {
        $ch = curl_init();
        $data = array(
            "emailContent" => base64_encode($content),
            "password" => "Admin@1122",
            "receivername" => $receivername,
            "reciever" => $to,
            "sender" => "alert@ixambee.com",
            "senderName" => $senderName,
            "subject" => $subject,
            "userId" => "atozlearn"
        );
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, "https://api.koreroplatforms.com/omni-email-api/sendEmail");
        // curl_setopt($ch, CURLOPT_URL,"http://proddigiconnect.spicedigital.in/omni-email-api/sendEmail");                
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('request' => $data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
    }

   //------------------------------------------To view admin home page----------------------------------- 
    public function admin_home (Request $request)
    {   
        if(Session::get('name')){
            $department_id = session('department_id');
            $department_value = $department_id->department;

            $parameter = array($department_value);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            return view('admin.admin_home', $data);
        }else{
            return view('auth.login');
        }
    }


    //---------------------------------------------To send all Tasks in that Sprint-------------------------
    public function sprint_mail(Request $request)
    {
        
        if (Session::get('name')) {
            
            $sprint_id = $request->sprint;
            $owneremail = "shivam.kumar@ixambee.com";

            $parameter = array($sprint_id);
            $task_details = singleModel::call_procedure('proc_task_sprint_details_mail', $parameter);
            $email = 'web-report@ixambee.com';
            $subject = 'This Week Sprint Details';

            $view = view("exclusive_mail_sprint_details", ['task_details' => $task_details]);
            $this->email_curl($view, $subject, $owneremail, 'ixamBee', 'ixamBee');
            
            return redirect('my-task')->with('success', 'Confirmation Mail Sent successfully.');
            }
             else
            {
            return redirect('login');
            }
    }
}
