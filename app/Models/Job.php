<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'location' , 'type' , 'user_id' , 'tags'];

    public function user()
    {
        return $this->belongsTo(User::class);    
    }

    public function applications()
    {
        return $this->belongsToMany(User::class , 'applications');    
    }

}
