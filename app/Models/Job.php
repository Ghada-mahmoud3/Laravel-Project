<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Job extends Model
{
    use HasFactory;
    // use Searchable;

    protected $table = 'jobs_listing';
    protected $fillable = [
        'title',
        'description',
        'location',
        'category',
        'experience_level',
        'salary_min',
        'salary_max',
        'work_type',
        'application_deadline',
        'employer_id',
        'logo_path',
        'is_approved',
    ];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'category' => $this->category,
            'experience_level' => $this->experience_level,
        ];
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
