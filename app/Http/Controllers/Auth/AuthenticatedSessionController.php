<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * ログイン後のリダイレクト先
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectTo()
    {
        // ログイン後に 管理者ページにリダイレクト
        $redirectUrl = route('dashboard'); // リダイレクト先のURL
        Log::info('Redirect URL: ' . $redirectUrl); 
        
        return route('dashboard');
    }

    /**
     * ログイン画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('auth.login');
    }

    /**
     * ログイン処理
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        \Log::info('ログイン処理開始', $request->only('email'));

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
           
            \Log::info('ログイン成功:', $request->only('email'));

            // ログイン後にリダイレクト
            return redirect()->intended($this->redirectTo());
        }

        \Log::warning('ログイン失敗:', $request->only('email')); 
        return back()->withErrors(['email' => '認証に失敗しました。']);
    }

    /**
     * ログアウト処理
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
