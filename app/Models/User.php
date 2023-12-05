<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;

    protected $fillable = [
        'uuid',
        'nik',
        'kopeg',
        'name',
        'city_id',
        'birth',
        'gender_id',
        'religion_id',
        'address',
        'phone',
        'email',
        'npwp',
        'tribe_id',
        'bloodtype_id',
        'marital_id',
        'password',
        'profile_photo_path',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'uuid',
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'birth' => 'date',
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function bloodtype()
    {
        return $this->belongsTo(Bloodtype::class);
    }

    public function marital()
    {
        return $this->belongsTo(Marital::class);
    }

    public function tribe()
    {
        return $this->belongsTo(Tribe::class);
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function eduhistories()
    {
        return $this->hasMany(Eduhistory::class);
    }

    public function wifhuses()
    {
        return $this->hasMany(Wifhus::class);
    }

    public function kids()
    {
        return $this->hasMany(Kid::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    public function valvisions()
    {
        return $this->hasMany(Valvision::class);
    }

    public function knowledges()
    {
        return $this->hasMany(Knowledge::class);
    }

    public function reqknowledges()
    {
        return $this->hasMany(Reqknowledge::class);
    }

    public function learnings()
    {
        return $this->hasMany(Learning::class);
    }
    public function sendas()
    {
        return $this->hasMany(Learning::class);
    }

    public function lTransactions()
    {
        return $this->hasMany(LTransaction::class);
    }

    public function bumnsectors()
    {
        return $this->belongsToMany(Bumnsector::class);
    }

    public function bumnclasses()
    {
        return $this->belongsToMany(Bumnclass::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
    public function isAdminUnit(): bool
    {
        return $this->hasRole('admin-unit');
    }
}
