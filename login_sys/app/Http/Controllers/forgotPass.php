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

class forgotPass extends Controller
{




    function index(){

        return view('getPhno');
    }

    function recover(Request $request){


        if($request->has('phoneno')) {

            $PHONENO = $request->post('phoneno');

            $RESULT = DB::select( DB::raw("SELECT phoneno FROM users WHERE phoneno = :PHONENO"), array(
                'PHONENO' => $PHONENO,
            ));

            if (!$RESULT || mysqli_num_rows($RESULT) == 0)
                  return view('getPhno');


            $OTP = rand(10000, 99999);



            ////apistart

            $apiKey = urlencode('0l8pshMgTqA-9wLGGfIdvagZm8ePbJ5MsRvKC0i6Jr');

            // Message details
            $numbers = array($PHONENO);
            $sender = urlencode('TXTLCL');
            $message = rawurlencode('Your verification code is '.$OTP);

            $numbers = implode(',', $numbers);

            // Prepare data for POST request
            $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            // Process your response here
            echo $response;



            ///apiend



            $_SESSION['OTP'] = $OTP;
            $_SESSION['PHONENO'] = $PHONENO;
            return view('otpVerify');
        }

        if($request->has('otp') && $request->has('password')) {

            $OTP = $request->post('otp');
            $NEWPASSWORD = $request->post('password');
            if ($OTP == $_SESSION['OTP']) {
                $HASHEDPASSWORD = bcrypt($NEWPASSWORD);
                $PHONENO =$_SESSION['PHONENO'];
                DB::raw("UPDATE users SET password='$HASHEDPASSWORD' WHERE phoneno = '$PHONENO'");
                return view('login');
            }

            return view('otpVerify');
        }

     return view('getPhno');

    }

}
