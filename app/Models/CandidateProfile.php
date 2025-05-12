<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;

   class CandidateProfile extends Model
   {
       use HasFactory;

       protected $fillable = [
           'user_id',
           'resume',
           'skills',
       ];

       public function user()
       {
           return $this->belongsTo(User::class);
       }
   }