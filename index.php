<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲーム一覧</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f0f0f5; }
        .container { 
            background-color: #ffffff; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            max-width: 600px; 
            margin: auto;
        }
        h1 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        ul { list-style-type: none; padding: 0; }
        ul li { 
            margin: 15px 0; 
            padding: 10px; 
            border-bottom: 1px solid #eee; 
            font-size: 1.2em;
        }
        ul li a { 
            text-decoration: none; 
            color: #007bff; 
            font-weight: bold; 
            transition: color 0.3s;
        }
        ul li a:hover { color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>ゲーム一覧 (Daftar Game)</h1>
        
        <ul>
            <li>
                <a href="./janken.php">じゃんけんゲーム (Game Janken)</a>
            </li>
            <li>
                <a href="./guess.php">数字当てゲーム (Game Tebak Angka)</a>
            </li>
            
            </ul>
    </div>
</body>
</html>