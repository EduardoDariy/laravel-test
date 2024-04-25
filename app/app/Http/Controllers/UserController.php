<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json($users);
    }

    public function create(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json([
            'message' => 'User added'
        ], 201);
    }

    public function destroy($id){
        if(User::where('id', $id)->exists()){
            $user = User::find($id);
            $user->delete();
            return response()->json([
                'message' => 'User deleted'
            ], 202);
        }
        else{
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
    }
}