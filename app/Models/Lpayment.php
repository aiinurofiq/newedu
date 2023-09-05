<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lpayment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'accnumber'];

    protected $searchableFields = ['*'];

    public function lTransactions()
    {
        return $this->hasMany(LTransaction::class);
    }
}
