<h1>Profile User</h1>

<form method="POST" action="/profile/update">
    @csrf

    <input type="text" name="name" value="{{ $user->name }}">
    <br><br>

    <input type="email" name="email" value="{{ $user->email }}">
    <br><br>

    <button type="submit">Update Profile</button>
</form>

<br>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>