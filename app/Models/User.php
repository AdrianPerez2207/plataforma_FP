<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'dni',
        'name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'address',
        'country',
        'specialty',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public function hasRole($role)
    {
        return strcmp($role, $this->role) === 0;
    }
    public function course()
    {
        return $this->belongsToMany(Registration::class, 'registrations', 'student_id', 'course_id');
    }
    public function evaluation()
    {
        return $this->belongsToMany(Evaluation::class, 'evaluations', 'student_id', 'course_id');
    }
    public function registration(){
        return $this->hasMany(Registration::class, 'student_id');
    }

    public function registrationByCourse($course)
    {
        return $this->registration()->where('course_id', $course->id)->first();
    }
}
