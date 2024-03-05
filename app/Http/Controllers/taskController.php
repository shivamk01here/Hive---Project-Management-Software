<?php

namespace App\Http\Controllers;

use Mockery\Generator\Parameter;
use Session;
use App\singlemodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use View;
use App\helpers;

use Illuminate\Validation\ValidationException;


class taskController extends Controller
{
    //--------------------------- ------SHOWING VIEW FOR ADDING A NEW TASK------------------------------------
    public function new_task()
    {
        if (Session::get('name')) {
            $parameter = array();
            $data['reporters'] = singlemodel::call_procedure('proc_task_get_task_reported_by', $parameter);
            $data['mediums'] = singlemodel::call_procedure('proc_task_get_task_medium', $parameter);
            $data['taskowners'] = singlemodel::call_procedure('proc_task_get_task_taskowner', $parameter);
            $data['task_priorities'] = singlemodel::call_procedure('proc_task_get_task_priority', $parameter);
        
            //--------------------to get data according to the department-------------
            
            $department_id = session('department_id');
            $department_value = $department_id->department;
            
            $parameter = array($department_value);
            $data['types'] = singlemodel::call_procedure('proc_task_get_task_type', $parameter);
            $data['project_types'] = singlemodel::call_procedure('proc_task_get_task_project_type', $parameter);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            $data['stages'] = singlemodel::call_procedure('proc_task_get_task_stage', $parameter);
            //-------------------------------------------------------------------------------------------    
            // dd($data);
            
            return view('create_task', $data);
        } else {
            return redirect('login');
        }
    }


    //-----------------------------------EMAIL CURL FUNCTION TO ADD TASK IN DB-------------------------------
    function email_curl($content, $subject, $to, $senderName, $receivername)
    {
        // $ch = curl_init();
        // $data = array(
        //     "emailContent" => base64_encode($content),
        //     "password" => "Admin@1122",
        //     "receivername" => $receivername,
        //     "reciever" => $to,
        //     "sender" => "alert@ixambee.com",
        //     "senderName" => $senderName,
        //     "subject" => $subject,
        //     "userId" => "atozlearn"
        // );
        // $data = json_encode($data);
        // curl_setopt($ch, CURLOPT_URL, "https://api.koreroplatforms.com/omni-email-api/sendEmail");
        // // curl_setopt($ch, CURLOPT_URL,"http://proddigiconnect.spicedigital.in/omni-email-api/sendEmail");                
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, array('request' => $data));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $server_output = curl_exec($ch);
        // curl_close($ch);


