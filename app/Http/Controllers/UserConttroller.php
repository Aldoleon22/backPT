<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\models\users;
use app\Http\Requests\UserStoreRequest;

class UserConttroller extends Controller
{
    public function index(){
        $users = User::All();

        return response()->json([
            'resultat' => $users
        ],200);
    }
    public function store(UserStoreRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            return response()->json([
                'message' => 'user successfully created'
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'something went really wrong'
            ],500);
        }
    }


    public function show($id){
        $users = user::find($id);
        if(!$users){
         return response()->json(['message'=> 'user not found'],404);
        }
        return response()->json([
            'resultat' => $users
        ],200);

    }
}
