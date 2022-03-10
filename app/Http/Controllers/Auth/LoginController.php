<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo='rt-admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest','blockIp'])->except('logout');

    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    protected function authenticated(Request $request, $user)
    {

        if ( $user->hasAnyRole(['user']) ) {
            return redirect()->route('user.dashboard');
        }
        return redirect()->route('admin.dashboard');
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();
        $socialEmail = $socialiteUser->getEmail();
        $socialName = $socialiteUser->getName();
        $user = User::where('email', $socialiteUser->getEmail())->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('user.dashboard');
        } else {
            $newUser = User::create(['name' => $socialName, 'email' => $socialEmail,'provider' => $provider]);
            Auth::login($newUser);
            return redirect()->route('user.dashboard');
        }
    }
}
