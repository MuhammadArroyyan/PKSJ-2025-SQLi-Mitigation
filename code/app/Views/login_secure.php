<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Glitch Academy /// SECURE</title>
    <style>
        body {
            background-color: #050505;
            color: #0041ff; /* Nuansa Biru */
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
            border: 2px solid #0041ff;
            padding: 20px;
            box-shadow: 0 0 15px #0041ff;
            position: relative;
            text-align: center;
        }
        h1 {
            text-transform: uppercase;
            text-shadow: 2px 0 red, -2px 0 blue;
            color: #0041ff;
            margin-bottom: 5px;
        }
        p { margin-top: 0; margin-bottom: 20px; font-size: 0.8rem; }

        input {
            width: 100%;
            box-sizing: border-box;
            background: #000;
            border: 1px solid #333;
            border-bottom: 2px solid #0041ff;
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
            background: #0041ff;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            text-transform: uppercase;
        }
        button:hover { background: #fff; color: #000; }
        
        .alert {
            background: #ff0000;
            color: #fff;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
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
            color: #00ff41; /* Berubah jadi Hijau saat dihover */
            text-shadow: 0 0 5px #00ff41;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>/// FORTRESS_MODE</h1>
        <p>[ SECURE_CHANNEL_ESTABLISHED ]</p>
        
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= site_url('secure-login/auth') ?>" method="post">
            <label>USER_ID:</label>
            <input type="text" name="username" autocomplete="off" autofocus>
            
            <label>PASS_KEY:</label>
            <input type="password" name="password">
            
            <button type="submit">AUTHENTICATE</button>
        </form>

        <a href="<?= site_url('login') ?>" class="mode-switch">
            >>> SWITCH TO VULNERABLE MODE (HONEYPOT)
        </a>
    </div>

</body>
</html>