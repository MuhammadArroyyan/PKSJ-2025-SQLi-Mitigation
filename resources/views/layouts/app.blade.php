<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Aplikasi Kuisioner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0f1419;
            color: #e4e6eb;
            min-height: 100vh;
        }
        
        .navbar {
            background: #1a1f2e;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            border-bottom: 2px solid #6366f1;
        }
        
        .navbar h2 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar-right {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .navbar-right span {
            color: #a0aec0;
            font-size: 14px;
        }
        
        .navbar-right a, .navbar-right button {
            color: #e4e6eb;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }
        
        .navbar-right a:hover, .navbar-right button:hover {
            background: rgba(99, 102, 241, 0.15);
            border-radius: 4px;
            transform: translateY(-2px);
            color: #6366f1;
        }
        
        .container {
            display: flex;
            width: 100%;
            min-height: calc(100vh - 60px);
        }
        
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: #1a1f2e;
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
            overflow-y: auto;
            border-right: 1px solid #2d3748;
        }
        
        .sidebar a {
            display: block;
            color: #cbd5e0;
            padding: 13px 18px;
            text-decoration: none;
            margin: 3px 0;
            transition: all 0.3s ease;
            font-size: 13px;
            font-weight: 500;
        }
        
        .sidebar a:hover {
            background: rgba(99, 102, 241, 0.1);
            transform: translateX(5px);
            color: #6366f1;
        }
        
        .sidebar a.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.25) 0%, rgba(79, 70, 229, 0.15) 100%);
            color: #6366f1;
            border-right: 3px solid #6366f1;
        }
        
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        
        .card {
            background: #1a1f2e;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 25px;
            transition: all 0.3s ease;
            border-top: 4px solid #6366f1;
        }
        
        .card:hover {
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.15);
            transform: translateY(-2px);
        }
        
        .btn {
            display: inline-block;
            padding: 11px 24px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            color: #0f1419;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table thead {
            background: linear-gradient(90deg, #6366f1 0%, #4f46e5 100%);
            color: white;
        }
        
        table th, table td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #2d3748;
        }
        
        table thead th {
            font-weight: 600;
        }
        
        table tbody tr {
            transition: all 0.2s ease;
        }
        
        table tbody tr:hover {
            background: rgba(99, 102, 241, 0.05);
        }
        
        .form-group {
            margin-bottom: 22px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #e4e6eb;
            font-size: 14px;
        }
        
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid #2d3748;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #0f1419;
            color: #e4e6eb;
        }
        
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: #1a1f2e;
        }
        
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }
        
        .alert-success {
            background: rgba(81, 207, 102, 0.15);
            color: #51cf66;
            border-left-color: #51cf66;
        }
        
        .alert-danger {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
            border-left-color: #ff6b6b;
        }
        
        .alert-warning {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
            border-left-color: #ffc107;
        }
        
        .page-header {
            margin-bottom: 35px;
        }
        
        .page-header h1 {
            font-size: 32px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .page-header-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f1419;
        }

        ::-webkit-scrollbar-thumb {
            background: #2d3748;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6366f1;
        }
    </style>
    @yield('extra_styles')
</head>
<body>
    <div class="navbar">
        <h2>Aplikasi Kuisioner</h2>
        <div class="navbar-right">
            <span>{{ Auth::user()->nama_user }}</span>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
    
    <div class="container">
        <div class="sidebar">
            @yield('sidebar')
        </div>
        
        <div class="content">
            @if (session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger">
                    ✕ {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
</body>
</html>
