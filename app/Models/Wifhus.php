<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wifhus extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'city_id',
        'birth',
        'gender_id',
        'as',
        'job',
        'description',
        'maritaldate',
        'user_id',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'birth' => 'date',
        'maritaldate' => 'date',
        'status' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
