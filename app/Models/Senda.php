<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Senda extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'timeout', 'quiz_id','status'];

    protected $searchableFields = ['*'];

    // protected $casts = [
    //     'au' => 'array',
    // ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    // public function answers()
    // {
    //     return $this->belongsTo(Answer::class);
    // }
    public function quizs()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function detail_sendas()
    {
        return $this->hasMany(Detail_senda::class);
    }
}
