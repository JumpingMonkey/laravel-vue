<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);
        //Accept selected offer
        $offer->update(['accepted_at' => now()]);

        //Reject all other offers
        $listing->offers()->except($offer)
            ->update(['rejected_at' => now()]);

        $listing->sold_at = now();
        $listing->save();

        return redirect()->back()->with('success', "Offer $offer->id was accepted, other offers rejacted");
    }
}
