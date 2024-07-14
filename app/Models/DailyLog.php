<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyLog extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'user_id',
        'activity',
        'status',
        'notes',
        'log_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
