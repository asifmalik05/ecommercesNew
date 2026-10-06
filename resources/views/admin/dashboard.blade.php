<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: sans-serif; background: #eef2ff; margin: 0; padding: 0; }
        .header { background: #4f46e5; color: #fff; padding: 18px 24px; }
        .content { max-width: 1000px; margin: 24px auto; padding: 24px; background: #fff; border-radius: 10px; }
        .logout { float: right; color: #fff; text-decoration: none; }
        .card { padding: 18px; border: 1px solid #e5e7eb; border-radius: 10px; margin-top: 18px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="display: inline-block; margin: 0;">Admin Dashboard</h1>
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline-block; margin-left: 24px;">
            @csrf
            <button style="padding: 10px 14px; border: none; background: #1f2937; color: #fff; border-radius: 6px; cursor: pointer;">Logout</button>
        </form>
    </div>

    <div class="content">
        <div class="card">
            <h2>Welcome</h2>
            <p>Use this dashboard to manage the store, orders, and products.</p>
        </div>
    </div>
</body>
</html>