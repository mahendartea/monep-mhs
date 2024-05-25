<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agenda extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'agendas';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notifikasi(): HasOne
    {
        return $this->hasOne(Notification::class);
    }
}
