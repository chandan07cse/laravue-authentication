<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use App\PasswordReset;
use App\User;
use App\Mail\Invite;
use Illuminate\Http\Request;
use Hash;

class AuthController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth:api')->only('logout');
        $this->request = $request;
    }

    public function register()
    {
        $this->validate($this->request,[
            'username'=>'required|max:255|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|between:6,25|confirmed'
        ]);
        $user = new User($this->request->all());
        $user->password = bcrypt($this->request->password);
        $user->activation_token = str_random(30);
        $user->save();
        \Mail::to($user)->send(new Invite($user));
        return response()->json([
            'registered'=>true
        ]);
    }

    public function email_verification_confirmed()
    {
        $user = User::whereActivationToken($this->request->activation_token)->firstOrFail();
        if($user){
            $user->active = 1;
            $user->activation_token = null;
            $user->save();
            return response()->json([
                'verified'=>true
            ]);
        }
        else
            return response()->json([
                'verified' =>false
            ]);
    }

    public function login()
    {
        $this->validate($this->request,[
            'email'=>'required|email',
            'password'=>'required|between:6,25'
        ]);
        $user = User::where('email',$this->request->email)->first();
        if($user && Hash::check($this->request->password,$user->password)){
            if($user->active==1) {
                $user->api_token = str_random(60);
                $user->save();
                return response()->json([
                    'authenticated' => true,
                    'api_token' => $user->api_token,
                    'user_id' => $user->id
                ]);
            }
            else
                return response()->json([
                    'wrong' => ['Please Verify Your Email Address First']
                ],422);
        }
        return response()->json([
            'wrong'=>['Wrong Credentials']
        ],422);
    }

    public function logout()
    {
        $user = $this->request->user();
        $user->api_token = null;
        $user->save();
        return response()->json([
            'logged_out'=>true
        ]);
    }

    public function send_reset_pass_link()
    {
        //first we'll check that the email exists in our system and throw a message
        //defining custom message for checking existing emails of users
        $messages = [
            'required' => 'Please input an email address',
            'email' => 'Please input an valid email address',
            'exists' => 'The :attribute is not associated with our system'
        ];
        //then validate
        $this->validate($this->request,[
            'email'=>'required|email|exists:users'
        ],$messages);
        //store associated email and token in password_resets table & send the link to that email
        $password_reset = new PasswordReset($this->request->all());
        $password_reset->token = str_random(30);
        $password_reset->save();

        \Mail::to($password_reset)->send(new PasswordResetMail($password_reset));

        return response()->json([
            'sending_email'=>true
        ]);
    }

    public function check_pass_reset_token()
    {
        $exist = PasswordReset::whereToken($this->request->token)->firstOrFail();
        $status = $exist ? true : false;
        return response()->json([
            'state'=>$status
        ]);
    }

    public function reset_password()
    {
        //validating the request
        $this->validate($this->request,[
            'password'=>'required|min:6|confirmed'
        ]);
        //encrypting the new password of the user with bcrypt
        $password = bcrypt($this->request->password);
        //assign the token into a token variable
        $token = $this->request->verify_token;
        //pick the row of the specific token
        $password_reset = PasswordReset::whereToken($token)->firstOrFail();
        //fetch the email of that row
        $email = $password_reset->email;
        //now we'll update the user with new password
        User::where('email', $email)
            ->update(['password' => $password]);
        //now we'll remove the value of that specific row of the specified token from PasswordReset table
        PasswordReset::where('token', $token)->delete();
        //and finally return the api response of reset status
        return response()->json([
            'reset'=>true
        ]);
    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return response()->json([
            'id'=>$id
        ]);
    }
}