<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[\d\s\-\+\(\)]{10,20}$/',
        ], [
            'phone.regex' => 'Некорректный формат телефона'
        ]);

        try {
            $botToken = config('services.telegram.bot_token');
            $chatId = config('services.telegram.chat_id');

            $message = "✨ *НОВАЯ ЗАЯВКА* ✨\n\n"
                . "▫️ *Имя:* {$validated['name']}\n"
                . "▫️ *Телефон:* `{$validated['phone']}`\n"
                . "▫️ *Дата:* " . now()->format('d.m.Y H:i') . "\n\n"
                . "🟢 *Статус:* Ожидает обработки";

            $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown'
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Спасибо! Мы свяжемся с вами в ближайшее время.'
                ]);
            }

            throw new \Exception('Ошибка Telegram API: ' . $response->body());

        } catch (\Exception $e) {
            Log::error('Telegram send error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка отправки. Пожалуйста, попробуйте позже.'
            ], 500);
        }
    }
}
