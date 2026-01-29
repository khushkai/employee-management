@extends('layouts.app')
@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-size: 26px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .required-star {
        color: red;
        margin-left: 3px;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        margin-bottom: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 16px;
        box-sizing: border-box;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    .form-control.is-invalid {
        border-color: red;
        background-color: #ffe6e6;
    }

    .error-msg {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
        color: #fff;
    }

    .btn-success { background-color: #28a745; }
    .btn-success:hover { background-color: #218838; }

    .btn-primary { background-color: #007bff; }
    .btn-primary:hover { background-color: #0069d9; }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
    }
</style>

<div class="form-container">
    <h2>{{ isset($demo) ? 'Edit Demo' : 'Add Demo' }}</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ isset($demo) ? route('demo.update', $demo->id) : route('demo.store') }}" method="POST" novalidate>
        @csrf
        @if(isset($demo))
            @method('PUT')
        @endif

        <div>
            <label>Name <span class="required-star">*</span></label>
            <input type="text" name="name" value="{{ old('name', $demo->name ?? '') }}"
                   placeholder="Name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

       
        <div>
            <label>Age <span class="required-star">*</span></label>
            <input type="age" name="age" value="{{ old('age', $demo->age ?? '') }}"
                   placeholder="age" class="form-control @error('age') is-invalid @enderror" required>
            @error('age')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>
        <div style="text-align: center; margin-bottom: 15px;">
            <button type="submit" 
                    class="btn-small {{ isset($employee) ? 'btn-primary' : 'btn-success' }}" 
                    style="padding: 10px 20px; font-size: 17px; border-radius: 6px; min-width: 120px;">
                {{ isset($demo) ? 'Update' : 'Add' }}
            </button>
        </div>
    </form>
</div>

@endsection
