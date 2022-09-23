<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Address;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('admin.user_index', compact('user'));
    }

    public function detail(int $id)
    {
        $user = User::find($id);

        $address = Address::where('user_id', $id)->get();

        return view('admin.user_detail', compact('user', 'address'));
    }
}
