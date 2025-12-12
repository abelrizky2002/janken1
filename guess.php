<?php
session_start(); // Wajib untuk menyimpan status game

// ==========================================================
// 1. Inisialisasi Game State (Menggunakan Session)
// ==========================================================

// Jika sesi belum dimulai atau tombol reset ditekan, inisialisasi game baru
if (!isset($_SESSION['secret_number']) || isset($_POST['reset'])) {
    // Angka rahasia antara 1 dan 100
    $_SESSION['secret_number'] = rand(1, 100);
    $_SESSION['guesses'] = []; // Menyimpan riwayat tebakan
    $_SESSION['message'] = "1から100までの数字を当ててみよう！";
    $_SESSION['attempts'] = 0;
}

$message = $_SESSION['message'];
$attempts = $_SESSION['attempts'];
$history = $_SESSION['guesses'];

// ==========================================================
// 2. Logika Game (Memproses Tebakan)
// ==========================================================

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guess'])) {
    // Pastikan game belum selesai dan input adalah angka valid
    if ($message !== "正解です！リセットしてね！" && is_numeric($_POST['guess'])) {
        
        $guess = intval($_POST['guess']);
        $_SESSION['attempts']++;

        // Simpan tebakan ke riwayat
        $_SESSION['guesses'][] = $guess;

        if ($guess == $_SESSION['secret_number']) {
            $_SESSION['message'] = "正解です！リセットしてね！";
        } elseif ($guess < $_SESSION['secret_number']) {
            $_SESSION['message'] = "もっと大きな数字だよ (Terlalu rendah)";
        } else {
            $_SESSION['message'] = "もっと小さな数字だよ (Terlalu tinggi)";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>数字当てゲーム</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color: #e6e6fa; }
        .container { background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); display: inline-block; max-width: 500px; }
        .message { padding: 15px; border-radius: 5px; font-size: 1.4em; font-weight: bold; margin-bottom: 20px; background-color: #d1ecf1; color: #0c5460; }
        .success { background-color: #d4edda; color: #155724; }
        .form-group input[type="number"], .form-group button { padding: 10px; margin: 5px; border-radius: 5px; }
        .form-group button { background-color: #28a745; color: white; border: none; cursor: pointer; }
        .history { text-align: left; margin-top: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>数字当てゲーム (Tebak Angka)</h1>

        <div class="message <?= ($_SESSION['message'] == '正解です！リセットしてね！' ? 'success' : '') ?>">
            <?= htmlspecialchars($message) ?>
        </div>
        
        <p><strong>現在の回数 (Percobaan ke-):</strong> <?= $attempts ?></p>

        <form method="POST" action="guess.php" class="form-group">
            <input type="number" name="guess" min="1" max="100" placeholder="数字を入力 (1-100)" required>
            <button type="submit">予想する (Tebak)</button>
        </form>

        <form method="POST" action="guess.php" style="margin-top: 10px;">
            <button type="submit" name="reset">ゲームをリセット (Reset Game)</button>
        </form>

        <?php if (!empty($history)): ?>
        <div class="history">
            <h3>過去の予想 (Riwayat Tebakan):</h3>
            <p><?= implode(', ', $history) ?></p>
        </div>
        <?php endif; ?>

    </div>
</body>
</html>