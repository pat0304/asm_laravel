<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifyUser;
use DateTime;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('user.auth.index', ['title' => 'Đăng nhập']);
    }
    public function change()
    {
        return view('user.auth.change', ['title' => 'Đổi mật khẩu']);
    }

    private function createToken(string $username, string $email, DateTimeInterface $date)
    {

    }
    public function login(Request $request)
    {
        $request->validate([
            "username" => "required",
            "password" => "required",
        ], [
            "username.required" => "Please enter a username",
            "password.required" => "Please enter a password",
        ]);
        if (
            Auth::attempt([
                'username' => $request->username,
                'password' => $request->password
            ])
        ) {
            $role = Auth::user()->role;
            if ($role == 1)
                return redirect("/admin");
            else if ($role == 0) {
                return redirect('/');
            } else {
                return redirect()->back()->withErrors("Invalid username or password");
            }
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'reg_username' => 'required',
            'reg_email' => ['required', 'email'],
            'reg_password' => 'required',
            'reg_phone' => ['required'],
            'reg_repassword' => 'required'
        ], [
            'reg_username.required' => 'Please enter a username',
            'reg_email.required' => 'Please enter an email address',
            'reg_email.email' => "Invalid email address",
            'reg_phone.required' => 'Please enter a phone number',
            'reg_password.required' => 'Please enter a password',
            'reg_repassword.required' => 'Please enter a password again'
        ]);
        if (User::where('username', '=', $request->reg_username)->first() == null) {
            $user = User::create([
                'username' => $request->reg_username,
                'email' => $request->reg_email,
                'phone' => $request->reg_phone,
                'password' => bcrypt($request->reg_password),
            ]);
            Auth::login($user);
            return redirect()->route('auth.index')->with('success', 'Your account has been created');
        } else {
            return redirect()->route('auth.index')->with('error', 'Username has already existed');
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.index')->with('Đăng xuất thành công');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required',
        ], [
            'password.required' => 'Không bỏ trống trường này',
            'new_password.required' => 'Không bỏ trống trường này'
        ]);
        if (
            Auth::attempt([
                "username" => Auth::user()->username
                ,
                "password" => $request->password
            ])
        ) {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route("auth.changePassword.index")->with('success', 'Mật khẩu đã được đổi');
        }
        return redirect()->route("auth.changePassword.index")->with('fail', 'Mật khẩu chưa được đổi');
    }

    public function forgotIndex()
    {
        return view('user.auth.forgot')->with('title', 'Forgot Password');
    }
    public function forgot(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required|email',
            ],
            [
                'username.required' => 'Please enter your username',
                'email.required' => 'Please enter your email'
            ]
        );
        $user = User::where([
            ['username', 'LIKE', $request->username],
            ['email', 'LIKE', $request->email]
        ])->first();
        if ($user != null) {
            $verify = VerifyUser::create(['user_id' => $user->id, 'expire_at' => now()->addMinutes(5)->toDateTimeString()]);
            Mail::send('mail.authentication-email', compact('verify', 'user'), function ($email) use ($user) {
                $email->to($user->email, 'Reset Password');
            });
            return redirect()->route('auth.forgot.index')->with('success', 'Check your email for reset password');
        } else {
            return redirect()->route('auth.forgot.index')->with('fail', 'Your username or email is invalid');
        }
    }
    public function resetIndex()
    {
        $id = explode('/', $_SERVER['PATH_INFO'])[2];
        $verify = VerifyUser::findOrFail($id);
        if (strtotime($verify->expire_at) > strtotime(now())) {
            return view('user.auth.reset', with(['title' => 'Reset Password', 'user_id' => $verify->user_id]));
        } else {
            return redirect()->route('auth.forgot.index')->with('fail', 'Đường dẫn đặt lại mật khẩu đã hết hạn');
        }

    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'repassword' => 'required'
        ]);
        if ($request->password == $request->repassword) {
            $user = User::findOrFail($request->user);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('auth.index')->with('success', 'Mật khẩu của bạn đã được đặt lại');
        } else {
            return redirect()->back()->with('fail', 'Mật khẩu không trùng nhau');
        }

    }
}