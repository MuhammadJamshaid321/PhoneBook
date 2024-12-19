@extends('layouts.app')

@section('content') 
  <div class="container bg-secondary text-white justify-content-center d-flex my-4 p-5">
       <div class="mx-auto">
          <h1>Contact Details</h1>
          <p><strong>Name:</strong> {{ $contact->name }}</p>
          <p><strong>Email:</strong> {{ $contact->email }}</p>
          <p><strong>Phone:</strong> {{ $contact->phone }}</p>
          <button class="btn btn-primary"><a href="{{route('contacts.index')}}" class="text-decoration-none text-light">Back</a></button>
       </div>
  </div>

    
@endsection