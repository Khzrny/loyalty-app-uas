<h1>Register</h1>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nama">
    <br><br>

    <input type="email" name="email" placeholder="Email">
    <br><br>

    <input type="password" name="password" placeholder="Password">
    <br><br>

    <button type="submit">Register</button>
</form>