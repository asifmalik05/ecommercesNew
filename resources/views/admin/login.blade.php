<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 360px; margin: 100px auto; padding: 24px; background: #fff; border-radius: 8px; box-shadow: 0 8px 24px rgba(0,0,0,.08); }
        .field { margin-bottom: 16px; }
        .field label { display: block; margin-bottom: 6px; font-weight: 600; }
        .field input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .button { width: 100%; padding: 10px; background: #2d3748; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .errors { color: #b91c1c; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button class="button" type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>