<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorylearn extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'image', 'description'];

    protected $searchableFields = ['*'];

    public function learnings()
    {
        return $this->hasMany(Learning::class);
    }
}
