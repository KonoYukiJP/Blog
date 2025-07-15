

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP設定
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'konoyuki.jp@gmail.com';       // あなたのGmailアドレス
    $mail->Password   = 'tonpoebpunemuecs';            // アプリパスワード
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // 送信元と宛先
    $mail->setFrom('konoyuki.jp@gmail.com', 'こゆ記録');
    $mail->addAddress('konoyuki.jp@gmail.com');

    // 文字エンコーディング
    $mail->CharSet = 'UTF-8';

    // フォームからのデータを取得
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    $mail->Subject = '【こゆ記録】お問い合わせがありました';
    $mail->Body    = "名前: {$name}\nメール: {$email}\n\n内容:\n{$message}";

    $mail->send();
    header('Location: /contact/thanks.html');
    exit;
} catch (Exception $e) {
    header('Location: /contact/error.html');
    exit;
}