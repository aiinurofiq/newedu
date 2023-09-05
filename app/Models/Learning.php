<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Learning extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'image',
        'description',
        'type',
        'price',
        'user_id',
        'categorylearn_id',
        'level',
        'ispublic',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['uuid'];

    protected $casts = [
        'ispublic' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorylearn()
    {
        return $this->belongsTo(Categorylearn::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function lTransactions()
    {
        return $this->hasMany(LTransaction::class);
    }
}
