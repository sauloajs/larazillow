<?php

namespace App\Http\Controllers;

use App\Http\Requests\RealtorListingImageRequest;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    /**
     * Render page to add images to the listing
     *
     * @param Listing $listing The listing to add images
     *
     * @return Response
     */
    public function create(Listing $listing)
    {
        $listing->load(['images']);

        return inertia(
            'Realtor/ListingImage/Create',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Store images for the listing
     *
     * @param Listing                    $listing The listing to add images
     * @param RealtorListingImageRequest $request User Request
     *
     * @return Response
     */
    public function store(Listing $listing, RealtorListingImageRequest $request)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $listing->images()->save(
                    new ListingImage(
                        [
                        'filename' => $path
                        ]
                    )
                );
            }

            $listing->save();
        }

        return redirect()
            ->back()
            ->with('success', 'Images uploaded!');
    }

    /**
     * Delete image from database and storage
     *
     * @param Listing      $listing The listing to remove a file
     * @param ListingImage $image   The file to be removed
     *
     * @return Response
     */
    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()
            ->back()
            ->with('success', 'Image deleted!');
    }
}
