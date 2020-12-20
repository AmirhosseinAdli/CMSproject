<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Mail\RegisterWelcome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    private function attempt($username, $password)
    {
        $user = User::query()
            ->where('email', $username)
            ->orWhere('mobile', $username)
        ->first();

        if ($user->exists()) {
            if (Hash::check($password, $user->getAuthPassword()) && $user->activation == 1) {
                Auth::login($user);
                return \auth()->check();
            }
        }
    }

    public function showRegister()
    {
        if (!\auth()->check())
            return view('auth.register');
        else
            return redirect()->back()->with('status', 'داداش شما که لاگ اینی!!!');
    }

    public function register(RegisterRequest $request)
    {
        $arr = $request->validated();
        $arr['password'] = Hash::make($arr['password']);
        $user = User::create($arr);

        if ($this->attempt($request->get('email'), $request->get('password')))
        {
            $user = \auth()->user();
            Mail::to(auth()->user()->email)->send(new RegisterWelcome($user));
//            SendWelcomeEmailJob::dispatch($user)->delay(now()->minute);
            return redirect()->route('welcome')->with('status', "$user->name خوش آمدید ");
        } else
            return redirect()->back()->with('error', 'چنین کاربری از قبل وجود دارد!!!');
    }

    public function mobileLogin()
    {
        return view('auth.mobileLogin');
    }

    public function validation(Request $request)
    {
        $user=User::query()->where('mobile',$request->mobile)->first();
        if ($user && $user->activation==1){
            return view('auth.login')->withMobile($request->mobile);
        }
        elseif ($user && $user->activation==0){
            return redirect()->route('mobileLogin')->with('status','اکانت شما توسط ادمین غیر فعال شده است');
        }
        else {
            $code = rand(100000,999999);
            Log::info("$request->mobile :$code");
            Cache::put($request->mobile, $code, 120);
            return view('auth.code')->withMobile($request->mobile);
        }
    }

    public function login(Request $request)
    {
        $username = $request->get('mobile');
        $password = $request->get('password');
        $user = User::query()
            ->where('email', $username)
            ->orWhere('mobile', $username)
            ->first();
        if ($this->attempt($request->get('mobile'), $request->get('password'))) //Auth::login($user);
        {
            $username = $request->get('mobile');
            $password = $request->get('password');
            $user = User::query()
                ->where('email', $username)
                ->orWhere('mobile', $username)
                ->first();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.home')->with('status', "$user->name خوش آمدید ");
            }
            else
                return redirect()->route('welcome')->with('status', "$user->name خوش آمدید ");
        } else
            return redirect()->route('mobileLogin')->with('error', 'ایمیل یا رمز عبور وارد شده صحیح نمی باشد');
    }

    public function verifyCode(Request $request)
    {
        $cacheCode = Cache::get($request->mobile);
        if ($cacheCode != null && $cacheCode == $request->code){
            Cache::forget($request->mobile);
            return view('auth.information');
        }
        return response('try again');
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return redirect()->route('mobileLogin');
        } else
            return redirect()->route('mobileLogin')->with('status', 'شما وارد نشده اید که بخواهید خارج شوید!');
    }
}
