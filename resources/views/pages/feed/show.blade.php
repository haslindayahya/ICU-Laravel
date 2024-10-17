@extends('layouts.main')

@section('title','Feed Edit')
    
@section('content')


    <h1>Feed Edit</h1>
   
    <div class="container">

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
          
      @endif

        <form action="{{ route('feed.update',['feed'=>$feed->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Feed Title</label>
            <input 
                type="text"
                class="form-control" 
                name="title" 
                id="title"
                value="{{ old('title', $feed->title) }}" 
                required
                minlength="3"
                maxlength="100"
                required>
          </div>
        <div class="mb-3">
        <label for="title" class="form-label">Description</label>
        <textarea 
                class="form-control" 
                name="description"
                id="description"
                cols="30" 
                rows="10"
                >{{ old('description', $feed->description) }}
        </textarea>
        </div>
          <button type="submit" class="btn btn-primary">Update Feed</button>
        </form>
    </div>
    
@endsection