<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use Log;

class FeedController extends Controller
{
    //
    public function index()
    {
        return view('pages.feed.index');
    }

    public function create()
    {
        return view('pages.feed.create');
    }

    public function edit()
    {
        return view('pages.feed.edit');
    }

    public function show(Feed $feed)
    {
        //dd($feed);
        Log::debug("Show Feed",['feed'=>$feed]);
        return view('pages.feed.show',compact('feed'));
    }

    public function update(Request $request, Feed $feed)
    {

        $validated_request=$request->validate([
            'title'=>'required | string | max:100',
            'description'=>'required | string | max:300',
        ]);

        $feed->update($validated_request);
        return redirect()->route('feeds');

        // $feed->update($this->validateRequest($request));
        //  return redirect()->route('feeds')->with('success','Feed Updated Successfully');


    }

    

}
