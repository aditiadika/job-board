<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::where('is_active', true)
            ->with('tags')
            ->latest()
            ->get();

        $tags = Tag::orderBy('name')->get();

        if ($request->has('s'))
        {
            $query = strtolower($request->get('s'));
            $listings = $listings->filter(function ($item) use ($query) {

                if (Str::contains(strtolower($item->title), $query))
                {
                    return true;
                }

                if (Str::contains(strtolower($item->company), $query))
                {
                    return true;
                }

                if (Str::contains(strtolower($item->location), $query))
                {
                    return true;
                }

                return false;
            });
        }

        if ($request->has('tag'))
        {
            $tag = $request->get('tag');
            $listings = $listings->filter(function ($item) use ($tag) {
                return $item->tags->contains('slug', $tag);
            });
        }

        return view('listings.index', compact('listings', 'tags'));
    }

    public function create()
    {
        //
    }
}
