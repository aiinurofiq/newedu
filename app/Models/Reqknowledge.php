<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reqknowledge extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'description',
        'explanation_id',
        'exsum_id',
        'report_id',
        'jurnal_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function explanation()
    {
        return $this->belongsTo(Explanation::class);
    }

    public function exsum()
    {
        return $this->belongsTo(Exsum::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reqknowstats()
    {
        return $this->hasMany(Reqknowstat::class);
    }
}
