@extends('layouts.main')

@section('title','New Feed')
    
@section('content')


    <div class="container">

    <h1>New Feed</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}  </li>
                @endforeach
            </ul>
        </div>
        
    @endif

            
        <form action="{{ route('feed.store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Feed Title</label>
            <input 
                type="text"
                class="form-control" 
                name="title" 
                id="title"
                
                {{-- minlength="3"
                maxlength="100"
                required> --}} >
          </div>
        <div class="mb-3">
        <label for="title" class="form-label">Description</label>
        <textarea 
                class="form-control" 
                name="description"
                id="description"
                cols="30" 
                rows="10"
                >
        </textarea>
        </div>
          <button type="submit" class="btn btn-primary">Save Feed</button>
        </form>
    </div>

    
@endsection