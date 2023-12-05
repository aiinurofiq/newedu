<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'file',
        'kodeklasifikasi',
        'jwp_aktif',
        'jwp_inaktif',
        'ha_internal',
        'ha_eksternal',
        'keterangan_id',
        'jenisarsip_id',
        'kkeamanan_id',
        'dasarpertimbangan_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function keterangan()
    {
        return $this->belongsTo(Keterangan::class);
    }

    public function jenisarsip()
    {
        return $this->belongsTo(Jenisarsip::class);
    }

    public function kkeamanan()
    {
        return $this->belongsTo(Kkeamanan::class);
    }

    public function dasarpertimbangan()
    {
        return $this->belongsTo(Dasarpertimbangan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
