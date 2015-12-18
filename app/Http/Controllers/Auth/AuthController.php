<?php namespace App\Http\Controllers\Auth;


use Crypt;
use App\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
 
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
 
class AuthController extends Controller {
 
    /**
     * the model instance
     * @var User
     */
    protected $user; 
    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;
 
    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator  $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
       // \Log::info("in the constructor function of auth controller");
       
        $this->user = $user; 
        $this->auth = $auth;
 
        $this->middleware('guest', ['except' => ['getLogout']]); 
    }
 
    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }
 
    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
    public function postRegister(RegisterRequest $request)
    {
        //code for registering a user goes here.
    //    $this->auth->login($this->user); 
        $UserFullName  = $request->input('UserFullName', 'UserFullName not set') ;
        $password  = $request->input('password', 'Password  not set') ;
        $Email  = $request->input('Email', 'Email not set') ;
        $PhoneNo  = $request->input('PhoneNo', 'PhoneNo not set') ;
        $MobileNo  = $request->input('MobileNo', 'MobileNo not set') ;
          \Log::info ("..........password is: " . $password);
    //    INSERT INTO `user` (`UserFullName`, `password`, `Email`, `PhoneNo`, `MobileNo`)
    //    VALUES ('', NULL, '', NULL, NULL);
           $all = $request->all();
        DB::insert (' INSERT INTO user (UserFullName, password, Email, PhoneNo, MobileNo) ' .
    
        ' VALUES (?, ?, ?, ?, ?)', [$UserFullName, bcrypt($password), $Email, $PhoneNo, $MobileNo]);
      //  'VALUES ($BookName, $Publishers, $PublishingYear, $PageNumbers, $Price, $Language');

         \Log::info ($all);
        \Log::info ("about to register a new user");
        return redirect('/addbook'); 
    }
 
    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
    //    \Log::info ("in get login function authcontroller");
        return view('auth.login');
    }
 
    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {
        \Log::info("-----------------this is fucking working driver auth controller.php");
       
         $a = array ('email' => $request->input('email','email not found'), 'password' => $request->input('password', 'password not found'));
    //   $tasks = DB::select('SELECT * FROM tasks where user_id = 6;');
    //    \Log::info($tasks);
        \Log::info("trying to attepm to loging");
       \Log::info($a);
       $b = $request->all();
       \Log::info("all fields are");
       \Log::info($b);
       
        if ($this->auth->attempt($a))
        {
            \Log::info('.............log in successful.........');

            $ownedBookList = DB::select('SELECT * FROM ownedbooklist where userId = ?;',[13]);
            \Log::info($ownedBookList);
            \Log::info('sending date to view');
        //    return redirect('user/login')->with('message', 'Login Failed');
            return redirect('user/userhomepage'); 
        }

     /*   if ($this->auth->attempt($request->only('email', 'password')))
        {
            return redirect('/tasks');
        }

    */
        \Log::info("login failed");
        return redirect('auth/login')->withErrors([
            'email' => 'The credentials you entered did not match our records. Try again?',
        ]);
    }
 
    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        $this->auth->logout();
 
        return redirect('/');
    }
 
}