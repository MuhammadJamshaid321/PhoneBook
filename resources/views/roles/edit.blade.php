@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Roles / Edit</div>                    
                    <div class="d-flex justify-content-end ">
                        <a href="{{ route('permissions.index') }}" class="btn btn-primary m-2">Back</a>
                    </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                       
                    <form action="{{route('roles.update',$role->id)}}" method="post">
                        @csrf
                        <div>
                            <label for="" class="py-2" >Name</label>
                            <div>
                               <input type="text" value="{{old('name', $role->name)}}" name="name" placeholder="Enter Name" class="w-50 rounded p-2">
                               @error('name')
                                   <p class="text-danger">{{$message}}</p>
                               @enderror
                            </div>
                            <div class="grid grid-col-4 mb-3">
                                @if ($permissions->isNotEmpty())
                                    @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                     <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }} type="checkbox" id="permission-{{ $permission->id }}" class="rounded" name="permission[]" value="{{ $permission->name }}">
                                     <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
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
