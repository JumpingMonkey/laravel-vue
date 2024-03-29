<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ... $request->only(['by', 'order']),
        ];
        $user = Auth::user();
        $listing = $user
            ->listings()
            ->filter($filters)
            ->withCount('images')
            ->withCount('offers')
            ->paginate(6)
            ->withQueryString();

        return inertia(
            'Realtor/Index',
            [
                'listings' => $listing,
                'filters' => $filters,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Listing::class);
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->user()->listings()->create(
                $request->validate([
                    'beds' => 'required|integer|min:0|max:20',
                    'baths' => 'required|integer|min:0|max:20',
                    'area' => 'required|integer|min:15|max:1500',
                    'city' => 'required',
                    'code' => 'required',
                    'street' => 'required',
                    'street_nr' => 'required|min:1|max:1000',
                    'price' => 'required|min:1|integer|max:20000000',
                ])
            );

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return inertia('Realtor/Show',
        [
            'listing' => $listing->load('offers', 'offers.bidder'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|min:1|integer|max:20000000',
            ])
        );

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
