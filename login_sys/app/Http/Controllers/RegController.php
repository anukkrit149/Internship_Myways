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

use App\User;
use Validator;
use Auth;
use Illuminate\Http\Request;

class RegController extends Controller
{

    function index(){

        return view('reg');

    }

    function createUser(Request $request){
        $this->validate($request,[
           'name' => 'required',
           'email' => 'required|email',
            'phone' => 'required|required|regex:/(01)[0-9]{9}/',
            'pass'  => 'required|alphaNum|Min:8'
        ]);

        $userData=array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'pass' => $request->get('pass')
        );

        $user=User::create($userData);

        auth()->login($user);

        return redirect()->to('');

    }


}
