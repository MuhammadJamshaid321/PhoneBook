@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('update'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @can('create contacts')
    <button class="btn btn-primary mt-2">
        <a href="{{ route('contacts.create') }}" class="text-decoration-none text-light">New Contact</a>
    </button>
    @endcan
    <div class="text-end">
        <form action="{{ route('contacts.index') }}" method="GET" class="d-inline-block">
            <div class="d-flex justify-content-end">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by name or email">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="submit" href ="{{ route('contacts.index') }}" class="btn btn-warning mx-2">Back</button>

            </div>
        </form>
    </div>
        
    <table border="1" class="table m-2">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>CRUD</th>
        </tr>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    
                    <button class="btn btn-info">
                        <a href="{{ route('contacts.show', $contact->id) }}" class="text-decoration-none text-light">Show</a>
                    </button>
                    
                    
                    <button class="btn btn-warning">
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="text-decoration-none text-light">Edit</a>
                    </button>
                    
                    
                    <button class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $contact->id }}">Delete</button>
                    
                </td>
            </tr>
        @endforeach
    </table>
    <!-- Pagination Links -->
    <div class="d-flex justify-content-end">
        {{ $contacts->links() }}
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this contact?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const contactId = button.getAttribute('data-id'); // Extract the contact ID
        const form = document.getElementById('deleteForm');
        form.action = `/contact/${contactId}`; // Update the form action dynamically to match the route
    });
</script>


@endsection
