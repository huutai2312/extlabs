<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $countries = ['Vietnam', 'United States', 'Canada']; // Thêm các quốc gia bạn muốn cho user chọn
        return view('auth.register', compact('countries'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_details,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'country' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Sử dụng bcrypt để mã hóa mật khẩu
            'remember_token' => Str::random(10),
        ]);

        UserDetail::create([
            'id_user' => $user->id,
            'username' => $request->username,
            'role' => 'user',
            'country' => $request->country,
            'account_status' => 'inactive',
        ]);

        return redirect()->route('home')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
    }
}
