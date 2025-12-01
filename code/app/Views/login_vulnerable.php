<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Glitch Academy /// LOGIN</title>
    <style>
        body {
            background-color: #050505;
            color: #00ff41;
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            width: 400px;
            border: 2px solid #00ff41;
            padding: 20px;
            box-shadow: 0 0 10px #00ff41;
            position: relative;
            text-align: center;
        }
        /* Efek Glitch Sederhana */
        h1 {
            text-transform: uppercase;
            text-shadow: 2px 0 red, -2px 0 blue;
            animation: glitch 1s infinite alternate;
            margin-bottom: 5px;
        }
        p { margin-top: 0; margin-bottom: 20px; font-size: 0.8rem; }
        
        input {
            width: 100%;
            box-sizing: border-box;
            background: #000;
            border: 1px solid #333;
            border-bottom: 2px solid #00ff41;
            color: #fff;
            padding: 10px;
            margin-bottom: 15px;
            font-family: inherit;
            font-size: 1.1rem;
        }
        input:focus { outline: none; background: #111; }
        
        label { display: block; text-align: left; font-weight: bold; margin-bottom: 5px; }

        button {
            width: 100%;
            padding: 10px;
            background: #00ff41;
            color: #000;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            text-transform: uppercase;
        }
        button:hover { background: #fff; }
        
        .alert {
            background: #ff0000;
            color: #000;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
            border: 1px solid #ff0000;
        }

        /* --- TOMBOL SWITCH --- */
        .mode-switch {
            display: block;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed #333;
            color: #666;
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.3s;
        }
        .mode-switch:hover {
            color: #0041ff; /* Berubah jadi Biru saat dihover */
            text-shadow: 0 0 5px #0041ff;
        }

        @keyframes glitch {
            0% { transform: skew(0deg); }
            20% { transform: skew(-2deg); }
            40% { transform: skew(2deg); }
            100% { transform: skew(0deg); }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>/// SYSTEM_LOGIN</h1>
        <p style="color: #ff0041;">[ VULNERABLE_MODE_ACTIVE ]</p>
        
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= site_url('login/auth') ?>" method="post">
            <label>USER_ID:</label>
            <input type="text" name="username" autocomplete="off" autofocus>
            
            <label>PASS_KEY:</label>
            <input type="password" name="password">
            
            <button type="submit">EXECUTE_LOGIN</button>
        </form>

        <a href="<?= site_url('secure-login') ?>" class="mode-switch">
            >>> SWITCH TO SECURE MODE (FORTRESS)
        </a>
    </div>

</body>
</html>