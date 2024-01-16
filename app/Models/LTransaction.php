<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LTransaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'uuid',
        'user_id',
        'learning_id',
        'lpayment_id',
        'coupon_id',
        'totalamount',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'l_transactions';

    // protected $hidden = ['status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learning()
    {
        return $this->belongsTo(Learning::class);
    }

    public function lpayment()
    {
        return $this->belongsTo(Lpayment::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
