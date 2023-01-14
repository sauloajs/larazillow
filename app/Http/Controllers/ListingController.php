<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Listing;
use Auth;
use Illuminate\Http\Request;

class ListingController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(Listing::class, 'listing');
  }

  public function index()
  {
    return inertia(
      'Listing/Index',
      [
        'listings' => Listing::all()
      ]
    );
  }

  public function create()
  {
    return inertia(
      'Listing/Create'
    );
  }

  public function store(ListingRequest $request)
  {
    $listing = Listing::make($request->validated());
    $request->user()->listings()->save($listing);


    return redirect()->route('listing.index')
      ->with('success', 'Listing was created!');
  }

  public function show(Listing $listing)
  {
    return inertia(
      'Listing/Show',
      [
        'listing' => $listing
      ]
    );
  }

  public function edit(Listing $listing)
  {
    return inertia(
      'Listing/Edit',
      [
        'listing' => $listing
      ]
    );
  }

  public function update(ListingRequest $request, Listing $listing)
  {
    $listing->update($request->validated());

    return redirect()->route('listing.index')
      ->with('success', 'Listing was updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Listing $listing)
  {
    $listing->delete();

    return redirect()->back()->with('success', 'Listing was excluded');
  }
}
