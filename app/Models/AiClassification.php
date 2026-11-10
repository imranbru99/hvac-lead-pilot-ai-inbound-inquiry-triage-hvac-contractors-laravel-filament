<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiClassification extends Model
{
    protected $fillable = [
        'inquiry_id',
        'provider',
        'model',
        'prompt',
        'response',
        'confidence',
    ];

    protected function casts(): array
    {
        return [
            'response' => 'array',
        ];
    }

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }
}
