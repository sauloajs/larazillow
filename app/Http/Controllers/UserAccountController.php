<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserAccountRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
  public function create()
  {
    return inertia('UserAccount/Register');
  }

  public function store(CreateUserAccountRequest $request)
  {
    $user = User::create($request->validated());

    Auth::login($user);

    return redirect()->route('listing.index')->with('success', 'Account created!');
  }
}
