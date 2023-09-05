<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'position',
        'start',
        'end',
        'description',
        'user_id',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
