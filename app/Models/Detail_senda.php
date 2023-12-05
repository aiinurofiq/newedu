<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_senda extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['senda_id', 'answer_id'];

    protected $searchableFields = ['*'];

    // protected $casts = [
    //     'au' => 'array',
    // ];

    public function answers()
    {
        return $this->belongsTo(Answer::class);
    }
    // public function answers()
    // {
    //     return $this->belongsTo(Answer::class);
    // }
    public function sendas()
    {
        return $this->belongsTo(Senda::class);
    }
}
