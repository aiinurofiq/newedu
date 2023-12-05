<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'image',
        'description',
        'learning_id',
        'hquiz',
    ];

    protected $searchableFields = ['*'];

    public function learning()
    {
        return $this->belongsTo(Learning::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
