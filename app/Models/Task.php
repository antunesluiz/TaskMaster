<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
       'user_id',
       'title',
       'description',
       'status',
    ];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => TaskStatus::class,
    ];
}
