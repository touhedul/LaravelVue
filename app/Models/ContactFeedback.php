<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\ContactFeedback
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $message
 * @property int|null $feedback
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFeedback whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactFeedback extends Model
{
    use HasFactory,LogsActivity;
    protected $fillable = ['name', 'phone', 'email', 'message', 'feedback'];
}
