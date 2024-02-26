<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'image',
        'salary',
        'department_id',
        'is_manager',
        'manager_id',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute()
    {
        if (!$this->attributes['image']) {
            return asset('no_image.png');
        }

        return asset('/storage/' . $this->attributes['image']);
    }

    public function isManager(){
        if($this->is_manager == 1){
            return true;
        }
        return false;
    }

    public function children(){
        return $this->hasMany(User::class, 'manager_id');
    }

    public function parent(){
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
