<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserGeneratePinRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Initialize Service to use
     *
     * @param UserService $UserService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * Sends an email that invites a user to join 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function SendInvitation(UserSendInviteRequest $request)
    // this validation rules can filter if email already exist in the system
    public function sendInvitation(Request $request) // can improve by creating validation rules as example above
    {
        DB::beginTransaction();

        try {

            $this->userService->sendInvitation($request);

            $this->data['results']['message'] = "Invitation Successfully Sent.";
            $this->data['status'] = 200;

        } catch (\Exception $e) {
            $this->data['error'] = $e->getMessage();
            DB::rollBack();
        }

        DB::commit();
        return response()->json($this->data, $this->data['status']); 
    }

    /**
     * Genearate a PIN/Token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        // will rollback all db events (store, update, delete) if there is an error encountered
        DB::beginTransaction();

        try {

            $request->validated(); // validation
            $this->userService->storeUser($request);

            $this->data['results']['message'] = "Please check email to verify user account.";
            $this->data['status'] = 200;

        } catch (\Exception $e) {
            $this->data['error'] = $e->getMessage();
            DB::rollBack();
        }

        DB::commit();
        return response()->json($this->data, $this->data['status']); 
    }

    /**
     * Verify the PIN/Token
     *
     * @param String $pin
     * @return \Illuminate\Http\Response
     */
    public function verifyUser(Request $request)
    {
        // will rollback all db events (store, update, delete) if there is an error encountered
        DB::beginTransaction();

        try {

            $this->userService->verifyUserPin($request);

            $this->data['results']['message'] = "Your account has been successfully verified/registered.";
            $this->data['status'] = 200;

        } catch (\Exception $e) {
            $this->data['error'] = $e->getMessage();
            DB::rollBack();
        }

        DB::commit();
        return response()->json($this->data, $this->data['status']); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $request->validated(); // validation
            $this->userService->updateUser($request, $id);

            $this->data['results']['message'] = "User Succesfully updated.";
            $this->data['status'] = 200;

        } catch (Exception $e) {

            $this->data['error'] = $e->getMessage();
            DB::rollBack();
        }

        DB::commit();
        return response()->json($this->data, $this->data['status']); 
    }

}
