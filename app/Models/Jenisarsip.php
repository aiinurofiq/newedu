<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenisarsip extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['jenis', 'subjenis', 'subsubjenis'];

    protected $searchableFields = ['*'];

    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }
}
