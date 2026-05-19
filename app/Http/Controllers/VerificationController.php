<?php

namespace App\Http\Controllers;

use App\Mail\OtpEmail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function index()
    {
        return view('verification.index');
    }

  
    public function show(Request $request, $unique_id)
    {
        // 1. Cari data verifikasi yang masih aktif
        $verify = Verification::where('unique_id', $unique_id)
            ->where('status', 'active')
            ->first();
        
        if(!$verify) {
            return redirect('/login')->with('failed', 'Link verifikasi sudah tidak berlaku.');
        }

        $user = User::find($verify->user_id);

       
        if ($request->query('via') == 'email' && $verify->type == 'register') {
            $verify->update(['status' => 'valid']);
            $user->update(['status' => 'active']);
            Auth::login($user);

            return redirect('/todo')->with('success', 'Email berhasil diverifikasi via link!');
        }

       
        return view('verification.show', compact('unique_id'));
    }

    
    public function update(Request $request, $unique_id)
    {
        $verify = Verification::where('unique_id', $unique_id)
            ->where('status', 'active')
            ->first();

        if(!$verify){
            abort(404);
        }

        $user = User::find($verify->user_id);

        // Cek apakah kode OTP yang diinput (setelah MD5) cocok dengan DB
        if(md5($request->otp) != $verify->otp){
            return redirect()->back()->with('failed', 'Kode OTP Salah!');
        }

        // Verifikasi Sukses
        $verify->update(['status' => 'valid']);
        $user->update(['status' => 'active']);
        
        if(!Auth::check()){
            Auth::login($user);
        }

        return redirect('/todo')->with('success', 'Verifikasi manual berhasil!');
    }

   
    public function store(Request $request)
    {
        $user = null;
        
        if($request->type == 'register'){
            $user = Auth::user() ? Auth::user() : User::find($request->user_id);
        } else {
            $user = User::where('email', $request->email)->first();
        }
        
        if(!$user) return back()->with('failed', 'User tidak ditemukan');
        
        $otp = rand(100000, 999999);
        $unique_id = uniqid(); 

        $verify = Verification::create([
            'user_id'   => $user->id, 
            'unique_id' => $unique_id, 
            'otp'       => md5($otp),
            'type'      => $request->type,
            'send_via'  => 'email',
            'status'    => 'active'
        ]);
        
        
        $url_email = route('verification.show', ['unique_id' => $unique_id, 'via' => 'email']);
        
        $details = [
            'otp' => $otp,
            'link'=> $url_email,
            'nama'=> $user->name
        ];

        Mail::to($user->email)->queue(new OtpEmail($details));
        
        // Arahkan user ke halaman input OTP (Tanpa parameter 'via')
        return redirect()->route('verification.show', $unique_id);
    }
}