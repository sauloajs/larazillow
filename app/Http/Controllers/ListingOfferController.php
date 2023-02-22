<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    /**
     * Store new offer to a listing
     *
     * @param Listing      $listing The listing to add a offer
     * @param OfferRequest $request User request
     *
     * @return Response
     */
    public function store(Listing $listing, OfferRequest $request)
    {
        $listing->offers()->save(
            Offer::make(
                $request->validated()
            )
            ->bidder()
            ->associate($request->user())
        );

        return redirect()->back()->with('success', 'Offer made successfully!');
    }
}
