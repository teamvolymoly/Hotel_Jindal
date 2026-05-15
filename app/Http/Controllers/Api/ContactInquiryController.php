<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactInquiryRequest;
use App\Models\ContactInquiry;
use App\Services\Fast2SmsService;
use Illuminate\Http\JsonResponse;

class ContactInquiryController extends Controller
{
    public function store(ContactInquiryRequest $request, Fast2SmsService $fast2SmsService): JsonResponse
    {
        $inquiry = ContactInquiry::create($request->validated());
        $smsSent = $fast2SmsService->sendInquiryConfirmation($inquiry);

        return response()->json([
            'message' => 'Your inquiry has been sent successfully.',
            'data' => [
                'id' => $inquiry->id,
                'sms_sent' => $smsSent,
            ],
        ], 201);
    }
}
