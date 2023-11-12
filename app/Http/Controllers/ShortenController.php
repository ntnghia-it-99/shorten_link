<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortenLink;

class ShortenController extends Controller
{
    public function shortenLink(Request $req)
    {
        $link = new ShortenLink();
        $link->link_redirect = $req->link_redirect;
        $link->link_shorten = $req->link_shorten;
        $link->save();
        if ($link->save()) {
            return response()->json([
                'message' => "Successfully",
                'data' => ShortenLink::all()
            ], 200);
        } else {
            return response()->json(['error' => 'Something went wrong'], 400);
        }
    }

    public function redirectLink($link)
    {
        try {
            $url = ShortenLink::where('link_shorten', $link)->firstOrFail();
            // dd($url);
            return response()->json([
                'message' => "Successfully",
                'data' => $url->link_redirect
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong', 'status' => 'Failed!'], 400);

        }
    }

    public function getLink()
    {
        return ShortenLink::all();
    }
}
