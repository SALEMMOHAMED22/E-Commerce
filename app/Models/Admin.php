<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
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
        'role_id',
        'status',
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

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function getStatusAttribute($value){
        return $value == 1 ? 'Active' : 'Inactve';
    }

    // public function hasAccess($config_permission){
    //     $role = $this->role;
        
    //     if(!$role){
    //         return false;
    //     }

    //     foreach($role->permission as $permission){
    //         if($config_permission == $permission){
    //             return true;
    //         }
    //     }
    // }
    public function hasAccess($config_permission)
{
    $role = $this->role;

    if (!$role) {
        Log::info("User has no role assigned");
        return false; // User has no role
    }

    Log::info("User's role: {$role->role['en']}");

    if (in_array($config_permission, $role->permission)) {
        Log::info("Permission {$config_permission} granted");
        return true;
    }

    Log::info("Permission {$config_permission} denied");
    return false;
}

}
