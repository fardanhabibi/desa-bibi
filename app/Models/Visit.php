<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    /** @use HasFactory<\Database\Factories\VisitFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'page',
        'ip_address',
        'user_agent',
        'visited_at',
        'last_activity_at',
    ];

    protected function casts(): array
    {
        return [
            'visited_at' => 'datetime',
            'last_activity_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
