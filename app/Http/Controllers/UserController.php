<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request){

        $incomingFields = $request->validate([
            'logname' => 'required',
            'logpassword' => 'required'
        ]);
        if(auth()->attempt(['name' => $incomingFields['logname'], 'password' => $incomingFields['logpassword'] ])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => 'required'
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);

        auth()->login($user);
        return redirect('/');
    }
}
