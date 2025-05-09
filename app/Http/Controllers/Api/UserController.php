<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = user::create($validated);

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return user::findOrFail($id);
    }

    /**
     * Display current logged user details.
     */
    public function profile(Request $request)
    {

        return $request->user();

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);

        $validated = $request->validated();
 
        $user->firstname     = $validated['firstname'];
        $user->middlename    = $validated['middlename'] ?? null;
        $user->lastname      = $validated['lastname'];
        $user->email         = $validated['email'];
        $user->username      = $validated['username'];
        $user->age           = $validated['age'];
        $user->grade_level   = $validated['grade_level'];
        $user->school_name   = $validated['school_name'];
        $user->section       = $validated['section'];
        $user->address       = $validated['address'];
 
        $user->save();

        return $user;
    }

    public function email(UserRequest $request, string $id)
    {
        $user = User::find($id);

        $validated = $request->validated();
 
        $user->email = $validated['email'];

        return $user;
    }
    /**
     * Update the password of the specified resource in storage.
     */
    public function password(UserRequest $request, string $id)
    {
        $user = User::find($id);

        $validated = $request->validated();
 
        $user->password = $validated['password'];
 
        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $user;
    }
}
