<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['answer', 'istrue', 'question_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'istrue' => 'boolean',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function detail_sendas()
    {
        return $this->hasMany(Detail_senda::class);
    }
}
