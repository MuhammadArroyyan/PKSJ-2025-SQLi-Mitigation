<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Kuisioner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0f1419;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, rgba(99, 102, 241, 0) 70%);
            top: -50px;
            left: -50px;
            border-radius: 50%;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.08) 0%, rgba(79, 70, 229, 0) 70%);
            bottom: -100px;
            right: -100px;
            border-radius: 50%;
        }

        .login-container {
            background: #1a1f2e;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(99, 102, 241, 0.1);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            font-size: 32px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: #a0aec0;
            font-size: 14px;
            margin-top: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #cbd5e0;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #2d3748;
            border-radius: 8px;
            background: #0f1419;
            color: #e4e6eb;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input::placeholder {
            color: #718096;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: #1a1f2e;
        }

        .btn-login {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            letter-spacing: 0.3px;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid;
            font-size: 13px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
            border-left-color: #10b981;
        }

        .alert-danger {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
            border-left-color: #ff6b6b;
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            color: #718096;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Kuisioner</h1>
            <p>Sistem Manajemen Survei Kepuasan</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                ✕ <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <?php if(session('message')): ?>
            <div class="alert alert-success">
                ✓ <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Masukkan email Anda" 
                    required 
                    autofocus
                    value="<?php echo e(old('email')); ?>"
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password Anda" 
                    required
                >
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="login-footer">
            <p>© 2025 Aplikasi Kuisioner. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\2301020002_RizqiAmanullah_UK_final\aplikasi-kuisioner\resources\views/auth/login.blade.php ENDPATH**/ ?>