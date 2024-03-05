<?php

namespace App\Http\Controllers;

use App\singlemodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class notesController extends Controller
{
    //----------------to show the listing of notes
    public function notes_listing(Request $request){
    if (Session::get('name')) {
        $user_id  = Session::get('user_id');
        $parameter = array($user_id);
        $data['notes'] = singleModel::call_procedure('proc_task_get_notes', $parameter);
        // dd($data);
        return view('notes_blades.notes_list', $data);
        }
    else {
        return redirect("login")->withErrors(['login' => 'Login details are not valid']);
    }
}


    //---------------------To save the note-------------
    public function save_note(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $title = $request->input('title');
        $description = $request->input('description');
        $user_id  = Session::get('user_id');
        $parameter = array($title, $description, $user_id,);
        $note = singleModel::call_procedure('proc_task_save_note', $parameter);
        return response()->json($note);
        
       }

       //------------To archieve the note------------------
    public function archive_note(Request $request){
        $user_id  = Session::get('user_id');
        $note_id  = $request -> input('noteId');
        $parameter = array($user_id, $note_id);
        $note = singleModel::call_procedure('proc_task_archive_note', $parameter);
        return response()->json(['success' => true]);
    }

    //-------------to get note for edit------------
    public function get_note(Request $request){
        $user_id  = Session::get('user_id');
        $note_id  = $request -> input('noteId');
        $parameter = array($user_id, $note_id);
        $note = singleModel::call_procedure('proc_task_get_individual_note', $parameter);
        return response()->json($note);
    }

    //--------------update krne ke liye edit krne ke baad--------------------
    public function update_note(){
        return("update ho gya bhai");
    }
}
