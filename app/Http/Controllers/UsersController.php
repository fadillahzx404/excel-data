<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::All();
        return view('users.index', ['users' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            // Do something with the file
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('/images/photo_profile', 'public');
        }
        $data['roles'] = $data['roles'];
        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect()
            ->route('user-settings.index')
            ->with('Success', 'Users telah di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $User, $id)
    {
        $data = User::findOrFail($id);
        return view('users.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $id)
    {
        $data = $request->all();



        $item = User::findOrFail($id);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            unset($data['password']); // agar tidak tertimpa null
        }

        if ($request->hasFile('profile_photo_path')) {
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('/images/photo_profile', 'public');
        }


        $item->update($data);

        return redirect()
            ->route('user-settings.index')
            ->with('Success', 'Users telah di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User, $id)
    {
        $item = User::findorFail($id);

        $item->delete();

        return redirect()
            ->route('user-settings.index')
            ->with('Success', 'User berhasil dihapus !');
    }
}
