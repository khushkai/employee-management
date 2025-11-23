<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
 
    public function LoginForm(){
        return view('login'); 
    }


    public function login(Request $request){
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email'=>'Invalid credentials']);
    }

    public function RegisterForm(){
        // echo "test";
        return view('register'); 
    }

    public function register(Request $request)
    {
        // dd($request->all());exit;
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
   
}
