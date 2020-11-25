<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResources;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index(){
        $saldo = $this->saldo();
        return view('user/profile', ['user' => Auth::user(), 'saldo' => $saldo]);
    }

    public function _get(){
        $user = new UserResources(Auth::user());
        if(!$user){
            return response()->json(['status' => 'Bad request'], 400);
        }
        return response()->json($user, 200);
    }

    // public function update_save(Request $request){
    //     // TODO: validate

    //     // update
    //     $user = User::find(Auth::id());
    //     if( $request->name ){
    //         $user->name = $request->name;
    //     }
    //     if( $request->email ){
    //         $user->email = $request->email;
    //         Mail::send('template.email-verification', ['user' => $request, 'token' => $user->email_verification_token], function ($m) use ($user) {
    //             $m->from('no-reply@makarya.in', 'Makarya - PT. Inspira Karya Teknologin Nusantara');
    //             $m->to($user->email, $user->name)->subject('Email verification @makarya.in');
    //         });
    //     }

    //     // if( $request->password ){
    //     //     if( Hash::check($request->password, $user->password) ){
    //     //         $user->password = Hash::make($request->password);
    //     //     }
    //     // }

    //     // if( $request->file('image') ){
    //     //     $image_name = Str::random(32).'.jpg';
    //     //     $this->upload_image('user', $request->file('image'), $image_name);
    //     //     $user->image = $image_name;
    //     // }

    //     if( $request->file('image-ktp') ){
    //         $image_name = Str::random(32).'.jpg';
    //         $this->upload_image('user_ktp', $request->file('image-ktp'), $image_name);
    //         $user->image_ktp = $image_name;
    //     }

    //     if( $request->file('image-npwp') ){
    //         $image_name = Str::random(32).'.jpg';
    //         $this->upload_image('user_npwp', $request->file('image-npwp'), $image_name);
    //         $user->image_npwp = $image_name;
    //     }

    //     $user->updated_at = Carbon::now();
    //     $user->save();
    //     return redirect('/profile');
    // }

    //Update Profile

    

    // ! Daerah Admin ! //
    public function ktp_verification(){
        $this->admin_only();
        $users = User::whereNotNull('ktp_image')->whereNull('ktp_verified_at')->paginate(10);
        return view('/profile/ktp', ['users' => $users]);
    }

    public function ktp_verification_detail($user_id){
        $user = User::find($user_id)->first();
        return view('/profile/ktp-detail', ['user' => $user]);
    }
    
    public function ktp_verification_do(Request $request){
        $user = User::find($request->id);
        $user->ktp_verified_by = Auth::id();
        $user->ktp_verified_at = Carbon::now();
        return ('/profile/ktp');
    }

    public function npwp_verification(){
        $this->admin_only();
        $users = User::whereNotNull('npwp_image')->whereNull('npwp_verified_at')->paginate(10);
        return view('/profile/npwp', ['users' => $users]);
    }

    public function npwp_verification_detail($user_id){
        $user = User::find($user_id)->first();
        return view('/profile/npwp-detail', ['user' => $user]);
    }

    public function npwp_verification_do(Request $request){
        $user = User::find($request->id);
        $user->npwp_verified_by = Auth::id();
        $user->npwp_verified_at = Carbon::now();
        return ('/profile/ktp');
    }
}
