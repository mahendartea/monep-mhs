<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monev extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }
}
