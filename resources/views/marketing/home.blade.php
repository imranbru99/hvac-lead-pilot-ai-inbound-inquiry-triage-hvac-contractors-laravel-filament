@extends('layouts.marketing')

@section('title', 'HvacLeadPilot — AI Inbound Inquiry Triage CRM for HVAC contractors')
@section('meta_description', 'Classify website, phone, and email inquiries into qualified CRM opportunities. AI triage, human approval, service requests, technicians, and job tickets for HVAC contractors.')

@section('content')
<section class="wrap hero">
    <div>
        <p class="eyebrow">HVAC contractors · Sales Operations</p>
        <h1>HvacLeadPilot</h1>
        <p class="lead">Classify website, phone, and email inquiries into qualified CRM opportunities — then operate on service requests, field technicians, and job tickets with AI assist and human approval.</p>
        <div class="cta-row">
            <a class="btn btn-accent" href="{{ route('demo') }}">Try live intake</a>
            <a class="btn btn-ghost" href="{{ url('/admin') }}">Open Filament admin</a>
            <a class="btn btn-ghost" href="{{ route('features') }}">Explore all features</a>
        </div>
    </div>
    <div class="panel">
        <small>Live triage snapshot</small>
        <div class="score">99</div>
        <p style="margin:0 0 1rem; opacity:.9">Opportunity score · Inbound Inquiry Triage MVP</p>
        <div class="grid" style="gap:.55rem">
            <div>1) Intake trigger → website / phone / email</div>
            <div>2) AI draft classification + follow-up</div>
            <div>3) Human approval gate</div>
            <div>4) CRM opportunity + audit log</div>
        </div>
    </div>
</section>

<section class="wrap section">
    <h2>Built for HVAC contractor ops leads</h2>
    <p class="muted" style="max-width:46rem">Stop losing after-hours form fills and voicemail leads. HvacLeadPilot centralizes inbound demand, scores urgency (no cool emergencies, furnace failures, heat pump installs), and routes only approved work into your CRM and field stack.</p>
    <div class="grid grid-3" style="margin-top:1.25rem">
        <div class="card">
            <h3>Multi-channel intake</h3>
            <p class="muted">Website forms, phone notes, email forwards — one triage queue with consent flags.</p>
        </div>
        <div class="card">
            <h3>AI classify & score</h3>
            <p class="muted">Category, priority, qualification score, tags, and draft follow-ups in seconds.</p>
        </div>
        <div class="card">
            <h3>Modular SaaS</h3>
            <p class="muted">Toggle CRM, technicians, Jobber/ServiceTitan hooks, attendance, and PDF exports per shop.</p>
        </div>
    </div>
</section>

<section class="wrap section">
    <h2>Core modules enabled for demo</h2>
    <div class="grid grid-2">
        @foreach(collect($modules)->where('enabled', true)->take(8) as $module)
            <div class="card">
                <span class="pill">ON</span>
                <h3 style="margin-top:.55rem">{{ $module['name'] }}</h3>
                <p class="muted">{{ $module['description'] }}</p>
            </div>
        @endforeach
    </div>
    <div class="cta-row">
        <a class="btn btn-primary" href="{{ route('modules') }}">View every module (on & off)</a>
    </div>
</section>
@endsection
