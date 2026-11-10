<?php

namespace App\Http\Controllers;

use App\Services\InquiryWorkflowService;
use App\Services\ModuleManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketingController extends Controller
{
    public function home(ModuleManager $modules): View
    {
        return view('marketing.home', [
            'modules' => $modules->all(),
        ]);
    }

    public function features(ModuleManager $modules): View
    {
        return view('marketing.features', [
            'modules' => $modules->all(),
        ]);
    }

    public function modules(ModuleManager $modules): View
    {
        return view('marketing.modules', [
            'modules' => $modules->all(),
        ]);
    }

    public function pricing(): View
    {
        return view('marketing.pricing');
    }

    public function workflow(): View
    {
        return view('marketing.workflow');
    }

    public function demo(): View
    {
        return view('marketing.demo');
    }

    public function contact(): View
    {
        return view('marketing.contact');
    }

    public function submitInquiry(Request $request, InquiryWorkflowService $workflow): RedirectResponse
    {
        $data = $request->validate([
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'service_interest' => ['nullable', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'consent_email' => ['nullable', 'boolean'],
            'consent_sms' => ['nullable', 'boolean'],
        ]);

        $data['source'] = 'website';
        $data['consent_email'] = $request->boolean('consent_email');
        $data['consent_sms'] = $request->boolean('consent_sms');

        $inquiry = $workflow->intake($data);

        return redirect()
            ->route('demo')
            ->with('success', "Inquiry {$inquiry->reference} received and AI-classified as {$inquiry->ai_category} (score {$inquiry->ai_score}).");
    }
}
