<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reqknowstat extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['reqknowledge_id', 'status', 'description','user_id','comment','start_date','end_date'];

    protected $searchableFields = ['*'];

    public function reqknowledge()
    {
        return $this->belongsTo(Knowledge::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
