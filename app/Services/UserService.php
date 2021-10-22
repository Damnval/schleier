<?php

namespace App\Services;

use App\Mail\SendUserInvitationLink;
use App\Mail\SendUserVerification;
use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService 
{
    /**
     * Will send an email to the invited email address
     *
     * @param Object $request
     * @return void
     */
	public function sendInvitation($request)
	{
        $email = $request->input('email');
        // will send an email to the user 
        Mail::send(new SendUserInvitationLink($email));
	}

    /**
     * Will save user credential but not yet active
     *
    * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function storeUser($request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        
        $user = new User();
        $user->fill($data);
        $user->save();

        $this->sendPinToUser($user);
    }

    /**
     * Will create a PIN upon submitting form
     *
     * @param Object $user
     * @return void
     */
    public function sendPinToUser($user)
    {

        $data = [
            'user_id' => $user->id,
            'token' => generateRandomNumber(),
            'active' => 1,
        ];

        //generate token or PIN
        $token = Token::create($data);

        if($token){
            //sends an email for the user to verify its account
            Mail::send(new SendUserVerification($user, $token));
        }
    }

    /**
     * Verify user account
     *
     * @param Object $request
     * @return boolean
     */
    public function verifyUserPin($request)
    {
        $data = $request->all();

        $where = [
            ['token', $data['token']],
            ['user_id', $data['userId']],
            ['revoked', 0],
        ]; 

        // find if email and token exists
        $token = Token::where($where)->first();
        
        if(!$token){
            throw new \Exception("Invalid Token.");
        }

        return $this->updateUserRegisteredTime($data);
    }

    /**
     * Will activate or update registered time in users table
     *
     * @param array $data
     * @return Boolean
     */
    public function updateUserRegisteredTime($data)
    {
        $update_data = [
            'registered_at' => now()
        ];

        $user = User::find($data['userId']);

        return $user->update($update_data);
    }

    /**
     * Editing User record in storage
     *
     * @param Object $request
     * @return void
     */
    public function updateUser($request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);

        $user->update($data);
        $user->save();
    }

}