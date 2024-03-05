<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Generator\Parameter;
use Session;
use App\singlemodel;
use Illuminate\Support\Facades\Mail;
use View;

class sprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sprint(Request $request)
    {
        // dd("okokoko");
        if (Session::get('name')) {
            $parameter = array();
            $data['taskowners'] = singlemodel::call_procedure('proc_task_get_task_taskowner', $parameter);
            return view('sprint', $data);
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //---------------------------------SPRINT LISTING---------------------------
    public function sprintlisting()
    {
        $parameter = array();
        $data['sprints'] = singlemodel::call_procedure('proc_task_get_all_sprint_with_count1', $parameter);
        return view('sprintlisting', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function sprintcreate(Request $request)
    {
        // dd($request->all());
        if (Session::get('name')) {
            $request->validate([
                'name' => 'required|string|max:255|unique:tbl_task_sprint',
                'task_owner' => 'nullable|string|max:255',
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
            ]);

            $name = $request->name;
            $task_owner = $request->task_owner;
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));

            $parameter = [
                $name,
                $start_date,
                $end_date,
                $task_owner,


            ];
            $response = singleModel::call_procedure('proc_task_create_sprint', $parameter);
            return redirect('sprintlisting')->with('success', 'Sprint created successfully.');

        } else {
            return redirect('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}