<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ReceptionController extends Controller
{
    public function index()
    {
        $user = User::orderBy('name');
        if (\request('search')) {
            $user = User::where('name', 'like', '%' . \request('search') . '%')
                ->orWhere('username', 'like', '%' . \request('search') . '%')
                ->orderBy('name');
        } elseif (request('status')) {
            $user = User::where(
                'status',
                'like',
                '%' . \request('status') . '%'
            )->orderBy('name');
        }
        return view('dashboard.reception.index', [
            'title' => 'User',
            'users' => $user->get(),
        ]);
    }

    public function store(Request $request)
    {
        // return request()->all();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:5', 'max:255', 'unique:users'],
            'status' => 'required',
            'phone' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        $request->session()->flash('success', 'User has been added!');

        return redirect('/user');
    }

    public function update(Request $request)
    {
        $updateUser = User::findorFail($request->user_name);
        $updateUser->name = $request->name;
        $updateUser->username = $request->username;
        $updateUser->status = $request->status;
        $updateUser->phone = $request->phone;
        $updateUser->email = $request->email;
        $updateUser->save();

        return Redirect('/user')->with('success', 'User has been updated!');
    }

    public function updatePersonal(Request $request)
    {
        $updateUser = User::findorFail($request->user_name);
        $updateUser->name = $request->name;
        $updateUser->username = $request->username;
        $updateUser->status = $request->status;
        $updateUser->phone = $request->phone;
        $updateUser->email = $request->email;
        $updateUser->password = $request->password;
        $updateUser->save();

        return back()->with('success', 'User has been updated!');
    }

    public function destroy($id)
    {
        $updateUser = User::find($id);
        $updateUser->status = 0;
        $updateUser->save();

        return Redirect('/user');
    }
}
