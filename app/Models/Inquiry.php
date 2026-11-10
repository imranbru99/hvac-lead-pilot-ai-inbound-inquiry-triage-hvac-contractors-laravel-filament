<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Inquiry extends Model
{
    protected $fillable = [
        'reference',
        'source',
        'contact_name',
        'contact_email',
        'contact_phone',
        'subject',
        'body',
        'service_interest',
        'ai_category',
        'ai_priority',
        'ai_score',
        'ai_summary',
        'ai_tags',
        'status',
        'assigned_to',
        'customer_id',
        'consent_sms',
        'consent_email',
        'raw_payload',
        'classified_at',
        'approved_at',
        'approved_by',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'ai_tags' => 'array',
            'raw_payload' => 'array',
            'consent_sms' => 'boolean',
            'consent_email' => 'boolean',
            'classified_at' => 'datetime',
            'approved_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Inquiry $inquiry): void {
            if (blank($inquiry->reference)) {
                $inquiry->reference = 'INQ-'.strtoupper(Str::random(8));
            }
        });
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function opportunity(): HasOne
    {
        return $this->hasOne(Opportunity::class);
    }

    public function classifications(): HasMany
    {
        return $this->hasMany(AiClassification::class);
    }

    public function followUpDrafts(): HasMany
    {
        return $this->hasMany(FollowUpDraft::class);
    }
}
