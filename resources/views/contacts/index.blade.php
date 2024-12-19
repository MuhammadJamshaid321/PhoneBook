@extends('layouts.app')

@section('content')

    <script>
        function confirmDelete(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Show a confirmation dialog
            const userConfirmed = confirm("Do you want to delete this contact?");

            // If the user confirms, submit the form
            if (userConfirmed) {
                event.target.closest("form").submit();
            }
        }
    </script>
    
    <button class="btn btn-primary mt-2">   
         <a href="{{route('contacts.create')}}" class="text-decoration-none text-light">New Contact</a>
    </button>
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
                    <button class="btn btn-info ">
                        <a href="{{ route('contacts.show', $contact->id) }}" class="text-decoration-none text-light">Show</a>
                    </button>
                    <button class="btn btn-warning">
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="text-decoration-none text-light">Edit</a>
                    </button>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete(event)" class="btn btn-danger text-light">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
