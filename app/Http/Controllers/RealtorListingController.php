<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Listing;
use Auth;
use Illuminate\Http\Request;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request User request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(
                [
                    'by',
                    'order'
                ]
            )
        ];

        return inertia(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->filter($filters)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(5)
                    ->withQueryString()
                ],
        );
    }

    /**
     * Show a individual listing resource
     *
     * @param Listing $listing The listing to be displayed
     *
     * @return Response
     */
    public function show(Listing $listing)
    {
        return inertia(
            'Realtor/Show',
            [
                'listing' => $listing->load('offers', 'offers.bidder'),
            ]
        );
    }

    public function create()
    {
        return inertia(
            'Realtor/Create'
        );
    }

    public function store(ListingRequest $request)
    {
        $listing = Listing::make($request->validated());
        $request->user()->listings()->save($listing);


        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
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
     * Soft delete the listing resource.
     *
     * @param Listing $listing The listing to be deleted
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with('success', 'Listing was excluded');
    }

    /**
     * Restore Listing object
     *
     * @param Listing $listing The listing to be restored.
     *
     * @return Response
     */
    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()
            ->back()
            ->with('success', 'Listing was restored successfully!');
    }
}
