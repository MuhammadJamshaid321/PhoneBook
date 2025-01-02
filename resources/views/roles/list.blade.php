@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                  <div>
                 <div class="card-header">{{ __('Roles') }}
                    @can('create roles')
                     <div class="d-flex justify-content-end ">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
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
                            <th class="px-3">Permissions</th>
                            <th class="px-3">Created</th>
                            <th class="px-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if ($roles->isNotEmpty())
                            @foreach ($roles as $role)
                            <tr class="border-bottom">
                            <td class="px-3 text-left">{{ $role->id }}</td>
                            <td class="px-3 text-left">{{ $role->name }}</td>
                            <td class="px-3 text-left">{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                            <td class="px-3 text-left">{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}</td>
                            <td class="px-3 text-left">
                                @can('edit roles') 
                                 <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-warning m-2">Edit</a>
                                @endcan
                                @can('delete roles')
                                <button type="button" class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deletePermissionModal{{$role->id}}">Delete</button>
                                <div class="modal fade" id="deletePermissionModal{{ $role->id }}" tabindex="-1" aria-labelledby="deletePermissionModalLabel{{ $role->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="deletePermissionModalLabel{{ $role->id }}">Delete Roles</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Are you sure you want to delete the role {{ $role->name }}?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-danger" onclick="deleteRole({{$role->id}})">Delete</button>
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
                   <div class="d-flex justify-content-end my-2" >{{ $roles->links() }}</div>
                </div>

            </div>
        </div>
    </div>
 </div>
  <div name="script">
     <script type="text/javascript">
      function deleteRole(id){
        // if (confirm("Are you sure you want to delete ?")) {
            $.ajax({
                url : '{{ route('roles.destroy') }}',
                type : 'delete',
                data : {id:id},
                dataType : 'json',
                headers: {
                    'x-csrf-token' : '{{ csrf_token() }}'
                },
                success : function(response){
                     window.location.href = '{{ route('roles.index') }}'
                }

            });
        }
    //   }
     </script>
  </div>
@endsection
