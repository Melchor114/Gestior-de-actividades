<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Set Your Password</h1>

        <form action="{{ url('store-password') }}" method="POST">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="google_id" value="{{ $google_id }}">
            <input type="hidden" name="google_access_token" value="{{ $google_access_token }}">
            <input type="hidden" name="google_refresh_token" value="{{ $google_refresh_token }}">

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit">Set Password</button>
        </form>
    </div>
</body>

</html>