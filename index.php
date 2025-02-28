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
    
    <div class="hacker-name">HARSH</div>
    
    <div class="message">
        ATTENTION MANAGEMENT:<br><br>
        Your system has been breached due to unethical business practices.<br>
        Dedicated developers from India have been denied their rightful compensation.<br>
        We are not frauds. We are skilled professionals demanding justice.<br><br>
        DEMANDS:<br>
        - Immediate release of current month's salary<br>
        - Advanced payment for the upcoming month<br><br>
        COMPLY WITH THESE TERMS FOR SYSTEM RESTORATION
    </div>
    
    <div class="countdown">
        Time Remaining: 02:00:00<br>
        <script>
            var timeLeft = 7200;
            setInterval(function() {
                timeLeft--;
                var hours = Math.floor(timeLeft / 3600);
                var minutes = Math.floor((timeLeft % 3600) / 60);
                var seconds = timeLeft % 60;
                document.querySelector('.countdown').innerHTML = 
                    'Time Remaining: ' + 
                    String(hours).padStart(2, '0') + ':' +
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');
            }, 1000);
        </script>
    </div>
</body>
</html>