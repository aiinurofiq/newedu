<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['province', 'name'];

    protected $searchableFields = ['*'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function eduhistories()
    {
        return $this->hasMany(Eduhistory::class);
    }

    public function wifhuses()
    {
        return $this->hasMany(Wifhus::class);
    }

    public function kids()
    {
        return $this->hasMany(Kid::class);
    }
}
