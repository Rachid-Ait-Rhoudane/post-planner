<?php

namespace App\Policies\Channels\Facebook;

use App\Models\User;
use App\Models\FacebookPost;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacebookPostPolicy
{
    use HandlesAuthorization;

    public function duplicatePost(User $user, FacebookPost $facebookPost)
    {
        return $user->id === $facebookPost->facebook_page->user_id ? Response::allow() : Response::deny("You're not authorized to duplicate this post");
    }

    public function viewPostAnalytics(User $user, FacebookPost $facebookPost)
    {
        return $user->id === $facebookPost->facebook_page->user_id ? Response::allow() : Response::deny("You're not authorized to view the analytics of this post");
    }

    public function updatePost(User $user, FacebookPost $facebookPost) {
        return $user->id === $facebookPost->facebook_page->user_id ? Response::allow() : Response::deny("You're not authorized to update this post");
    }

    public function deletePost(User $user, FacebookPost $facebookPost) {
        return $user->id === $facebookPost->facebook_page->user_id ? Response::allow() : Response::deny("You're not authorized to delete this post");
    }
}
