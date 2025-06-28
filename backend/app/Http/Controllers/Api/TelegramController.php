<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BotCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    /**
     * Handle incoming webhook from Telegram
     */
    public function webhook(Request $request)
    {
        $message = $request->input('message');

        if (!$message || !isset($message['text'])) {
            return response()->json(['status' => 'ignored']);
        }

        $text = trim($message['text']);
        $chatId = $message['chat']['id'];

        // Cek command berdasarkan input user, bisa berupa command atau label
        $command = BotCommand::where(function ($query) use ($text) {
            $query->where('command', $text)
                ->orWhere('label', $text);
        })
            ->where('is_active', true)
            ->first();

        if ($command) {
            $showKeyboard = $command->command === '/start';
            $this->sendTelegramMessage($chatId, $command->response, $showKeyboard);
        } else {
            $this->sendTelegramMessage($chatId, "Maaf, perintah tidak dikenal. Ketik *Menu* untuk melihat pilihan.");
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Send a message to Telegram chat
     */
    private function sendTelegramMessage($chatId, $text, $withKeyboard = false)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $payload = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown',
        ];

        if ($withKeyboard) {
            // Ambil semua perintah aktif untuk ditampilkan sebagai tombol
            $commands = BotCommand::where('is_active', true)->get(['label']);

            // Susun tombol 1 per baris (satu kolom)
            $keyboard = [];
            foreach ($commands as $cmd) {
                $keyboard[] = [['text' => $cmd->label]];
            }

            $payload['reply_markup'] = json_encode([
                'keyboard' => $keyboard,
                'resize_keyboard' => true,
                'one_time_keyboard' => false,
            ]);
        }

        Http::post($url, $payload);
    }
}
