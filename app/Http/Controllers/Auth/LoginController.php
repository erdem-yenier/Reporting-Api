<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\LoginFormRequest;

class LoginController extends Controller
{

    ########### giriş yapma
    public function login()
    {
        return view('login');
    }

    ########### giriş post yapma
    public function loginPost(LoginFormRequest $request) {
        
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $response = Http::post('https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login', [
                'email' => $email,
                'password' => $password,
            ]);
        
            if ($response->successful()) {
                $token = $response->json()['token'];
        
                session([
                    'api_token' => $token,
                    'token_start_time' => Carbon::now(),
                ]);
        
                return redirect()->route('dashboard.index')->with(['loginSuccess' => trans('auth.login.success.messages')]);
    
            } else {
                return redirect()->route('auth.login')->with(['loginError' => trans('auth.login.error.messages')]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['loginInfo' => trans('auth.login.info.messages')]);
        }

    }

    ########### token temizleme
    public function logout()
    {
        session()->flush();
        return redirect()->route('auth.login')->with(['logout' => trans('auth.logout.info.messages')]);
    }
}
