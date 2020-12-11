<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private function attempt($username, $password)
    {
        $user = User::query()
            ->where('email', $username)
            ->orWhere('mobile', $username);

        if ($user->exists()) {
            if (Hash::check($password, $user->first()->getAuthPassword())) {
                Auth::login($user->first());
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
        if (User::query()->where('mobile',$request->mobile)->first()){
            return view('auth.login')->withMobile($request->mobile);
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
        if ($this->attempt($request->get('mobile'), $request->get('password'))) //Auth::login($user);
        {
            $username = $request->get('mobile');
            $password = $request->get('password');
            $user = User::query()
                ->where('email', $username)
                ->orWhere('mobile', $username)
                ->first();
            return redirect()->route('welcome')->with('status', "$user->name خوش آمدید ");
        } else
            return redirect()->route('mobileLogin')->with('error', 'ایمیل یا رمز عبور وارد شده صحیح نمی باشد');
    }

    public function verifyCode(Request $request)
    {
        $cacheCode = Cache::get($request->mobile);
        if ($cacheCode != null && $cacheCode == $request->code){
            Cache::forget($request->mobile);
            return response('mobile has verified');
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
