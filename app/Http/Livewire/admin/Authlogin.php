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
            $user = User::where('kopeg', strtoupper($request->email))->first();
            Auth::login($user);
            return redirect('/');
        }else{
            return redirect('/login')->with('error', 'The error message here!');
        }
    }
    public function loginfromhris($id)
    {
        $domain = array('jasatirta1.com', 'jasatirta1.co.id');
        $temp = true;
        // echo $_GET['referrer'];
        // echo $_SERVER['HTTP_REFERER'];
        // exit();
		if (isset($_SERVER['HTTP_REFERER'])) {
			foreach ($domain as $val) {
				if (strpos($_SERVER['HTTP_REFERER'], $val) !== FALSE){
                    $temp = false;
                    $kopeg = $this->decrypt($id);
                    $user = User::where('kopeg', strtoupper($kopeg))->first();
                    if($user){
                        // session_start();
                        // $_SESSION['referrer'] = $_GET['referrer'];
                        session(['referrer' => $_GET['referrer'],'link' => $_SERVER['HTTP_REFERER']]);
                        Auth::login($user);
                        return redirect('/');
                    }else{
                        return redirect('/login');
                    }
                }
            }
            if($temp){
                return redirect('/login');
            }
        }else{
            return redirect('/login');
        }
    }
    function encrypt($string, $salt = null)
    {
        if ($salt === null) {
            $salt = hash('sha256', uniqid(mt_rand(), true));
        }  // this is an unique salt per entry and directly stored within a password
        return base64_encode(openssl_encrypt($string, 'AES-256-CBC', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjoiSGVsbG8sIFdvcmxkISIsImV4cGlyZWRfdG9rZW4iOiIyMDI0LTEyLTE4IDA2OjE1OjIwIn0.pv0Hdeu_0vW0LftHdWGkVnFn4J8DNTk3p-m-r2KyfWY', 0, str_pad(substr($salt, 0, 16), 16, '0', STR_PAD_LEFT))) . ':' . $salt;
    }
    function decrypt($string)
    {
        if (count(explode(':', $string)) !== 2) {
            return $string;
        }
        $salt = explode(":", $string)[1];
        $string = explode(":", $string)[0]; // read salt from entry
        return openssl_decrypt(base64_decode($string), 'AES-256-CBC', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjoiSGVsbG8sIFdvcmxkISIsImV4cGlyZWRfdG9rZW4iOiIyMDI0LTEyLTE4IDA2OjE1OjIwIn0.pv0Hdeu_0vW0LftHdWGkVnFn4J8DNTk3p-m-r2KyfWY', 0, str_pad(substr($salt, 0, 16), 16, '0', STR_PAD_LEFT));
    }
}
