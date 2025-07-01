<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter');

        $query = User::where('role', 'user');

        if ($filter === 'verified') {
            $query->where('is_verified', true);
        } elseif ($filter === 'unverified') {
            $query->where('is_verified', false);
        }

        $users = $query->paginate(10)->appends($request->query());


        return view('admin.users.index', compact('users', 'filter'));
    }


    public function verify(User $user)
    {
        $user->update(['is_verified' => true]);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diverifikasi.');
    }

    public function unverify(User $user)
    {
        $user->is_verified = false;
        $user->save();

        return redirect()->back()->with('success', 'Status verifikasi berhasil dibatalkan.');
    }
}
