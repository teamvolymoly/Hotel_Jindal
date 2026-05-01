<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactInquiryResource;
use App\Models\ContactInquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function index(Request $request): mixed
    {
        $inquiries = ContactInquiry::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim((string) $request->string('q'));
                $query->where(function ($innerQuery) use ($term) {
                    $innerQuery->where('name', 'like', '%' . $term . '%')
                        ->orWhere('email', 'like', '%' . $term . '%')
                        ->orWhere('phone', 'like', '%' . $term . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return ContactInquiryResource::collection($inquiries);
    }

    public function show(ContactInquiry $contactInquiry): JsonResponse
    {
        return response()->json([
            'data' => (new ContactInquiryResource($contactInquiry))->resolve(),
        ]);
    }
}
