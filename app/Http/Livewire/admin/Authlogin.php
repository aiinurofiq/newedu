<?php

namespace App\Http\Livewire\admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Authlogin extends Component
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $curl = curl_init();
        $auth_data = array(
            'Bearer:'.'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjoiSGVsbG8sIFdvcmxkISIsImV4cGlyZWRfdG9rZW4iOiIyMDI0LTEyLTE4IDA2OjE1OjIwIn0.pv0Hdeu_0vW0LftHdWGkVnFn4J8DNTk3p-m-r2KyfWY',
        );
        $data = array(
            'kopeg' => $request->email,
            'password' => $request->password
        );
        $body = json_encode($data);
        curl_setopt($curl, CURLOPT_POST, 1);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
        curl_setopt($curl, CURLOPT_URL, 'https://hadir.wachid.dev/api/login');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $auth_data);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        $decode = json_decode($result);
        if($decode->status == 'true'){
            $user = User::where('kopeg', $request->email)->first();
            Auth::login($user);
            return redirect('/');
        }else{
            return redirect('/login')->with('error', 'The error message here!');
        }
    }
}
