<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserHasRegistered;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Event;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Lang;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'getLogout']]);
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return view('frontend.login')->with('show_recaptcha', env('RECAPTCHA_ON'));
    }

    /**
     * @return mixed
     */
    public function getRegister()
    {
        return view('frontend.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $newUser = $this->create($request->all());

        Event::fire(new UserHasRegistered($newUser));

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => 'required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'nickname' => $data['nickname'],
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                $this->loginUsername() => 'required',
                'password'             => 'required',
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function validateCaptcha(Request $request)
    {
        $recaptcha = new \ReCaptcha\ReCaptcha(\Config::get('services.recaptcha.private'));
        $verify = $recaptcha->verify(
            $request->get('g-recaptcha-response'),
            $request->getClientIp()
        );

        return $verify->isSuccess();
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (env('RECAPTCHA_ON') && !$this->validateCaptcha($request)) {
            \Session::flash(
                'messages',
                ['warning' => Lang::get('frontend/auth.login.g-recaptcha-response-required')]
            );

            return \Redirect::to('/login')->withInput($request->input());
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();
        $lockedOut = $this->hasTooManyLoginAttempts($request);
        if ($throttles && $lockedOut) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
}
