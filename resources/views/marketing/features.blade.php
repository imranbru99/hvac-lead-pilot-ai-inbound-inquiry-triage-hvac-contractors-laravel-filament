@extends('layouts.marketing')

@section('title', 'Features — HvacLeadPilot AI Triage CRM')

@section('content')
<section class="wrap section">
    <p class="eyebrow">Product capabilities</p>
    <h1>Everything you need to triage HVAC leads</h1>
    <p class="lead">From first inquiry to dispatched job ticket — with compliance-aware messaging and modular integrations.</p>

    <div class="grid grid-2" style="margin-top:1.5rem">
        <div class="card"><h3>Inbound Inquiry Triage</h3><p class="muted">Unified queue for website, phone, email, SMS, and referral leads with reference IDs.</p></div>
        <div class="card"><h3>AI Classification Hub</h3><p class="muted">Detect no-cool emergencies, furnace failures, heat pumps, AC installs, ductwork, refrigerant, IAQ, and thermostats.</p></div>
        <div class="card"><h3>Human Approval Workflow</h3><p class="muted">Staff/owner gate before CRM conversion — MVP: intake → draft → approve → audit.</p></div>
        <div class="card"><h3>CRM Opportunities</h3><p class="muted">Qualified pipeline with value estimates, probability, stages, and owners.</p></div>
        <div class="card"><h3>Service Requests</h3><p class="muted">Turn wins into field service requests with priority and scheduling.</p></div>
        <div class="card"><h3>Technicians & Job Tickets</h3><p class="muted">License tracking, specialties, dispatch windows, and safety checklists.</p></div>
        <div class="card"><h3>Consent-aware follow-ups</h3><p class="muted">Email/SMS consent flags + AI draft replies awaiting approval.</p></div>
        <div class="card"><h3>Audit & compliance</h3><p class="muted">Immutable logs for classify/approve/reject — MED risk messaging & licensing awareness.</p></div>
        <div class="card"><h3>Multi-role users</h3><p class="muted">Admin, owner, staff, technician, customer demo roles with Filament access control.</p></div>
        <div class="card"><h3>Integration-ready</h3><p class="muted">Toggle modules for Jobber, ServiceTitan, QuickBooks, and Google Calendar.</p></div>
    </div>
</section>
@endsection
