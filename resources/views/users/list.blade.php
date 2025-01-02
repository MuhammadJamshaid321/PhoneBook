@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                  <div>
                 <div class="card-header">{{ __('Users') }}
                    @can('create users')
                      <div class="d-flex justify-content-end ">
                          <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
                        </div>                     
                    @endcan    
                 </div>

                 <div class="">
                   <x-message></x-message>  
                   <table class="w-100 ">
                    <thead class="bg-dark bg-gradient bg-opacity-25">
                        <tr class="border-none border-bottom">
                            <th class="px-3">#</th>
                            <th class="px-3">Name</th>
                            <th class="px-3">Emails</th>
                            <th class="px-3">Roles</th>
                            <th class="px-3">Created</th>
                            <th class="px-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if ($users->isNotEmpty())
                            @foreach ($users as $user)
                            <tr class="border-bottom">
                            <td class="px-6 py-1 text-left">{{ $user->id }}</td>
                            <td class="px-6 py-1 text-left">{{ $user->name }}</td>
                            <td class="px-6 py-1 text-left">{{ $user->email }}</td>
                            <td class="px-6 py-1 text-left">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                            <td class="px-6 py-1 text-left">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</td>
                            <td class="px-6 py-1 text-left">
                              @can('edit users')
                                  <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning m-2">Edit</a>
                              @endcan
                              <button type="button" class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deletePermissionModal{{ $user->id }}">Delete</button>
                              <div class="modal fade" id="deletePermissionModal{{ $user->id }}" tabindex="-1" aria-labelledby="deletePermissionModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="deletePermissionModalLabel{{ $user->id }}">Delete Users</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Are you sure you want to delete the user {{ $user->name }}?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-danger" onclick="deleteUser({{ $user->id }})">Delete</button>
                                    </div>
                                  </div>
                                </div>
                               </div>
                            </td>
                            </tr>
                            @endforeach                  
                            @endif
                    </tbody>
                   </table>
                   <div class="d-flex justify-content-end my-2" >{{ $users->links() }}</div>
                </div>

            </div>
        </div>
    </div>
 </div>
  <div name="script">
     <script type="text/javascript">
      function deleteUser(id){
            $.ajax({
                url : '{{ route('users.destroy') }}',
                type : 'delete',
                data : {id:id},
                dataType : 'json',
                headers: {
                    'x-csrf-token' : '{{ csrf_token() }}'
                },
                success : function(response){
                     window.location.href = '{{ route('users.index') }}'
                }

            });
        }
     </script>
  </div>
@endsection
