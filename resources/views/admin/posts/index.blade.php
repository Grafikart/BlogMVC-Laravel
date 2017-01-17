@extends('admin.layout')

@section('content')
    <h1>Manage posts</h1>

    <p>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add a new post</a>
    </p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Publication date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}" class="btn btn-primary">Edit</a>
                        {!! Form::model($post, ['method' => 'DELETE', 'route' => ['admin.posts.destroy', $post], 'style' => 'display:inline;']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="navigation">
        {{ $posts->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection