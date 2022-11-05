<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'countForPage',
        'image',
        'description',
        'gender_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        return $this->image();
    }

    public function image()
    {
        $avatar = $this->gender_id == 2 ? 'avatar-woman.png' : 'avatar-man.png';
        return $this->image ?? asset('images/' . $avatar);
    }

    public function adminlte_desc()
    {
        return $this->desc();
    }

    public function desc()
    {
        return $this->description ?? 'Olá, eu sou novo aqui!';
    }

    public function adminlte_profile_url()
    {
        return 'admin/profile';
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function getGender()
    {
        return $this->gender()->get()->first()->gender;
    }
}
