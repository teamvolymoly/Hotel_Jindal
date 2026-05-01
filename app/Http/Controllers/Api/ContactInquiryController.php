<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactInquiryRequest;
use App\Models\ContactInquiry;
use Illuminate\Http\JsonResponse;

class ContactInquiryController extends Controller
{
    public function store(ContactInquiryRequest $request): JsonResponse
    {
        $inquiry = ContactInquiry::create($request->validated());

        return response()->json([
            'message' => 'Your inquiry has been sent successfully.',
            'data' => [
                'id' => $inquiry->id,
            ],
        ], 201);
    }
}
