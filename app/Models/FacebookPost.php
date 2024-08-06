<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'title',
        'description',
        'file_type',
        'file_url',
        'likes',
        'comments',
        'shares',
        'original_link',
        'facebook_page_id'
    ];

    public function page() {

        return $this->belongsTo(FacebookPage::class);
    }
}