        $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://emailapi.netcorecloud.net/v5/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode(array(
            "from" => array("email" => "alert@ixambee.com", "name" => $senderName),
            "subject" => $subject,
            "content" => array(array("type" => "html", "value" => $content)),
            "personalizations" => array(array("to" => array(array("email" => $to, "name" => $receivername))))
        )),
        CURLOPT_HTTPHEADER => array(
            "api_key:7895ea285d92805bc6e9327da59018a2",
            "content-type: application/json"
        ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    }

    //---------------------------Saving New Task in DB -------------------------------------
    public function new_task_post(Request $request)
    {
        if (Session::get('name')) {
            $request->validate([
                'title' => 'required|string|max:255|unique:tbl_task_master',
                'type_id' => 'required',
                'reported_by' => 'required|nullable|string|max:255',
                'medium_id' => 'required|nullable|integer',
                'project_type_id' => 'required',
                'stage_id' => 'required',
                'task_owner' => 'required|nullable|string|max:255',
                'report_date' => 'required|date',
                'due_date' => 'required|date',
                'description' => 'nullable|max:65535',
                'task_priority' => 'required|nullable|integer',
                'task_sprint' => 'required|nullable|string|max:255',
                'file' => 'nullable|max:5048'
            ],  [
                    'type_id.required' => 'The type field is required',
                    'stage_id.required' => 'The type field is required',
                    'project_type_id.required' => 'The type field is required',
                    'medium_id.required' => 'The medium field is required',
                    'file' => 'file|mimes:pdf,doc,docx,img,png,jpeg|max:2048'
            ]
            );

            $title = $request->title;
            $type_id = $request->type_id;
            $reported_by = $request->reported_by;
            $medium_id = $request->medium_id;
            $project_type_id = $request->project_type_id;
            $stage_id = $request->stage_id;
            $task_owner = $request->task_owner;
            $report_date = date('Y-m-d', strtotime($request->report_date));
            $due_date = date('Y-m-d', strtotime($request->due_date));
            $description = $request->description;
            // $description = strip_tags($descriptionHTML);
            $task_priority = $request->task_priority;
            $owneremail = $request->owneremail;
            $task_sprint = $request->task_sprint;
            $task_collaborator = $request->task_owner_collab;
        
        // echo "<pre>";
        // print_r($_FILES); 
        // dd($request->file('file')); 
        // die(); 

        if($request->file('file')){
            
            $fileName = time().'_'.$request->file->getClientOriginalName();
            //$path = $request->file('file')->storeAs('public/uploads', $fileName);
            $file = $request->file('file');
            $destinationPath = public_path('uploads');
            $fileName = $file->getClientOriginalName(); 
            $originalFileName = $file->getClientOriginalName();
            $fileName = md5(time()) . '_' . $originalFileName;
            $fileName = str_replace(' ', '_', $fileName);
            $file->move($destinationPath, $fileName);
            $path = "uploads/".$fileName;
         }
         else{
            $path ="";
         }
         
            $parameter = array(
                $title,
                $type_id,
                $reported_by,
                $medium_id,
                $project_type_id,
                $stage_id,
                $task_owner,
                $report_date,
                $due_date,
                $description,
                $task_priority,
                $task_sprint,
                $path 
            );
           
            $response = singleModel::call_procedure('proc_task_new_task1', $parameter);
            $last_id = $response[0]->id;
            if ($task_collaborator !== null) {
                foreach ($task_collaborator as $collab) {
                    $task_id = $last_id;
                    $admin_user_id = $collab;
                    $parameter = array($task_id, $admin_user_id);
                    $data = singleModel::call_procedure('proc_task_collab', $parameter);
                    $email = $data[0]->email;
                    $subject = "You are added as Collaborator in : " . $title;
                    $view = (string) View::make("exclusive_mail_master")->with('description', $description)
                        ->with('due_date', $due_date)->with('title', $title)->with('reported_by', $reported_by)->with('task_id', $task_id);
                    $this->email_curl($view, $subject, $email, 'ixamBee', 'ixamBee');
                    $parameter = array($task_id, $admin_user_id);
                    $data = singleModel::call_procedure('proc_task_collab_mail_send_update', $parameter);
                }
            }
    
            $task_id = $last_id;
            $email = 'web-report@ixambee.com';
            $subject = "New Task Assigned : " . $title;
            $view = (string) View::make("mail_on_creation")->with('description', $description)
                ->with('due_date', $due_date)->with('title', $title)->with('reported_by', $reported_by)->with('task_id', $task_id);

            $this->email_curl($view, $subject, $owneremail, 'ixamBee', 'ixamBee');



            //--------------------------wanna save log while creating too---------------------------
            $updated_by = Session::get('name');
            $parameter = array(
                $task_id,
                $updated_by,
                $title,
                $type_id,
                $reported_by,
                $medium_id,
                $project_type_id,
                $stage_id,
                $task_owner,
                $report_date,
                $due_date,
                $description
            );
            singleModel::call_procedure('proc_task_task_log', $parameter);


            return redirect('new-task')->with('success', 'Task created successfully.');

        } else {
            return redirect('login');
        }
    }

    //---------------------------------SHOWING DETAILED VIEW OF PRE-EXISTED TASK FOR UPDATING--------------------------------------
    public function task_view_edit($task_id)
    {
        if (Session::get('name')) {
            $user_id = Session::get('user_id');
            $parameter = array();
            $data['reporters'] = singlemodel::call_procedure('proc_task_get_task_reported_by', $parameter);
            $data['mediums'] = singlemodel::call_procedure('proc_task_get_task_medium', $parameter);
            $data['taskowners'] = singlemodel::call_procedure('proc_task_get_task_taskowner', $parameter);
            $data['task_priorities'] = singlemodel::call_procedure('proc_task_get_priority', $parameter);
            $parameter = array($task_id);
            $data['task'] = singlemodel::call_procedure('proc_task_get_task2', $parameter);
            // dd($data['task']);
            if(empty($data['task'])){
                return redirect('login');
            }
            $parameter = array($task_id);
            $data['collab'] = singlemodel::call_procedure('proc_collab_task',$parameter);
            $data['task_owner'] = singlemodel::call_procedure('proc_task_get_taskowner', $parameter);
            $data['comments'] = singlemodel::call_procedure('proc_task_get_comments', $parameter);

            $department_id = session('department_id');
            $department_value = $department_id->department;

            $parameter = array($department_value);
            $data['types'] = singlemodel::call_procedure('proc_task_get_task_type', $parameter);
            $data['project_types'] = singlemodel::call_procedure('proc_task_get_task_project_type', $parameter);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            $data['stages'] = singlemodel::call_procedure('proc_task_get_task_stage', $parameter);
            return view('view_task', $data);
        } else {

            return redirect('login');
        }
    }


    //----------------------------------------------UPDATING A TASK IN DB---------------------------------------

    public function update_task(Request $request)
    {
    //   dd($request->all());
        //--------------------------------MARK AS COMPLETED [ CHANGING STATUS to 2 ]-------------------------------------------------
        if ($request->has('mark_as_completed')) {
            $task_id = $request->input('id');
            $parameter = array($task_id);
            singleModel::call_procedure('proc_task_mark_completed_task', $parameter);
            return redirect('task-list')->with('success', 'Task deleted successfully.');
        }


        //--------------------------------Deleting TASK [ CHANGING STATUS to 3 ] ------------------------------------

        if ($request->has('delete_task')) {
            $task_id = $request->input('id');
            $parameter = array($task_id);
            singleModel::call_procedure('proc_task_delete_task', $parameter);
            return redirect('task-list')->with('success', 'Task deleted successfully.');
        }

        //--------------------------------UPDATING TASK-----------------------------------------

        if (Session::get('name')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'type_id' => 'required|integer',
                'reported_by' => 'nullable|string|max:255',
                'medium_id' => 'nullable|integer',
                'project_type_id' => 'required|integer',
                'stage_id' => 'required|integer',
                'task_owner' => 'nullable|string|max:255',
                'report_date' => 'required|date',
                'due_date' => 'required|date',
                'description' => 'nullable|string',
                'task_priority' => 'nullable',

            ]);

            $task_id = $request->id;
            $title = $request->title;
            $type_id = $request->type_id;
            $reported_by = $request->reported_by;
            $medium_id = $request->medium_id;
            $project_type_id = $request->project_type_id;
            $stage_id = $request->stage_id;
            $task_owner = $request->task_owner;
            $report_date = $request->report_date;
            $due_date = $request->due_date;
            // $description = $request->description;
            $description = $request->description;
            $task_priority = $request->task_priority;
            $owneremail   =$request->owneremail;
            $task_sprint  = $request->task_sprint;
            $task_collaborator =$request->task_owner_collab;
            if($request->file('file')){
            
                $fileName = time().'_'.$request->file->getClientOriginalName();
                //$path = $request->file('file')->storeAs('public/uploads', $fileName);
                $file = $request->file('file');
                $destinationPath = public_path('uploads');
                $fileName = $file->getClientOriginalName(); // Use the original file name or generate a unique name if needed
                $originalFileName = $file->getClientOriginalName();
                $fileName = md5(time()) . '_' . $originalFileName;
                $fileName = str_replace(' ', '_', $fileName);
                $file->move($destinationPath, $fileName);
                $path = "uploads/".$fileName;
             }
             else{
                $path ="";
             }
            $parameter = array(
                $task_id,
                $title,
                $type_id,
                $reported_by,
                $medium_id,
                $project_type_id,
                $stage_id,
                $task_owner,
                $report_date,
                $due_date,
                $description,
                $task_priority,
                $task_sprint,
                $path 
            );
            
            $response = singleModel::call_procedure('proc_task_update', $parameter);
            $parameter = array($task_id);
            $result_collab = singleModel::call_procedure('proc_task_collab_update', $parameter);
            if ($task_collaborator !== null){
                foreach($task_collaborator as $collab){
                    $task_id  = $task_id;
                    $admin_user_id = $collab;
                    $parameter = array($task_id, $admin_user_id);
                    $data = singleModel::call_procedure('proc_task_collab', $parameter);
                    $email = $data[0]->email;
                    $subject = "New Task Assigned " . $title;
                    $view = (string) View::make("exclusive_mail_master")->with('description', $description)
                    ->with('due_date', $due_date)->with('title', $title)->with('reported_by', $reported_by)->with('task_id', $task_id);               
                    $this->email_curl($view, $subject, $email, 'ixamBee', 'ixamBee');
                    $parameter = array($task_id, $admin_user_id);
                    $data = singleModel::call_procedure('proc_task_collab_mail_send_update', $parameter);
                }}
            //----------------------------TO LOG EVERY RECORD [tbl_task_task_log] -------------------------------

            $updated_by = Session::get('name');
            $parameter = array(
                $task_id,
                $updated_by,
                $title,
                $type_id,
                $reported_by,
                $medium_id,
                $project_type_id,
                $stage_id,
                $task_owner,
                $report_date,
                $due_date,
                $description
            );
            singleModel::call_procedure('proc_task_task_log', $parameter);

            $email = 'web-report@ixambee.com';
            $subject = 'U have update in' . " " . $title;
            $view = (string) View::make("exclusive_mail_master_update")->with('description', $description)
                ->with('due_date', $due_date)->with('title', $title)->with('reported_by', $reported_by)->with('task_id', $task_id);
            $this->email_curl($view, $subject, $owneremail, 'ixamBee', 'ixamBee');
            return redirect('my-task')->with('success', 'Task updated successfully.');
        } else {
            return redirect('login');
        }
    }



    //------------------------------- Send Confirmation Mail---------------------------------------------------
    public function completion_mail(Request $request, $task_id)
    {
        if (Session::get('name')) {
            $parameter = array($task_id);
            $data = singlemodel::call_procedure('proc_task_completion_mail', $parameter);
            $title = $data[0]->title;
            $description = $data[0]->description;
            $owneremail = $data[0]->task_owner_email;
            $due_date = $data[0]->due_date;

            $email = 'web-report@ixambee.com';
            $subject = 'your task ' . $title . ' is is Marked As Completed :) ';
            $view = (string) View::make("exclusive_mail_master_complete")->with('description', $description)
                ->with('due_date', $due_date)->with('title', $title)->with('task_id', $task_id);
            $this->email_curl($view, $subject, $owneremail, 'ixamBee', 'ixamBee');

            return back()->with('success', 'completion Mail Sent successfully.');
        } else {
            return redirect('login');
        }

    }

    //---------------------------------- {{ LISTING }} VIEW Task's LIST and APPLY FILTERS ------------------------------------


    public function kaamdekh_list_filters(Request $request)
    {
        if (Session::get('name')) {
            $type_id = $request->type_id;
            $reported_by = $request->reported_by;
            $medium_id = $request->medium_id;
            $project_type_id = $request->project_type_id;
            $stage_id = $request->stage_id;
            $task_owner = $request->task_owner;
            $fromDate = $request->from_date;
            $tillDate = $request->till_date;
            $task_priority_id = $request->task_priority;
            $task_sprint = $request->task_sprint;

            if (!$type_id) {
                $type_id = 0;
            }
            if (!$reported_by) {

                $reported_by = 0;
            }
            if (!$medium_id) {
                $medium_id = 0;
            }
            if (!$project_type_id) {
                $project_type_id = 0;
            }
            if (!$stage_id) {
                $stage_id = 0;
            }
            if (!$task_owner) {
                $task_owner = 0;
            }
            if (!$task_priority_id) {
                $task_priority = 0;
            }
            if (!$task_sprint) {
                $task_sprint = 0;
            }

            $parameter = array();
            $data['reporters'] = singlemodel::call_procedure('proc_task_get_task_reported_by', $parameter);
            $data['mediums'] = singlemodel::call_procedure('proc_task_get_task_medium', $parameter);
            $data['taskowners'] = singlemodel::call_procedure('proc_task_get_task_taskowner', $parameter);
            $data['task_priorities'] = singlemodel::call_procedure('proc_task_get_task_priority', $parameter);

            $parameter = array($type_id, $reported_by, $medium_id, $project_type_id, $stage_id, $task_owner, $fromDate, $tillDate, $task_priority_id, $task_sprint);
            $data['tasks'] = singlemodel::call_procedure('proc_task_filter_list_dynamic', $parameter);


            $department_id = session('department_id');
            $department_value = $department_id->department;

            $parameter = array($department_value);
            $data['types'] = singlemodel::call_procedure('proc_task_get_task_type', $parameter);
            $data['project_types'] = singlemodel::call_procedure('proc_task_get_task_project_type', $parameter);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            $data['stages'] = singlemodel::call_procedure('proc_task_get_task_stage', $parameter);
            // dd($data); 
            return view('partials.listing', $data);
        } else {
            return redirect('login');
        }
    }

    //------------------------------------------------Welcome ADMIN -------------------------------------
    public function welcome()
    { {         
            if (Session::get('name')) {
                $task_owner_id = Session::get('user_id');
                $parameter = array($task_owner_id);
                $task_info = singlemodel::call_procedure('proc_task_task_info', $parameter);
                return view('welcome_admin', ['task_info' => $task_info])->withSuccess(['Signed' => "Welcome on dashboard"]);
            } else {
                return redirect("login")->withErrors(['login' => 'Login details are not valid']);
            }
        }
    }

    //--------------------------------------------adding comment--------------------------------------------------
    public function add_comment(Request $request)
    {
        if (Session::get('name')) {
            $request->validate([
                'comment' => 'required|string|max:255',
            ]);

            $user_id = Session::get('user_id');

            $task_id = $request->task_id;
            $comment = $request->comment;

            $parameter = array($task_id);
            $title = singlemodel::call_procedure('proc_task_get_title', $parameter);
            $titlesecond = $title[0]->title;
            $parameter = array($task_id, $user_id, $comment);
            $result = singlemodel::call_procedure('proc_task_insert_comment', $parameter);
            $parameter = array($task_id);
            $comments = singlemodel::call_procedure('proc_task_get_comments', $parameter);
            //----------------------------------------comment mail -----------------------------------
            
            $commentowners = singlemodel::call_procedure('proc_task_comment_mail', $parameter);
            foreach ($commentowners as $owneremail) {
                $email = 'web-report@ixambee.com';
                $subject = "Someone commented on your task:" . $titlesecond;
                $view = (string) View::make("mail_on_comment")->with('task_id', $task_id)->with('comments', $comments); 
                $this->email_curl($view, $subject, $owneremail->commentowners, 'ixamBee', 'ixamBee');
            }
            //--------------------------------------------------------------------------------------------
           
            return $comments;
        } else {
            return redirect('login');
        }
    }

    //---------------------------------------------VIEW MY TASKS ONLY ----------------------------------------------

    public function my_task(Request $request)
    {
        if (Session::get('name')) {
            $type_id = $request->type_id;
            $user_id = Session::get('user_id');
            $reported_by = $request->reported_by;
            $medium_id = $request->medium_id;
            $project_type_id = $request->project_type_id;
            $stage_id = $request->stage_id;
            $task_owner = $request->task_owner;
            $fromDate = $request->from_date;
            $tillDate = $request->till_date;
            $task_priority_id = $request->task_priority;
            $task_sprint = $request->task_sprint;

            if (!$type_id) {
                $type_id = 0;
            }
            if (!$reported_by) {
                $reported_by = 0;
            }
            if (!$medium_id) {
                $medium_id = 0;
            }
            if (!$project_type_id) {
                $project_type_id = 0;
            }
            if (!$stage_id) {
                $stage_id = 0;
            }
            if (!$task_priority_id) {
                $task_priority = 0;
            }
            if (!$task_sprint) {
                $task_sprint = 0;
            }

            $parameter = array();
            $data['reporters'] = singlemodel::call_procedure('proc_task_get_task_reported_by', $parameter);
            $data['mediums'] = singlemodel::call_procedure('proc_task_get_task_medium', $parameter);
            $data['task_priorities'] = singlemodel::call_procedure('proc_task_get_task_priority', $parameter);
        
            $parameter = array($user_id, $type_id, $reported_by, $medium_id, $project_type_id, $stage_id, $fromDate, $tillDate, $task_priority_id, $task_sprint);
            $data['tasks'] = singlemodel::call_procedure('proc_task_my_task_list', $parameter);



            $department_id = session('department_id');
            $department_value = $department_id->department;

            $parameter = array($department_value);
            $data['types'] = singlemodel::call_procedure('proc_task_get_task_type', $parameter);
            $data['project_types'] = singlemodel::call_procedure('proc_task_get_task_project_type', $parameter);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            $data['stages'] = singlemodel::call_procedure('proc_task_get_task_stage', $parameter);
        //-----------------------------------------------------------------------------------------
            return view('my_task', $data);
        } else {
            return redirect('login');
        }
    }

    //------------------------------------------------adding subtasks view only-----------------------------------------


    public function add_subtask_view($task_id)
    {
        if (Session::get('name')) {
            $parameter = array();
            $data['reporters'] = singlemodel::call_procedure('proc_task_get_task_reported_by', $parameter);
            $data['mediums'] = singlemodel::call_procedure('proc_task_get_task_medium', $parameter);
             $data['taskowners'] = singlemodel::call_procedure('proc_task_get_task_taskowner', $parameter);
            $data['task_priorities'] = singlemodel::call_procedure('proc_task_get_task_priority', $parameter);
            $data['parent_task_id'] = $task_id;
            $parameter = array($task_id);
            $data['parent_task_name'] = singlemodel::call_procedure('proc_task_get_parent_task_name', $parameter);
            $data['task'] = singlemodel::call_procedure('proc_task_get_task2', $parameter);
           
            $department_id = session('department_id');
            $department_value = $department_id->department;

            $parameter = array($department_value);
            $data['types'] = singlemodel::call_procedure('proc_task_get_task_type', $parameter);
            $data['project_types'] = singlemodel::call_procedure('proc_task_get_task_project_type', $parameter);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            $data['stages'] = singlemodel::call_procedure('proc_task_get_task_stage', $parameter);
        //-----------------------------------------------------------------------------------------
            return view('view_add_subtask', $data);
        } else {
            return redirect('login');
        }
    }



    //------------------------------------------ Adding  subtask in DB ---------------------------- 

    public function post_add_subtask(Request $request)
    {
        if (Session::get('name')) {
            $request->validate([
                'title' => 'required|string|max:255|unique:tbl_task_master',
                'type_id' => 'required|integer',
                'reported_by' => 'nullable|string|max:255',
                'medium_id' => 'nullable|integer',
                'project_type_id' => 'required|integer',
                'stage_id' => 'required|integer',
                'task_owner' => 'nullable|string|max:255',
                'report_date' => 'required|date',
                'due_date' => 'required|date',
                'description' => 'nullable|string',
                'task_priority' => 'nullable|integer',
                'parent_task_id' => 'required',
                'task_sprint' => 'nullable'
            ]);


            $title = $request->title;
            $type_id = $request->type_id;
            $reported_by = $request->reported_by;
            $medium_id = $request->medium_id;
            $project_type_id = $request->project_type_id;
            $stage_id = $request->stage_id;
            $task_owner = $request->task_owner;
            $report_date = date('Y-m-d', strtotime($request->report_date));
            $due_date = date('Y-m-d', strtotime($request->due_date));
            $description = $request->description;
            $task_priority = $request->task_priority;
            $owneremail = $request->owneremail;
            $parent_task_id = $request->parent_task_id;
            $sprint_id = $request->task_sprint;
            $task_collaborator = $request->task_owner_collab;
            $parameter = array(
                $title,
                $type_id,
                $reported_by,
                $medium_id,
                $project_type_id,
                $stage_id,
                $task_owner,
                $report_date,
                $due_date,
                $description,
                $task_priority,
                $parent_task_id,
                $sprint_id,
            );
            $response = singleModel::call_procedure('proc_task_add_subtask', $parameter);
            $last_id = $response[0]->id;
            if ($task_collaborator !== null) {
                foreach ($task_collaborator as $collab) {
                    $task_id = $last_id;
                    $admin_user_id = $collab;
                    $parameter = array($task_id, $admin_user_id);
                    $data = singleModel::call_procedure('proc_task_collab', $parameter);
                    $email = $data[0]->email;
                    $subject = "New SubTask Assigned " . $title;
                    $view = (string) View::make("exclusive_mail_master")->with('description', $description)
                        ->with('due_date', $due_date)->with('title', $title)->with('reported_by', $reported_by)->with('task_id', $task_id);
                    $this->email_curl($view, $subject, $email, 'ixamBee', 'ixamBee');
                    $parameter = array($task_id, $admin_user_id);
                    $data = singleModel::call_procedure('proc_task_collab_mail_send_update', $parameter);
                }
            $task_id = $last_id;
            $email = 'web-report@ixambee.com';
            $subject = 'a subtask is assigned to you';
            $view = (string) View::make("mail_for_subtask")->with('description', $description)
                ->with('due_date', $due_date)->with('title', $title)->with('reported_by', $reported_by)->with('task_id', $task_id);
            $this->email_curl($view, $subject, $owneremail, 'ixamBee', 'ixamBee');

            return redirect('my-task')->with('success', 'Subtask Added successfully.');

        } else {
            return redirect('login');
        }
    }
    }

    //--------------------------------------------------VIEW TASK HISTORY-------------------------------------------

    public function view_task_history($task_id)
    {

        $parameter = array($task_id);

        $data['history'] = singlemodel::call_procedure('proc_task_view_task_logs', $parameter);
        return view('view_task_history', $data);
    }

    //-----------------------------------------------view parent Task ----------------------------------------------
    public function view_parent_task($parent_task_id)
    {

        if (Session::get('name')) {
            $user_id = Session::get('user_id');
            $parameter = array();
            $data['reporters'] = singlemodel::call_procedure('proc_task_get_task_reported_by', $parameter);
            $data['mediums'] = singlemodel::call_procedure('proc_task_get_task_medium', $parameter);
            $data['taskowners'] = singlemodel::call_procedure('proc_task_get_task_taskowner', $parameter);
            $data['task_priorities'] = singlemodel::call_procedure('proc_task_get_priority', $parameter);
            $parameter = array($parent_task_id);
            $data['task'] = singlemodel::call_procedure('proc_task_get_task2', $parameter);

            $data['task_owner'] = singlemodel::call_procedure('proc_task_get_taskowner', $parameter);
            $data['comments'] = singlemodel::call_procedure('proc_task_get_comments', $parameter);


            $department_id = session('department_id');
            $department_value = $department_id->department;

            $parameter = array($department_value);
            $data['types'] = singlemodel::call_procedure('proc_task_get_task_type', $parameter);
            $data['project_types'] = singlemodel::call_procedure('proc_task_get_task_project_type', $parameter);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            $data['stages'] = singlemodel::call_procedure('proc_task_get_task_stage', $parameter);
        //-----------------------------------------------------------------------------------------
            return view('view_task', $data);
        } else {
            return redirect('login');
        }

    }

    //------------------------------------------------view Subtasks----------------------------------
    public function view_subtasks($task_id)
    {
        $parameter = array($task_id);
        $data['tasks'] = singlemodel::call_procedure('proc_task_get_all_subtasks', $parameter);
        return view('view_all_subtasks', $data);
    }

    //-----------------------------------------------Re-Active Task-----------------------------------------

    public function re_activate_task(Request $request, $task_id)
    {

        $parameter = array($task_id);
        $data = singlemodel::call_procedure('proc_task_re_activate_task', $parameter);
        $title = $data[0]->title;
        $description = $data[0]->description;
        $owneremail = $data[0]->task_owner_email;
        $due_date = $data[0]->due_date;

        $email = 'web-report@ixambee.com';
        $subject = 'your task ' . $title . ' is reactivated ';
        $view = (string) View::make("exclusive_mail_reactivate")->with('description', $description)
            ->with('due_date', $due_date)->with('title', $title)->with('task_id', $task_id);
        $this->email_curl($view, $subject, $owneremail, 'ixamBee', 'ixamBee');

        return back()->with('success', 'Task reactivated successfully.');
    }

    //----------------------------------------------view task----=----------=-------------------------------
    public function view_task($task_id)
    {
        if (Session::get('name')) {
            $user_id = Session::get('user_id');
            $parameter = array($task_id);
            $data['task'] = singlemodel::call_procedure('proc_task_get_task2', $parameter);
            return view('view_only', $data);
        }
    } 

    //---------------------------------------------review request--------------------------------------------
    public function review_request($task_id)
    {
        if (Session::get('name')) {
            $user_id = Session::get('user_id');
            $parameter = array($task_id);
            $data['task'] = singlemodel::call_procedure('proc_task_get_task2', $parameter);
            $owneremail = "shivam.kumar@ixambee.com";
            $email = 'web-report@ixambee.com';
            $subject = 'someone requested u to review';
            $view = (string) View::make("mail_for_review")->with('task_id', $task_id);
            $this->email_curl($view, $subject, $owneremail, 'ixamBee', 'ixamBee');

            return back()->with('success', 'Review request sent successfully.');
        }
    } 
   
