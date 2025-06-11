@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
    {{-- Logged in state --}}
    <p>You are logged in</p>

    <form action="/logout" method="POST" style="margin-bottom: 1em;">
        @csrf
        <button>Log out</button>
    </form>

    {{-- File upload section --}}
    <div style="border: 3px solid green; padding: 1em; width: 400px; margin-bottom: 1em;">
        <h2>Upload a File</h2>
        <form action="/files/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="uploadfile" required>
            <button style="background-color: lightblue; margin-top: 0.5em;">Upload</button>
        </form>
    </div>

    {{-- List of uploaded files --}}
    <div style="border: 3px solid navy; padding: 1em; width: 400px;">
        <h2>Your Uploaded Files</h2>
        @if(isset($files) && count($files))
            <ul style="padding-left: 1.2em;">
                @foreach($files as $file)
                    <li style="margin-bottom: 0.5em;">
                        {{ $file }}
                        <a href="{{ url('/files/view/' . $file) }}" target="_blank" style="margin-left: 10px;">View</a>
                        <form action="{{ url('/files/delete/' . $file) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button style="color: red; margin-left: 10px;">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No files uploaded yet.</p>
        @endif
    </div>

    {{-- Post creation --}}
    <hr>
    <h2>Create Post</h2>
    <form method="POST" action="/posts">
        @csrf
        <textarea name="body" rows="4" cols="50" required></textarea><br>
        <button type="submit">Post</button>
    </form>

    {{-- Posts list --}}
    <h3>Your Posts</h3>
    @if(Auth::check() && Auth::user()->posts && count(Auth::user()->posts))
        @foreach (Auth::user()->posts as $post)
            <div style="border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
                <form method="POST" action="/posts/{{ $post->id }}">
                    @csrf
                    @method('PUT')
                    <textarea name="body" rows="2" cols="50">{{ $post->body }}</textarea><br>
                    <button type="submit">Update</button>
                </form>
                <form method="POST" action="/posts/{{ $post->id }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
    @else
        <p>You have no posts yet.</p>
    @endif
    @endauth

    @guest
    {{-- Registration form --}}
    <div style="border: 3px solid black; padding: 1em; width: 300px; margin-bottom: 1em;" class="registration">
        <h2>Register</h2>
        <form action="/register" method="POST" >
            @csrf
            <input name="name" type="text" placeholder="Name" required>
            <input name="email" type="text" placeholder="Email" required>
            <input name="password" type="password" placeholder="Password" required>
            <button style="background-color: aquamarine; margin-top: 0.5em;">Register</button>
        </form>
    </div>

    {{-- Login form --}}
    <div style="border: 3px solid black; padding: 1em; width: 300px;" class="registration">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="Name" required>
            <input name="loginpassword" type="password" placeholder="Password" required>
            <button style="background-color: aquamarine; margin-top: 0.5em;">Login</button>
        </form>
    </div>
    @endguest
</div>
@endsection
