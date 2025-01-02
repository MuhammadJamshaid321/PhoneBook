@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                  <div>
                 <div class="card-header">{{ __('Permissions') }}
                    @can('create permissions')
                      <div class="d-flex justify-content-end ">
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create</a>
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
                            <th class="px-3">Created</th>
                            <th class="px-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $permission)
                            <tr class="border-bottom">
                             <td class="px-6 py-1 text-left">{{ $permission->id }}</td>
                             <td class="px-6 py-1 text-left">{{ $permission->name }}</td>
                             <td class="px-6 py-1 text-left">{{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}</td>
                             <td class="px-6 py-1 text-left">
                                @can('edit permissions')  
                                   <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-warning m-2">Edit</a>
                                @endcan  
                                @can('delete permissions')  
                                   <button type="button" class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deletePermissionModal{{ $permission->id }}">Delete</button>
                                   <div class="modal fade" id="deletePermissionModal{{ $permission->id }}" tabindex="-1" aria-labelledby="deletePermissionModalLabel{{ $permission->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="deletePermissionModalLabel{{ $permission->id }}">Delete Permission</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Are you sure you want to delete the permission {{ $permission->name }}?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-danger" onclick="deletePermission({{ $permission->id }})">Delete</button>
                                        </div>
                                      </div>
                                    </div>
                                   </div>
                                @endcan
                                </td>
                            </tr>
                            @endforeach
                                
                            @endif
                    </tbody>
                   </table>
                   <div class="d-flex justify-content-end my-2" >{{ $permissions->links() }}</div>
                </div>

            </div>
        </div>
    </div>
 </div>
  <div name="script">
     <script type="text/javascript">
      function deletePermission(id) {
        // Send the DELETE request to the server here
        $.ajax({
            url : '{{ route('permissions.destroy') }}',
            type : 'delete',
            data : {id:id},
            dataType : 'json',
            headers: {
                'x-csrf-token' : '{{ csrf_token() }}'
            },
            success : function(response){
                 window.location.href = '{{ route('permissions.index') }}'
            }
        });
      }
     </script>
  </div>
@endsection