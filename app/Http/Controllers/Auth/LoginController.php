<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:organizer')->except('logout');
    }

    public function logout(Request $request) {
        // $user = Auth()->user();
        if(Auth::check('user') || Auth::check('organizer')){
            Auth::logout();
        }
        return redirect()->route('homePage');
    }

    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function index()
    {
        return view('auth.login.index', ['login_as' => '']);
    }

    public function showUserLogin()
    {
        return view('auth.login.index', ['login_as' => 'user']);
    }

    public function showOrganizerLogin()
    {
        return view('auth.login.index', ['login_as' => 'organizer']);
    }

}
