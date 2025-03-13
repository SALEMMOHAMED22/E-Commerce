<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'is_active',
        'country_id',
        'governorate_id',
        'city_id',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getStatusTranslated(){
        return $this->is_active == 1 ? __('dashboard.active') : __('dashboard.inactive');
    }

    // Relationship 
    public function country(){
        return $this->belongsTo(Country::class , 'country_id');
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class , 'governorate_id');
    }
    public function city(){
        return $this->belongsTo(City::class , 'city_id');
    }

    public function orders(){
        return $this->hasMany(Order::class , 'user_id');
    }

    public function getCreatedAtAttribute($value){
        return date('d/m/y H:i a' , strtotime($value) );
    }
    public function getEmailVerifiedAtAttribute($value){
        return date('d/m/y H:i a' , strtotime($value) );
    }






}
