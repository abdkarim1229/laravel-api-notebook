<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get(['id','image', 'name', 'email', 'gender']);
        return $this->successMessage(200, 'success', $users);
    }
    public function store(UserRequest $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email'
        ]);
        $register = $request->all();
        $gambar = $request->file('image')->store('public/image/user');
        $register['password'] = bcrypt($register['password']);
        $register['image'] = Storage::url($gambar);
        $user = User::create($register);
        return $this->successMessage(201, 'created', $user);
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return $this->errorMessage(404, 'Not Found');
        }
        return $this->successMessage(200, 'success', $user);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return $this->errorMessage(404, 'Not Found');
        }
        $request->validate([
            'email' => 'required|unique:users,email,' . $user->id
        ]);
        $data = $request->all();
        if ($request->image != null) {
            @unlink(public_path($user->image));
            $gambar = $request->file('image')->store('public/image/user');
            $data['image'] = Storage::url($gambar);
        }
        $user->update($data);
        return $this->successMessage(200, 'success', $data);
    }
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return $this->errorMessage(404, 'Not Found');
        }
        if ($user->image != null) {
            @unlink(public_path($user->image));
        }
        $user->delete();
    }

    // Return All Message Condition
    function errorMessage($status, $message)
    {
        return response([
            'status' => $status,
            'message' => $message
        ]);
    }
    function successMessage($status, $message, $data = [])
    {
        return response([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}
