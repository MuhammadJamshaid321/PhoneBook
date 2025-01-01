@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users / Edit</div>                    
                    <div class="d-flex justify-content-end ">
                        <a href="{{ route('users.index') }}" class="btn btn-primary m-2">Back</a>
                    </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                       
                    <form action="{{route('users.update',$user->id)}}" method="post">
                        @csrf
                        <div>
                            <label for="" class="py-2" >Name</label>
                            <div>
                               <input type="text" value="{{old('name', $user->name)}}" name="name" placeholder="Enter Name" class="w-50 rounded p-2">
                               @error('name')
                                   <p class="text-danger">{{$message}}</p>
                               @enderror
                            </div>
                            <label for="" class="py-2" >Email</label>
                            <div>
                               <input type="text" value="{{old('email', $user->email)}}" name="email" placeholder="Enter email" class="w-50 rounded p-2">
                               @error('email')
                                   <p class="text-danger">{{$message}}</p>
                               @enderror
                            </div>
                            <div class="grid grid-col-4 mb-3">
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                    <div class="mt-3">
                                     <input {{ ($hasRoles->contains($role->id)) ? 'checked' : '' }} type="checkbox" id="role-{{ $role->id }}" class="rounded" name="role[]" value="{{ $role->name }}">
                                     <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div> 
                                    @endforeach
                                @endif
                                
                            </div>
                            <button class="btn btn-primary my-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
