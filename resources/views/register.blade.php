
<style>
    .form-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #f9f9f9;
    }
    .form-container h3 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
    .btn-submit {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        border: none;
        color: #fff;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-submit:hover {
        background-color: #218838;
    }
    .alert {
        color: #721c24;
        background-color: #f8d7da;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="form-container">
    <h3>Admin Register</h3>

    @if($errors->any())
        <div class="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" class="form-control" required>
        <input type="email" name="email" placeholder="Email" class="form-control" required>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
        <button type="submit" class="btn-submit">Register</button>
    </form>
</div>

