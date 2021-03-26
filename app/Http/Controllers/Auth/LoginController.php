<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function logon(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);
        
        $user = User::where('username',$request->username)->first();
        
        if (auth()->attempt($credentials)) 
        {
            return redirect()->route('artists');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ]);
            $validator->errors()->add('credentials', "Sorry, we couldn't find an account with this username. Please check you're using the right username and try again.");
            return redirect('login')
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    public function logout() 
    {
        \Auth::logout();

        return redirect()->route('login');
    }
}