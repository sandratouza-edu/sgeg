<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>controladores usuarios</title>
</head>
<body>
    <h2>Users list</h2>

    <ul>
        @forelse($users as $user)            
            <li> {{ $user-> name }} </li>
        @empty
        <li> List empty</li>
        @endforelse
    </ul>
</body>
</html>