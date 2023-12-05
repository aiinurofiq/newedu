<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'section_id',
        'category',
        'passinggrade',
        'description',
        'sumvalue',
    ];

    protected $searchableFields = ['*'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function sendas()
    {
        return $this->hasMany(Senda::class);
    }
}
