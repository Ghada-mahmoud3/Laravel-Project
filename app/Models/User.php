<?php

   namespace App\Models;

   use Illuminate\Contracts\Auth\MustVerifyEmail;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Foundation\Auth\User as Authenticatable;
   use Illuminate\Notifications\Notifiable;
   use Laravel\Sanctum\HasApiTokens;

   class User extends Authenticatable
   {
       use HasApiTokens, HasFactory, Notifiable;

       protected $fillable = [
           'name',
           'email',
           'password',
           'role',
       ];

       protected $hidden = [
           'password',
           'remember_token',
       ];

       protected $casts = [
           'email_verified_at' => 'datetime',
           'password' => 'hashed',
       ];

       public function isAdmin(): bool
       {
           return $this->role === 'admin';
       }

       public function isEmployer(): bool
       {
           return $this->role === 'employer';
       }

       public function isCandidate(): bool
       {
           return $this->role === 'candidate';
       }

       public function employerProfile()
       {
           return $this->hasOne(EmployerProfile::class);
       }

       public function candidateProfile()
       {
           return $this->hasOne(CandidateProfile::class);
       }
   }