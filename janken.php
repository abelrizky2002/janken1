<?php
// ==========================================================
// 1. Logic Game (PHP)
// ==========================================================

// Inisialisasi variabel hasil
$result_message = "下のボタンから手を選んでね！";
$player_choice = null;
$computer_choice = null;
$choices = [1 => "✊ グー (Batu)", 2 => "✌️ チョキ (Gunting)", 3 => "✋ パー (Kertas)"];

// Cek apakah ada input (request) dari form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['choice'])) {
    
    // 1. Ambil pilihan pemain dari form (choice: 1, 2, atau 3)
    $player_choice = intval($_POST['choice']);
    
    // 2. Tentukan pilihan Komputer secara acak (1, 2, atau 3)
    $computer_choice = array_rand($choices);
    
    // 3. Tentukan Pemenang
    // Logika Janken: (Pilihan Pemain - Pilihan Komputer + 3) % 3
    // Hasil 0 = Seri (Draw)
    // Hasil 1 = Menang Pemain (Win)
    // Hasil 2 = Kalah Pemain (Lose)
    $difference = ($player_choice - $computer_choice + 3) % 3;

    if ($difference == 0) {
        $result_message = "あいこ (Seri) だよ！";
    } elseif ($difference == 1) {
        $result_message = "あなたの勝ち (Anda Menang) 🎉";
    } else { // $difference == 2
        $result_message = "コンピューターの勝ち (Komputer Menang) 😥";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPじゃんけんゲーム</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color: #f4f4f9; }
        .container { background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: inline-block; }
        .result-box { margin-bottom: 20px; padding: 15px; border-radius: 5px; font-size: 1.2em; border: 2px solid #333; }
        .choice-box { margin-top: 20px; font-size: 1.1em; }
        .choice-box p { margin: 5px 0; }
        .button-group button { 
            padding: 15px 25px; 
            margin: 10px; 
            font-size: 1.5em; 
            cursor: pointer; 
            border: none; 
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        .button-group button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>人間 vs コンピュータ じゃんけんゲーム</h1>

        <div class="result-box">
            <h2>結果 (Result):</h2>
            <p style="font-size: 1.5em; font-weight: bold; color: #d9534f;"><?= htmlspecialchars($result_message) ?></p>
        </div>

        <?php if ($player_choice !== null): ?>
        <div class="choice-box">
            <p><strong>あなたの手 (Pilihan Anda):</strong> <?= $choices[$player_choice] ?></p>
            <p><strong>コンピューターの手 (Pilihan Komputer):</strong> <?= $choices[$computer_choice] ?></p>
        </div>
        <?php endif; ?>

        <hr>

        <form method="POST" action="janken.php">
            <div class="button-group">
                <button type="submit" name="choice" value="1">✊ グー (Batu)</button>
                <button type="submit" name="choice" value="2">✌️ チョキ (Gunting)</button>
                <button type="submit" name="choice" value="3">✋ パー (Kertas)</button>
            </div>
        </form>
    </div>
</body>
</html>
