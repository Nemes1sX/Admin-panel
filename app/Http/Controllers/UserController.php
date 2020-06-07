<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }//
    public function create(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|regex:/(^(a-zA-Z\s))*$/|unique:users',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|max:20|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function edit($id){
        $user = User::find($id);

        return response()->json([
            'status' => 'sucess',
            'user' => $user->toArray()
        ], 200);

    }

    public function update(Request $request, $id){

        $user = User::find($id); 
        
        $v = Validator::make($request->all(), [
            'name' => 'required|string|regex:/(^(a-zA-Z\s))*$/|unique:users',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|max:20|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user->update($request->all());
        return response()->json([
            'status' => 'success',
            'msg' => 'Deleted Successfully.'
        ], 200);
    }

    public function delete($id){

    $user = User::find($id);

    $user->delete();
    return response()->json([
        'status' => 'success',
        'msg' => 'Deleted Successfully.'
    ], 200);
}
}
