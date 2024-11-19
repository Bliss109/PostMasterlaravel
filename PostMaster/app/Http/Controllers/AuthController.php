<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User; //Importing the User model to interact with the users table
use Illuminate\Support\Facades\Auth; //Provides authentication functionality
use Illuminate\Support\Facades\Hash; //Used to hash passwords securely
use Illuminate\Support\Facades\Validator; //Used for input validation
use Illuminate\Validation\ValidationException; //Handles validation errors
  
class AuthController extends Controller
{
    /**
     * Summary of register
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * This method returns the view where users can register a new account
     */
    public function register()
    {
        return view('auth/register'); //Load the registration form view
    }
  
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate(); //Validate the request
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);
  
        return redirect()->route('login'); //Redirect to login page afterwards
    }
    /**
     * Summary of login
     * Returns the view where users can log in
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('auth/login');
    }
  
    /**
     * 
     * Handles the login form submission
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard');
    }
    /**
     * 
     * Logout authenticated user
     * Invalidates the session and redirects to home page
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/'); //Redirect to the home page
    }
 
    public function profile()
    {
        return view('profile'); //Load the user profile view
    }
}
