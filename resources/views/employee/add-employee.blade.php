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
    <h2>{{ isset($employee) ? 'Edit Employee' : 'Add Employee' }}</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST" novalidate>
        @csrf
        @if(isset($employee))
            @method('PUT')
        @endif

        <div>
            <label>Name <span class="required-star">*</span></label>
            <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}"
                   placeholder="Name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

       
        <div>
            <label>Email <span class="required-star">*</span></label>
            <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}"
                   placeholder="Email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Position <span class="required-star">*</span></label>
            <input type="text" name="position" value="{{ old('position', $employee->position ?? '') }}"
                   placeholder="Position" class="form-control @error('position') is-invalid @enderror" required>
            @error('position')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Salary <span class="required-star">*</span></label>
            <input type="number" name="salary" value="{{ old('salary', $employee->salary ?? '') }}"
                   placeholder="Salary" class="form-control @error('salary') is-invalid @enderror" required min="0">
            @error('salary')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>
        <div style="text-align: center; margin-bottom: 15px;">
            <button type="submit" 
                    class="btn-small {{ isset($employee) ? 'btn-primary' : 'btn-success' }}" 
                    style="padding: 10px 20px; font-size: 17px; border-radius: 6px; min-width: 120px;">
                {{ isset($employee) ? 'Update' : 'Add' }}
            </button>
        </div>
    </form>
</div>

@endsection
