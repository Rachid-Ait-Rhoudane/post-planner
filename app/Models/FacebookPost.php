<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacebookPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'title',
        'description',
        'file_type',
        'file_path',
        'original_link',
        'facebook_page_id',
        'is_published',
        'scheduled_time'
    ];

    public function facebook_page() {

        return $this->belongsTo(FacebookPage::class);
    }
}
