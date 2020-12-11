<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MobileController extends Controller
{
    public function sendVerificationCode($mobile)
    {
        $code = rand(10000, 99999);
        Log::info("$mobile :$code");
        Cache::put($mobile, $code, 120);
        return response('برو تایید کن موبایل رو');
    }

    public function verifyMobile($mobile, $code)
    {
        $cacheCode = Cache::get($mobile);
        if ($cacheCode != null && $cacheCode == $code){
            Cache::forget($mobile);
            return response('mobile has verified');
        }
        return response('try again');
    }
}
