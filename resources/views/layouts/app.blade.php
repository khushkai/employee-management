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

  

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
