<?php

namespace App\Services;

/**
 * Local equivalent of imrandevbd/laravel-unicode-pdf.
 * Returns printable HTML suitable for browser print-to-PDF when module is enabled.
 */
class UnicodePdfService
{
    public function __construct(protected ModuleManager $modules) {}

    public function renderInquiryReport(array $inquiry): string
    {
        if (! $this->modules->enabled('unicode_pdf_exports')) {
            return 'PDF export module is disabled.';
        }

        $title = e($inquiry['reference'] ?? 'Inquiry');
        $body = e($inquiry['ai_summary'] ?? $inquiry['body'] ?? '');

        return <<<HTML
<!DOCTYPE html>
<html lang="en"><head><meta charset="utf-8"><title>{$title}</title></head>
<body style="font-family: DejaVu Sans, sans-serif; padding: 24px;">
<h1>HvacLeadPilot Triage Report</h1>
<p><strong>Reference:</strong> {$title}</p>
<p>{$body}</p>
</body></html>
HTML;
    }
}
