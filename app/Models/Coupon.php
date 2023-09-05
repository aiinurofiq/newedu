<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'cutprice',
        'typecut',
        'maxcut',
        'maxusage',
        'expireddate',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'expireddate' => 'date',
    ];

    public function lTransactions()
    {
        return $this->hasMany(LTransaction::class);
    }
}
