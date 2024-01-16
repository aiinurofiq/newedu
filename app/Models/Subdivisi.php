<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subdivisi extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['divisi', 'subdivisi'];

    protected $searchableFields = ['*'];

}
