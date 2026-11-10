@extends('layouts.marketing')

@section('title', 'Workflow — Inbound Inquiry Triage MVP | HvacLeadPilot')

@section('content')
<section class="wrap section">
    <p class="eyebrow">Sales operations workflow</p>
    <h1>Intake → AI draft → human approval → audit</h1>
    <p class="lead">Matches the USA Top AI Business Automation opportunity for HVAC contractors: classify inquiries and create qualified CRM opportunities.</p>

    <div class="grid grid-2" style="margin-top:1.5rem">
        <div class="card"><h3>1. Intake trigger</h3><p class="muted">Public demo form, Filament Quick Intake, or API-ready payload for website/phone/email.</p></div>
        <div class="card"><h3>2. AI draft / action</h3><p class="muted">Category, priority, score, tags, summary, and consent-aware follow-up draft.</p></div>
        <div class="card"><h3>3. Human approval</h3><p class="muted">Owner/staff Approve → CRM or Reject with reason. No silent auto-send by default.</p></div>
        <div class="card"><h3>4. Audit log</h3><p class="muted">Every classify/approve/reject recorded with actor, IP, and before/after snapshots.</p></div>
    </div>
</section>
@endsection
