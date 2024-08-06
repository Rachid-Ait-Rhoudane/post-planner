<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookPage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'page_id',
        'page_name',
        'page_category',
        'page_access_token',
        'page_profile_picture',
        'user_id'
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function posts() {

        return $this->hasMany(FacebookPost::class);
    }
}
