<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'educations';

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    public function eduhistories()
    {
        return $this->hasMany(Eduhistory::class);
    }
}
