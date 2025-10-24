<?php

namespace App\Domains\Notification\Services;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    private $messaging;

    public function __construct()
    {
        try {
            if (! config('firebase.messaging.enabled', true)) {
                Log::info('Firebase messaging is disabled');

                return;
            }

            $credentialsPath = config('firebase.credentials');

            if (! file_exists($credentialsPath)) {
                Log::warning('Firebase credentials file not found', ['path' => $credentialsPath]);

                return;
            }

            $factory = (new Factory)
                ->withServiceAccount($credentialsPath);

            $this->messaging = $factory->createMessaging();

            Log::info('Firebase messaging initialized successfully');
        } catch (\Exception $e) {
            Log::error('Firebase initialization failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public function sendNotification(string $token, array $data): bool
    {
        if (! $this->messaging) {
            Log::warning('Firebase messaging not initialized, skipping notification');

            return false;
        }

        if (empty($token)) {
            Log::warning('Empty Firebase token provided');

            return false;
        }

        try {
            $notification = Notification::create($data['title'], $data['message']);

            $message = CloudMessage::withTarget('token', $token)
                ->withNotification($notification)
                ->withData($data['data'] ?? []);

            $result = $this->messaging->send($message);

            Log::info('Firebase notification sent successfully', [
                'token' => substr($token, 0, 10).'...',
                'title' => $data['title'],
                'result' => $result,
            ]);

            return true;
        } catch (\Kreait\Firebase\Exception\Messaging\InvalidToken $e) {
            Log::warning('Invalid Firebase token', [
                'token' => substr($token, 0, 10).'...',
                'error' => $e->getMessage(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('Firebase notification failed', [
                'token' => substr($token, 0, 10).'...',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
    }

    public function sendToMultipleTokens(array $tokens, array $data): array
    {
        $results = [];
        foreach ($tokens as $token) {
            $results[$token] = $this->sendNotification($token, $data);
        }

        return $results;
    }

    public function validateToken(string $token): bool
    {
        if (! $this->messaging) {
            return false;
        }

        try {
            $this->messaging->validateRegistrationTokens([$token]);

            return true;
        } catch (\Exception $e) {
            Log::warning('Firebase token validation failed', [
                'token' => substr($token, 0, 10).'...',
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
