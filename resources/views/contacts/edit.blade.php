@extends('layouts.app')

@section('content')
  <div class="container bg-secondary text-white justify-content-center d-flex my-4 p-4">
    <div class="mx-auto">
         <h1>Edit Contact</h1>
         <form action="/contacts/{{ $contact->id }}" method="POST">
              @csrf
              @method('PUT')
              <label>Name:</label><br>
              <input type="text" name="name" value="{{ $contact->name }}" required><br>
              <label>Email:</label><br>
              <input type="email" name="email" value="{{ $contact->email }} " required><br>
              <label>Phone:</label><br>
              <input type="text" name="phone" value="{{ $contact->phone }}" required><br><br>
              <button type="submit" class="btn btn-warning text-light">Update</button>
              <button class="btn btn-primary"><a href="/" class="text-decoration-none text-light">Back</a></button>
              
           
        </form>
     </div>
  </div>
        
@endsection