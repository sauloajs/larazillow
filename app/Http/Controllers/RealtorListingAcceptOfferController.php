<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    /**
     * Accept a offer for a Listing
     *
     * @param Offer $offer The offer to be accepted
     *
     * @return Response
     */
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        $offer->update(
            [
              'accepted_at' => now()
            ]
        );

        $listing->sold_at = now();
        $listing->save();

        $listing->offers()->except($offer)->update(
            [
                'rejected_at' => now()
            ]
        );

        return redirect()
            ->back()
            ->with(
                'success',
                "Offer #{$offer->id} accepted, others offers are rejected!"
            );
    }
}
