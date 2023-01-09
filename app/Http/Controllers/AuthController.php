<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function create()
  {
    return inertia('Auth/Login');
  }

  public function store(AuthRequest $request)
  {
    $data = $request->validated();
    $auth = Auth::attempt($data, true);

    if (!$auth)
    {
      throw ValidationException::withMessages([
        'email' => 'Authentication Failed'
      ]);
    };

    $request->session()->regenerate();

    return redirect()->intended('listing');
  }

  public function destroy(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('listing.index');
  }
}
