<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\singlemodel;
class custom_authController extends Controller
{

    
    public function index()
    {
        
        if(Session::get('name')){
           return redirect('dashboard');
        }else{
            return view('auth.login');
        }
    }  
      
    public function customLogin(Request $request)
    {   
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $email = $request->email;
        $password = md5($request->password);
        $credentials = array($email,$password);
        $data = singlemodel::call_procedure('proc_login_admin', $credentials);
       
           
        if (!empty($data) && isset($data[0])) {
            $name = $data[0]->name;
            $user_id = $data[0]->id; 
            $parameter = array();
            $superuser = singlemodel::call_procedure('proc_task_get_task_superuser', $parameter);
            $superuserIds = array_column($superuser, 'superuser_id');

            $parameter = array($user_id);
            $department_id = singlemodel::call_procedure('proc_task_get_department', $parameter);
            $department_value = $department_id[0];
            

            $request->session()->put('user_id', $user_id);            
            $request->session()->put('name', $name);
            $request->session()->put('department_id', $department_value);

            session(['superuser_ids' => $superuserIds]);
      
            return redirect('dashboard')->withSuccess(['Signed' => "Welcome on dashboard"]);
        } 
        else 
        {
            return redirect("login")->withErrors(['login' => 'Login details are not valid']);
        }
        // dd("error");
       
    }

    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        // dd("okoko");
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $parameter = array($name,$email,$password);
        $data = singlemodel::call_procedure('proc_create', $parameter);
        // dd("i am here");
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password'])
    //   ]);
    }    
    
    public function dashboard()
    {
        if(Session::get('name')){
            return view('welcome_admin');
        }else{
            return redirect('login');
        }
  
        // return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    public function geturlfetch(Request $request, $id)
    {
    //  dd($id);
        return view('auth.dashboard');
    }
    public function admindashboard(Request $request)
    {
    //    dd("okoko");
        return view('admin_dashboard');
    }

}