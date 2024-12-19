@extends('layouts.app')



@section('content')

 <div class="container bg-secondary text-white justify-content-center d-flex my-4 p-4">
     <div class="mx-auto ">
           <h1>Add New Contact</h1>
           <form action="{{ route('contacts.store') }}" method="POST">
             @csrf
             <label>Name:</label><br>
             <input type="text" name="name" ><br>
             @error('name')
                    <div class="text-danger">{{ $message }}</div>
             @enderror
             <label>Email:</label><br>
             <input type="email" name="email" ><br>
             @error('email')
                    <div class="text-danger">{{ $message }}</div>
             @enderror
             <label>Phone:</label><br>
             <input type="text" name="phone" >
             @error('phone')
                    <div class="text-danger">{{ $message }}</div>
             @enderror
             <br><br>
             <button type="submit" class="btn btn-warning text-white">Save</button>
             <button class="btn btn-primary"><a href="{{route('contacts.index')}}" class="text-decoration-none text-light">Back</a></button>  
           </form>
     </div>
 </div> 


@endsection
