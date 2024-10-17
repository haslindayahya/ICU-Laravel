<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Log;

class FeedController extends Controller
{
    //
    public function index()
    {
        $feeds=Feed::paginate(5);
        return view('pages.feed.index', compact('feeds'));
    }

    public function create()
    {
        return view('pages.feed.create');
    }

    public function edit()
    {
        return view('pages.feed.edit');
    }

    // public function show(Feed $feed)
    // {
    //     //dd($feed);
    //     Log::debug("Show Feed",['feed'=>$feed]);
    //     return view('pages.feed.show',compact('feed'));
    // }

    public function update(Request $request, Feed $feed)
    {

        $validated_request=$request->validate([
            'title'=>'required | string | max:100',
            'description'=>'required | string | max:300',
        ]);

        $feed->update($validated_request);
        //return redirect()->route('feeds');

        // $feed->update($this->validateRequest($request));
        return redirect()->route('feeds')->with('success','Feed Updated Successfully');


    }

    public function store(Request $request)
    {

        $validated_request=$request->validate([
            'title'=>'required | string | max:100| min:3',
            'description'=>'required | string | max:300',
        ]);

        //ORM
        $user=Auth::user();
        $validated_request['user_id']=$user->id;


        Feed::create($validated_request);
        //return redirect()->route('feeds');

          return redirect()->route('feeds')->with('success','Feed Created Successfully');
    }

    
    public function show(Feed $feed )
    {
        Gate::authorize('update', $feed);
        return view('pages.feed.show', compact('feed'));
    }


    

}
