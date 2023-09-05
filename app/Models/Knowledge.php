<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Knowledge extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'knowledges';

    protected $fillable = [
        'uuid',
        'title',
        'writer',
        'abstract',
        'status',
        'photo',
        'user_id',
        'topic_id',
        'category_id',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['uuid'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function exsums()
    {
        return $this->hasMany(Exsum::class);
    }

    public function explanations()
    {
        return $this->hasMany(Explanation::class);
    }

    public function jurnals()
    {
        return $this->hasMany(Jurnal::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
