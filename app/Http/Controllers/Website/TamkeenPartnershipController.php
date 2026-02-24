<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\TamkeenPartnershipRequestNotification;
use App\Models\TamkeenPartnership;
use App\Models\TamkeenPartnershipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TamkeenPartnershipController extends Controller
{
    public function filter(Request $request)
    {
        $query = TamkeenPartnership::orderBy('sort_order')->orderByDesc('created_at');
        
        if ($request->filled('sector')) {
            $query->where('sector', $request->sector);
        }

        $partnerships = $query->get();

        $html = view('website.partials.tamkeen-partners-list', compact('partnerships'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $partnerships->count(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:1000'],
        ], [
            'company_name.required' => 'يرجى إدخال اسم الشركة.',
            'contact_name.required' => 'يرجى إدخال اسم المسؤول.',
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'phone.required' => 'يرجى إدخال رقم التواصل.',
        ]);

        // Save to database
        $requestRecord = TamkeenPartnershipRequest::create([
            'company_name' => $validated['company_name'],
            'contact_name' => $validated['contact_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'] ?? null,
        ]);

        // Send email notification
        try {
            $siteSettings = \App\Models\SiteSetting::get();
            $recipientEmail = $siteSettings->contact_email ?: 'eltrukk@gmail.com';
            
            // Check if mail is configured
            $mailDriver = config('mail.default');
            if ($mailDriver === 'log') {
                \Log::warning('Email not sent: MAIL_MAILER is set to "log". Please configure SMTP in .env file. Email would be sent to: ' . $recipientEmail);
                \Log::info('Tamkeen Partnership Request Details:', $validated);
            } else {
                Mail::to($recipientEmail)->send(new TamkeenPartnershipRequestNotification($validated));
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send tamkeen partnership request email: ' . $e->getMessage());
            \Log::error('Email details:', [
                'recipient' => $recipientEmail ?? 'N/A',
                'error' => $e->getTraceAsString(),
            ]);
            // Don't fail the request if email fails - data is already saved
        }

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال طلب الشراكة بنجاح. شكراً لاهتمامك!',
        ]);
    }
}
