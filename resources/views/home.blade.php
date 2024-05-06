<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>You are LogIn</p>
    <form action="/logout" method='POST'>
        @csrf
        <button>LogOut</button>
    </form>

    <div>
        <h2>Create a new Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Post Title">
            <br>
            <textarea name="body" placeholder="Body Content" id="" cols="30" rows="10"></textarea>
            <br>
            <button>Save Post</button>
        </form>
    </div>

    <div>
        <h2>All Post</h2>
        @foreach($posts as $post)
        <div style="background-color: antiquewhite; padding:4rem  ">
            <h3>{{$post['title']}}</h3>
            <p>{{$post['body']}}</p>
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>

        </div>
        @endforeach
    </div>

    @else 
    <div>
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <br>
            <input name="email" type="email" placeholder="email">
            <br>
            <input name="password" type="password" placeholder="password">
            <br>
            <button>Register</button>
        </form>
    </div>
    <div>
        <h2>LogIn</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="logname" type="text" placeholder="name">
            <br>
            <input name="logpassword" type="password" placeholder="password">
            <br>
            <button>LogIn</button>
        </form>
    </div>
    @endauth
</body>
</html>