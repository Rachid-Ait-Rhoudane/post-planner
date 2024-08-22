<?php

namespace App\Policies\Channels\Facebook;

use App\Models\FacebookPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacebookPostPolicy
{
    use HandlesAuthorization;

    public function duplicatePost(User $user, FacebookPost $facebookPost)
    {
        return $user->id === $facebookPost->facebook_page->user_id;
    }

    public function viewPostAnalytics(User $user, FacebookPost $facebookPost)
    {
        return $user->id === $facebookPost->facebook_page->user_id;
    }

    public function updatePost(User $user, FacebookPost $facebookPost) {
        return $user->id === $facebookPost->facebook_page->user_id;
    }

    public function deletePost(User $user, FacebookPost $facebookPost) {
        return $user->id === $facebookPost->facebook_page->user_id;
    }
}