//--------------------------------------------------for visiblity toggle ------------------------
    public function task_visibility(Request $request)
    {
        if (Session::get('name')){
        $task_id = $request->input('task_id');
        $visibility = $request->input('visibility');
        $parameter = array($task_id, $visibility);
        $data = singlemodel::call_procedure('proc_task_visibility_change', $parameter);
        return response()->json(['message' => 'Visibility updated successfully']);
        }
        else{
            return ("error in controller");
        }
    }

    //-----------------------------------drag and drop ----------------------------------------
    public function drag_n_drop(Request $request)
    {
        if (Session::get('name')) {
            $type_id = $request->type_id;
            $reported_by = $request->reported_by;
            $medium_id = $request->medium_id;
            $project_type_id = $request->project_type_id;
            $stage_id = $request->stage_id;
            $task_owner = $request->task_owner;
            $fromDate = $request->from_date;
            $tillDate = $request->till_date;
            $task_priority_id = $request->task_priority;
            $task_sprint = $request->task_sprint;

            if (!$type_id) {
                $type_id = 0;
            }
            if (!$reported_by) {

                $reported_by = 0;
            }
            if (!$medium_id) {
                $medium_id = 0;
            }
            if (!$project_type_id) {
                $project_type_id = 0;
            }
            if (!$stage_id) {
                $stage_id = 0;
            }
            if (!$task_owner) {
                $task_owner = 0;
            }
            if (!$task_priority_id) {
                $task_priority = 0;
            }
            if (!$task_sprint) {
                $task_sprint = 0;
            }

            $parameter = array();
            $data['reporters'] = singlemodel::call_procedure('proc_task_get_task_reported_by', $parameter);
            $data['mediums'] = singlemodel::call_procedure('proc_task_get_task_medium', $parameter);
            $data['taskowners'] = singlemodel::call_procedure('proc_task_get_task_taskowner', $parameter);
            $data['task_priorities'] = singlemodel::call_procedure('proc_task_get_task_priority', $parameter);

            $parameter = array($type_id, $reported_by, $medium_id, $project_type_id, $stage_id, $task_owner, $fromDate, $tillDate, $task_priority_id, $task_sprint);
            $data['tasks'] = singlemodel::call_procedure('proc_task_filter_list_dynamic', $parameter);


            $department_id = session('department_id');
            $department_value = $department_id->department;

            $parameter = array($department_value);
            $data['types'] = singlemodel::call_procedure('proc_task_get_task_type', $parameter);
            $data['project_types'] = singlemodel::call_procedure('proc_task_get_task_project_type', $parameter);
            $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint', $parameter);
            $data['stages'] = singlemodel::call_procedure('proc_task_get_task_stage', $parameter);
            // dd($data);
            return view('drag_n_drop', $data);
        } else {
            return redirect('login');
        }
    }
    

    public function update_task_stage(Request $request)
    {
        if (Session::get('name')) {
            $task_id = $request->input('task_id');
            $stage_id = $request->input('stage_id');
            $parameter = array($task_id, $stage_id);
            $new_stage = singlemodel::call_procedure('proc_task_update_stage', $parameter);
            return "hello, controller se aaya hoon, ho gyi update" ;
        
        }
        else{
            return "gya ! khatam controller se error ";
        }
    }

}