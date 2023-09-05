<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['au', 'question_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'au' => 'array',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
