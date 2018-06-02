<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * 登陆
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'account' => 'required|exists:users,account',
            'password' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error'=>$validatedData->errors()]);
        }

        return var_dump($validatedData);

        if (Auth::attempt($validatedData)) {
            $user = Auth::user();
            $token = $user->refreshToken($user->account)->accessToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
