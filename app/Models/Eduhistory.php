<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eduhistory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'education_id',
        'major',
        'university_id',
        'city_id',
        'year',
        'academic_degree',
        'description',
        'user_id',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
