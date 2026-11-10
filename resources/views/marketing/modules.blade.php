@extends('layouts.marketing')

@section('title', 'Modules — Toggle Features On/Off | HvacLeadPilot')

@section('content')
<section class="wrap section">
    <p class="eyebrow">Modular architecture</p>
    <h1>Run only the modules your shop needs</h1>
    <p class="lead">Every business is different. Enable core triage, keep niche integrations off until you need them. Admins can flip switches in Filament → Feature Modules.</p>

    <div class="grid grid-2" style="margin-top:1.5rem">
        @foreach($modules as $module)
            <div class="card">
                <span class="pill {{ $module['enabled'] ? '' : 'off' }}">{{ $module['enabled'] ? 'ENABLED' : 'OFF BY DEFAULT' }}</span>
                <h3 style="margin-top:.55rem">{{ $module['name'] }}</h3>
                <p class="muted">{{ $module['description'] }}</p>
                <p class="muted" style="font-size:.85rem; margin-top:.5rem">Category: {{ $module['category'] }} · key: {{ $module['key'] }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
