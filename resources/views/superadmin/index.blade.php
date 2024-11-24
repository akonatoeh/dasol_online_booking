@section('content')
<div class="container">
    <h1>Announcements</h1>
    <a href="{{ route('announcements.create') }}" class="btn btn-primary">Create Announcement</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($announcements as $announcement)
            <tr>
                <td>{{ $announcement->title }}</td>
                <td>{{ $announcement->content }}</td>
                <td>{{ $announcement->author }}</td>
                <td>{{ $announcement->expiry_date ?? 'N/A' }}</td>
                <td>
                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection