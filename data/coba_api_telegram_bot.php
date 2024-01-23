<?php
$bot_token = '6513105680:AAHfLlnWj6V_eipKQ-QihLTMAUgCjrfDdGU';
$chat_id = '843202807';
$msg = "Inpone masehh";


$token = '6513105680:AAHfLlnWj6V_eipKQ-QihLTMAUgCjrfDdGU';
$apiUrl = "https://api.telegram.org/bot$token";
function sendMessage($chatId, $text)
{
    include '../asset_default/koneksi.php';
    $query = "SELECT accounting.testing as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    var_dump($row);
    global $apiUrl;
    $url = $apiUrl . '/sendMessage';
    $params = [
        'chat_id' => $chatId,
        'text' => $text,
    ];
    file_get_contents($url . '?' . http_build_query($params));
}

$update = json_decode(file_get_contents('php://input'), true);

if (isset($update['message'])) {

    $chatId = $update['message']['chat']['id'];
    $messageText = $update['message']['text'];
    sendMessage($chatId, "You said: $messageText");
}

sendMessage($chat_id, $msg);
