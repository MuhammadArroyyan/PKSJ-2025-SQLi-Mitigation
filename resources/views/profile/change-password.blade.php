@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
    <div class="page-header">
        <h1>Ubah Password</h1>
    </div>
    
    <div class="card" style="max-width: 500px;">
        @if ($errors->any())
            <div style="background: #fee; color: #c33; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div style="background: #efe; color: #3c3; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update-password') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" required>
                @error('current_password')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-success">Ubah Password</button>
            <a href="javascript:history.back()" class="btn">Kembali</a>
        </form>
    </div>

    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #5568d3;
        }

        .btn-success {
            background: #27ae60;
        }

        .btn-success:hover {
            background: #229954;
        }
    </style>
@endsection
