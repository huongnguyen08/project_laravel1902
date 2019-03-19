<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;
use Auth;

class PageController extends Controller
{
    function logout(){
        Auth::logout();
        return redirect('login');
    }
    function index(){
        return view('pages.home');
    }
    function getLogin(){
        return view('user.login');
    }
    function postLogin(Request $req){
        $username = $req->username;
        $password = $req->password;
        // dd($req->only('email','password'));
        if(\Auth::attempt(['username'=>$username,'password'=>$password])){
            return redirect('/');
        }
        else{
            return redirect()->route('login')
                    ->with('error','Login fail!!');
        }
        
    } 
    function getRegister(){
        return view('user.register');
    }
    function postRegister(Request $req){
        $mess = [
            'email.required'=>'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.min' => 'Email ít nhất :min kí tự',
            'email.unique'=> ':attribute đã có người sử dụng',
            'password_confirmation.same' => 'Password không giống nhau'
        ];
        $rules = [
            'email'=>'required|email|min:10|unique:users,email',
            'username'=>'required|min:3|unique:users',
            'password'=>'required|min:6',
            'password_confirmation' => 'same:password'
        ];
        $validator = Validator::make($req->all(),$rules,$mess);
        if($validator->fails())
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        else{

            $user = new User;
            $user->email = $req->email;
            $user->username = $req->username;
            $user->fullname = $req->fullname;
            $user->birthdate = $req->birthdate;
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect()->route('login');
        }
    }  
}
// bcrypt