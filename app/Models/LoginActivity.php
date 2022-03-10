<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LoginActivity extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [
        'user_id',
        'user_agent',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
