<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\VerificationController;
use Laravel\Socialite\Facades\Socialite;
use phpDocumentor\Reflection\Types\Nullable;

class AuthController extends Controller
{
    // PROSES LOGIN MANUAL
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->status == 'verify') {
                return redirect()->route('verification.index');
            }
            return redirect('/todo');
        }

        return back()->with('failed', 'Email atau password salah');
    }

    // PROSES REGISTRASI MANUAL
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|max:50|min:8',
            'confirm_password' => 'required|max:50|min:8|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'verify',
            
            
        ]);

        Auth::login($user);

        return app(VerificationController::class)->store($request->merge(['type' => 'register']));
    }

    // PROSES LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // --- FITUR LUPA PASSWORD ---
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function showResetPasswordForm()
    {
        if (!session('otp_verified_email')) {
            return redirect()->route('password.request')->with('error', 'Silakan verifikasi OTP terlebih dahulu');
        }
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = session('otp_verified_email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            session()->forget(['password_reset_email', 'otp_verified_email']);
            return redirect()->route('login')->with('success', 'Password berhasil diubah, silakan login');
        }

        return back()->with('failed', 'Terjadi kesalahan, silakan coba lagi');
    }

//     // --- FITUR LOGIN GOOGLE ---
    // public function redirectToGoogle()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function handlegoogleCallback()
    // {
        
    //         $googleUser = Socialite::driver('google')->user();
            
    //         // Cari user berdasarkan email
    //         $user = User::where('email', $googleUser->email)->first();

    //         if ($user) {
    //             // UPDATE: Jika user sudah ada
    //             $user->update([
    //                 'google_id' => $googleUser->id,
    //                 'status'    => 'active'
    //             ]);
    //         } else {
    //             // CREATE: Jika user belum ada
    //             $user = User::create([
    //                 'name'      => $googleUser->name,
    //                 'email'     => $googleUser->email,
    //                 'google_id' => $googleUser->id,
    //                 'password'  => null, // Password null karena login via Google
    //                 'status'    => 'active',
    //                 'role'      => 'customer'
    //             ]);
    //         }

    //         Auth::login($user);
    //         return redirect('/todo');

    //     {
    //         return redirect()->route('login')->with('failed', 'Gagal login via Google');
    //     }
    // }
    // --- FITUR LOGIN GOOGLE ---
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handlegoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // UPDATE: Jika user sudah ada
                $user->update([
                    'google_id' => $googleUser->id,
                    'status'    => 'active'
                ]);
            } else {
                // CREATE: Jika user belum ada
                $user = User::create([
                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password'  => null,
                    'status'    => 'active',
                    'role'      => 'customer'
                ]);
            }

            Auth::login($user);
            return redirect('/todo');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('failed', 'Gagal login via Google: ' . $e->getMessage());
            // dd($e->getMessage(), $e->getTraceAsString());
        }
    }
}