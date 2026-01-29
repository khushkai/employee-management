<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body>
    <div style="display: flex; align-items: center; background-color: #007bff; padding: 15px 30px; color: #fff;">
    <!-- Left link -->
    <a href="{{ route('dashboard') }}" style="color: #fff; font-weight: bold; text-decoration: none;">
        Employee Management Dashboard
    </a>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
        {{ session('error') }}
    </div>
@endif
    <!-- Right logout button -->
    <form action="{{ route('logout') }}" method="POST" style="margin-left: auto;">
        @csrf
        <button type="submit" style="
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        ">
            Logout
        </button>
    </form>
</div>
<br>
    <nav style="background:#f2f2f2; padding:10px; text-align:center;">
        <a href="{{ route('about') }}" style="margin:0 15px; text-decoration:none; color:#333; font-weight:600;">About Us</a>
        <a href="{{ route('contact') }}" style="margin:0 15px; text-decoration:none; color:#333; font-weight:600;">Contact Us</a>
        <a href="{{ route('services') }}" style="margin:0 15px; text-decoration:none; color:#333; font-weight:600;">Services</a>
        <a href="{{ route('products') }}" style="margin:0 15px; text-decoration:none; color:#333; font-weight:600;">Products</a>
        <a href="{{ route('test.index') }}" style="margin:0 15px; text-decoration:none; color:#333; font-weight:600;">Test</a>
        <a href="{{ route('crud.index') }}" style="margin:0 15px; text-decoration:none; color:#333; font-weight:600;">Crud</a>
        <a href="{{ route('demo.index') }}" style="margin:0 15px; text-decoration:none; color:#333; font-weight:600;">Demo</a>
    </nav>
 
    </nav>


    <div class="content">
        @yield('content')
    </div>
</body>
</html>
