@extends('layouts.marketing')

@section('title', 'Pricing — HvacLeadPilot Pilot Plans')

@section('content')
<section class="wrap section">
    <p class="eyebrow">Pricing hypothesis</p>
    <h1>Pilot $199–$799 / month</h1>
    <p class="lead">Sized for HVAC contractor owners and operations leads running inbound sales ops.</p>
    <div class="grid grid-3" style="margin-top:1.5rem">
        <div class="card">
            <h3>Starter · $199</h3>
            <p class="muted">Inbound triage, AI classify, approval queue, audit log, 2 seats.</p>
        </div>
        <div class="card">
            <h3>Growth · $499</h3>
            <p class="muted">CRM opportunities, service requests, technicians, follow-up drafts, 10 seats.</p>
        </div>
        <div class="card">
            <h3>Ops · $799</h3>
            <p class="muted">Job tickets, integrations toggles, multi-location, priority onboarding.</p>
        </div>
    </div>
</section>
@endsection
