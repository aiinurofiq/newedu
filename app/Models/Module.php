<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'file',
        'videoembed',
        'text',
        'description',
        'duration',
        'section_id',
    ];

    protected $searchableFields = ['*'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
