<?php

namespace App\Http\Middleware;
use App\singlemodel;

use Closure;
use Illuminate\Http\Request;

class authorize_task_view
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


//-----------------------------0 matlab public , 1 matlab private -----------------------------
//---------------------------------------------------->
//                                   <----------------------------------------------------------

    public function handle($request, Closure $next)
    {   
        $parent_task_id = $request->route('parent_task_id');
        $task_id = $request->route('task_id');
        $user_id = session('user_id');
        if (!is_numeric($task_id) || intval($task_id) != $task_id || strlen($task_id) > 6) {
            return redirect('login');
        }
         
        //------------------------get visiblilty from here------------------------
        $parameter = array($task_id);
        $visibility = singlemodel::call_procedure('proc_task_get_visibility',$parameter);
        $status = singlemodel::call_procedure('proc_task_get_status',$parameter);
        if(empty($visibility)|| $status[0]->task_status==3){
            return redirect('login');
        }
        //--------------collaborators--------
        $parameter = array($task_id);
        $data['collab'] = singlemodel::call_procedure('proc_collab_task',$parameter);
        //------------------owner and reporter---------------
        $parameter =array($task_id);
        $data['owner_reporter'] = singlemodel::call_procedure('proc_task_owner_reporter', $parameter);
        //----------------superuser--------------
        $parameter = array();
        $data['superuser'] = singlemodel::call_procedure('proc_task_get_task_superuser', $parameter);

        function flattenArray($array) {
            $result = [];
        
            foreach ($array as $value) {
                if (is_array($value) || is_object($value)) {
                    $result = array_merge($result, flattenArray((array)$value));
                } else {
                    $result[] = $value;
                }
            }
        
            return $result;
        }

        $flattenedData = flattenArray($data);


        //--------------------------condition to let user access-----------------------
        
        $visibility = $visibility[0]->visibility;

        if (in_array($user_id, $flattenedData) || $visibility == 1) {
            return $next($request);
        } else 
        {
        return redirect('/login'); 
        }
    }
}
