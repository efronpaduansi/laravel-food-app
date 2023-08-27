<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Session;
class AuthController extends Controller
{
    public function index()
    {
        return view('web.login');
    }

    public function doLogin(Request $request){
        $validated = Validator::make($request->all(), [
            'email'                     => 'required|email',
            'password'                  => 'required|min:5'
        ], [
            'email.required'            => 'Email tidak boleh kosong',
            'email.email'               => 'Email tidak valid',
            'password.required'         => 'Password tidak boleh kosong',
        ]);

        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            //jika level admin maka akan diarahkan ke halaman admin
            if (auth()->user()->level == 'admin') {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('guest.home');
            }
        }
        return redirect()->back()->with('error', 'Oppss! Email atau Password salah.');
    }

    public function register()
    {
        return view('web.register');
    }

    public function doRegister(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name'                      => 'required',
            'email'                     => 'required|email|unique:users',
            'password'                  => 'required|min:5',
            'passConf'                  => 'required|same:password'
        ], [
            'name.required'             => 'Nama tidak boleh kosong',
            'email.required'            => 'Email tidak boleh kosong',
            'email.email'               => 'Email tidak valid',
            'email.unique'              => 'Email sudah terdaftar',
            'password.required'         => 'Password tidak boleh kosong',
            'password.min'              => 'Password minimal 5 karakter',
            'passConf.required'         => 'Konfirmasi password tidak boleh kosong',
            'passConf.same'             => 'Konfirmasi password tidak sama'
        ]);

            if($validated->fails()){
                return redirect()->back()->withErrors($validated)->withInput();
            }else{
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect('/login')->with('success', 'Pendaftaran berhasil, silahkan login');
            }
    }

    public function logout()
    {
        auth()->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect('/');
    }
}
