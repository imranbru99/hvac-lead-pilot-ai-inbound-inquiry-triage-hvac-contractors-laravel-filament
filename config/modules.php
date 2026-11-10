<?php

return [
    /*
    |--------------------------------------------------------------------------
    | HvacLeadPilot Feature Modules
    |--------------------------------------------------------------------------
    | Toggle modules per contractor business needs. Core triage modules
    | default ON; niche / integration modules default OFF.
    */

    'definitions' => [
        'inbound_inquiry_triage' => [
            'name' => 'Inbound Inquiry Triage',
            'description' => 'Capture website, phone, and email inquiries into a unified intake queue.',
            'category' => 'core',
            'enabled' => true,
        ],
        'ai_classification' => [
            'name' => 'AI Classification',
            'description' => 'Classify inquiries by service type, urgency, and qualification score.',
            'category' => 'ai',
            'enabled' => true,
        ],
        'human_approval_workflow' => [
            'name' => 'Human Approval Workflow',
            'description' => 'Require staff approval before converting classified leads to CRM opportunities.',
            'category' => 'core',
            'enabled' => true,
        ],
        'crm_opportunities' => [
            'name' => 'CRM Opportunities',
            'description' => 'Create and manage qualified sales opportunities from approved inquiries.',
            'category' => 'sales',
            'enabled' => true,
        ],
        'service_requests' => [
            'name' => 'Service Requests',
            'description' => 'Convert opportunities into field service requests for HVAC work.',
            'category' => 'operations',
            'enabled' => true,
        ],
        'field_technicians' => [
            'name' => 'Field Technicians',
            'description' => 'Manage licensed HVAC technicians, specialties, and availability.',
            'category' => 'operations',
            'enabled' => true,
        ],
        'job_tickets' => [
            'name' => 'Job Tickets',
            'description' => 'Dispatch job tickets with safety checklists to technicians.',
            'category' => 'operations',
            'enabled' => true,
        ],
        'audit_log' => [
            'name' => 'Audit Log',
            'description' => 'Immutable trail of classify, approve, convert, and dispatch actions.',
            'category' => 'compliance',
            'enabled' => true,
        ],
        'messaging_consent' => [
            'name' => 'Messaging Consent',
            'description' => 'Track SMS/email consent for TCPA-aware follow-ups.',
            'category' => 'compliance',
            'enabled' => true,
        ],
        'follow_up_drafts' => [
            'name' => 'Follow-Up Drafts',
            'description' => 'AI-assisted draft replies awaiting human approval before send.',
            'category' => 'sales',
            'enabled' => true,
        ],
        'slug_engine' => [
            'name' => 'Universal Slug Engine',
            'description' => 'Generate URL-safe slugs for customers and public lead pages (local laravel-universal-slug equivalent).',
            'category' => 'platform',
            'enabled' => true,
        ],
        'customer_portal' => [
            'name' => 'Customer Portal',
            'description' => 'Let homeowners check inquiry status (optional niche module).',
            'category' => 'portal',
            'enabled' => false,
        ],
        'attendance_hub' => [
            'name' => 'Attendance Hub',
            'description' => 'Technician clock-in / attendance machine integration (local laravel-attendance-hub equivalent).',
            'category' => 'hr',
            'enabled' => false,
        ],
        'unicode_pdf_exports' => [
            'name' => 'Unicode PDF Exports',
            'description' => 'Export triage reports and job tickets as PDF (local laravel-unicode-pdf equivalent).',
            'category' => 'documents',
            'enabled' => false,
        ],
        'ai_catalog_scrape' => [
            'name' => 'AI Catalog / Lead Scrape',
            'description' => 'Enrich leads from online catalog sources (local laravel-ai-catalog equivalent).',
            'category' => 'ai',
            'enabled' => false,
        ],
        'ai_hub' => [
            'name' => 'AI Hub Provider Switch',
            'description' => 'Route classification through pluggable AI providers (local laravel-ai-hub equivalent).',
            'category' => 'ai',
            'enabled' => true,
        ],
        'drutogoti_speed' => [
            'name' => 'Drutogoti Speed Layer',
            'description' => 'Caching and queue acceleration helpers (local drutogoti equivalent).',
            'category' => 'platform',
            'enabled' => true,
        ],
        'admin_panel_extras' => [
            'name' => 'Admin Panel Extras',
            'description' => 'Extended Filament admin dashboard widgets (local laravel-admin-panel equivalent).',
            'category' => 'platform',
            'enabled' => true,
        ],
        'integrations_jobber' => [
            'name' => 'Jobber Integration',
            'description' => 'Sync opportunities and jobs to Jobber.',
            'category' => 'integrations',
            'enabled' => false,
        ],
        'integrations_servicetitan' => [
            'name' => 'ServiceTitan Integration',
            'description' => 'Push qualified leads into ServiceTitan.',
            'category' => 'integrations',
            'enabled' => false,
        ],
        'integrations_quickbooks' => [
            'name' => 'QuickBooks Integration',
            'description' => 'Link won opportunities to QuickBooks customers.',
            'category' => 'integrations',
            'enabled' => false,
        ],
        'integrations_google_calendar' => [
            'name' => 'Google Calendar Integration',
            'description' => 'Block technician calendars from job tickets.',
            'category' => 'integrations',
            'enabled' => false,
        ],
        'multi_location' => [
            'name' => 'Multi-Location',
            'description' => 'Route inquiries by branch / service territory.',
            'category' => 'operations',
            'enabled' => false,
        ],
    ],
];
