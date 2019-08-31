<?php
/**
 * Created by PhpStorm.
 * User: Anukkrit
 * Date: 23-05-2019
 * Summary-
 * API Used-
 * Limitations-
 */

namespace App\Http\Controllers;

use Validator;
use Auth;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function index()
    {
     return view('login');
    }

    function checklogin(Request $r){
        $this->validate($r,[
            'email' =>  'required|email',
            'password'  => 'required|alphaNum|min:4'
            ]);

        $userData=array(
            'email' => $r->get('email'),
            'password' => $r->get('password')
            );
        if(Auth::attempt($userData))
        {
            return redirect('main/success');
        }
        else{
            return back()->with('error','Wrong Login Details');
        }
    }

    function success(){
        return view('dashboard');
    }

    function logout(){
        Auth::logout();
        return redirect('main');
    }
}
?>
