@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 50px auto; text-align: center; font-family: Arial, sans-serif;">
    
    <div style="padding: 30px; background-color: #ffffffff; border-radius: 10px; box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1); margin-bottom: 20px;">
        <h2 style="margin-bottom: 10px; color: #333;"> </h2>
        <p style="font-size: 20px; font-weight: bold;">Total Employees: {{ $TotalEmployees }}</p>
    </div>

    <a href="{{ route('list-employee') }}" 
       style="display: inline-block; padding: 12px 25px; background-color: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.3s;">
        Go to Employee List
    </a>

</div>
@endsection
