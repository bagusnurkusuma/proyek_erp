<?php
//include the Telegram library
include_once("vendor/autoload.php");

use Telegram\Bot\Api;

// Define some constants for later use
define('TELEGRAM_BOT_TOKEN', '6513105680:AAHfLlnWj6V_eipKQ-QihLTMAUgCjrfDdGU');
define('TELEGRAM_BOT_NAME', 'Sedekah Pap Naughty');

// Create a new Telegram API instance
$telegram = new Api(TELEGRAM_BOT_TOKEN);

// Check if a new message has been posted
$updates = $telegram->getUpdates();

// Process each new message
foreach ($updates as $update) {
    // Ignore any messages that don't include a text string
    if (!isset($update->message->text)) {
        continue;
    }

    // Retrieve the user's message and chat ID
    $message = $update->message->text;
    $chat_id = $update->message->chat->id;

    // Log the received message
    echo "Received message: '$message' from chat ID: '$chat_id'\n";

    // Check if the user's message matches the specified command
    if ($message === '/start') {
        // Send a response to the user's message
        $response = "Hello! I'm your " . TELEGRAM_BOT_NAME . " bot. How can I help you today?";
    } else {
        // Send a response to the user's message
        $response = "You said: '$message'. If you need assistance, please use the /start command.";
    }

    // Send the response to the user's chat
    $telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => $response,
    ]);
}
