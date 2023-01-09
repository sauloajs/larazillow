<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
      return redirect()->route('listing.index');
      // return inertia(
      //     'Index/Index',
      //     [
      //         'message' => 'Laravel message!'
      //     ]
      // );
    }

    public function show()
    {
      return inertia('Index/Show');
    }
}
