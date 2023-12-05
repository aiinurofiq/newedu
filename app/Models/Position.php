<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'name',
        'start',
        'end',
        'fieldofposition_id',
        'division_id',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'status' => 'boolean',
    ];

    public function fieldofposition()
    {
        return $this->belongsTo(Fieldofposition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
