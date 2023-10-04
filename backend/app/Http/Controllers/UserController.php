<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function register(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'address' => 'string',
        'phone' => 'numeric|unique:users',

        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'address' => $validatedData['address'],
        'phone' => $validatedData['phone'],
        'password' => Hash::make($validatedData['password']),
    ]);

    return response()->json(['message' => 'User registered successfully']);
}



public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'User logged in successfully', 'user' => $user]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
}

public function update( Request $request, $id){

    $userData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email,' . $id,
        'address' => 'string',
        'phone' => 'numeric|unique:users,phone,' . $id,
    ]);

$user = User::find($id);

if(!$user){
    return response()->json(['message' => 'User not found'], 404);
}
$user->update($userData);

return response()->json(['message' => 'User updated successfully', 'user' => $user]);

}

public function index(){
    $allUser = User::all();
    return $allUser;
}
public function show($id){
    $user = User::find($id);
    return $user;
}

public function destroy($id){
    $user = User::find($id);
    if(!$user){
        return response()->json(['message' => 'User not found'], 404);
    }
    $user->delete();
    return response()->json(['message' => 'User deleted successfully']);
    

}
}
