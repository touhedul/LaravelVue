<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class VisitorInfo extends Model
{
    use HasFactory,LogsActivity;
    protected $fillable=['user_agent','ip_address','count','status'];
}
