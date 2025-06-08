<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

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

@endauth

@guest
    {{-- Registration form --}}
    <div style="border: 3px solid black; padding: 1em; width: 300px; margin-bottom: 1em;">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Name" required>
            <input name="email" type="text" placeholder="Email" required>
            <input name="password" type="password" placeholder="Password" required>
            <button style="background-color: aquamarine; margin-top: 0.5em;">Register</button>
        </form>
    </div>

    {{-- Login form --}}
    <div style="border: 3px solid black; padding: 1em; width: 300px;">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="Name" required>
            <input name="loginpassword" type="password" placeholder="Password" required>
            <button style="background-color: aquamarine; margin-top: 0.5em;">Login</button>
        </form>
    </div>
@endguest

</body>
</html>
