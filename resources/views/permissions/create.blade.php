@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permission / Create</div>                    
                    <div class="d-flex justify-content-end ">
                        <a href="{{ route('permissions.index') }}" class="btn btn-primary m-2">Back</a>
                    </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                       
                    <form action="{{route('permissions.store')}}" method="post">
                        @csrf
                        <div>
                            <label for="" class="py-2" >Name</label>
                            <div>
                               <input type="text" value="{{old('name')}}" name="name" placeholder="Enter Name" class="w-50 rounded p-2">
                               @error('name')
                                   <p class="text-danger">{{$message}}</p>
                               @enderror
                            </div>
                            <button class="btn btn-primary my-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
