<?php

namespace App\Services;

use App\Models\ContactInquiry;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Fast2SmsService
{
    public function sendInquiryConfirmation(ContactInquiry $inquiry): bool
    {
        $apiKey = (string) config('services.fast2sms.api_key');
        $templateId = (string) config('services.fast2sms.customer_template');

        if ($apiKey === '' || $templateId === '') {
            return false;
        }

        $phone = $this->normalizeIndianPhoneNumber((string) $inquiry->phone);

        if ($phone === null) {
            Log::warning('Contact inquiry SMS skipped because phone number is invalid.', [
                'contact_inquiry_id' => $inquiry->id,
                'phone' => $inquiry->phone,
            ]);

            return false;
        }

        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'authorization' => $apiKey,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])
                ->post('https://www.fast2sms.com/dev/bulkV2', [
                    'route' => config('services.fast2sms.route', 'q'),
                    'sender_id' => config('services.fast2sms.sender_id'),
                    'message' => $templateId,
                    'language' => 'english',
                    'flash' => 0,
                    'numbers' => $phone,
                    'variables_values' => $this->buildTemplateVariables($inquiry),
                ]);

            if (! $response->successful()) {
                Log::warning('Contact inquiry SMS request failed.', [
                    'contact_inquiry_id' => $inquiry->id,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return false;
            }

            return true;
        } catch (\Throwable $throwable) {
            Log::warning('Contact inquiry SMS could not be sent.', [
                'contact_inquiry_id' => $inquiry->id,
                'error' => $throwable->getMessage(),
            ]);

            return false;
        }
    }

    private function buildTemplateVariables(ContactInquiry $inquiry): string
    {
        return implode('|', [
            $inquiry->name,
            optional($inquiry->arrival_date)->format('d-m-Y') ?? $inquiry->arrival_date,
            optional($inquiry->departure_date)->format('d-m-Y') ?? $inquiry->departure_date,
            $inquiry->room_category,
        ]);
    }

    private function normalizeIndianPhoneNumber(string $phone): ?string
    {
        $digitsOnly = preg_replace('/\D+/', '', $phone) ?? '';

        if (str_starts_with($digitsOnly, '91') && strlen($digitsOnly) > 10) {
            $digitsOnly = substr($digitsOnly, -10);
        }

        if (strlen($digitsOnly) !== 10) {
            return null;
        }

        return $digitsOnly;
    }
}
