<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['file', 'knowledge_id'];

    protected $searchableFields = ['*'];

    public function knowledge()
    {
        return $this->belongsTo(Knowledge::class);
    }

    public function reqknowledges()
    {
        return $this->hasMany(Reqknowledge::class);
    }
}
