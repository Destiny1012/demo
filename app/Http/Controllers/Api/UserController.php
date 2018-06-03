<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        if (DB::select('select * from oauth_access_tokens where name = "' . $request->account . '"')) {
            DB::delete('delete from oauth_access_tokens where name = "' . $request->account . '"');
        }

        if (Auth::attempt(['account' => $request->account, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken($user->account)->accessToken;
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
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'account' => 'required|unique:users,account',
            'password' => 'required',
            'name' => 'required|unique:users,name',
            'phone' => 'nullable|unique:users,phone',
            'email' => 'nullable|unique:users,email',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error'=>$validatedData->errors()]);
        }

        $user = User::create([
            'account' => $request->account,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $token = $user->createToken($user->account)->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if ($user->id <> $id) {
            $msg = '用户不统一！';
            return response()->json([
                'err' => 1,
                'msg' => $msg,
            ]);
        }

        return response()->json([
            'user' => $user,
        ]);
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
}
