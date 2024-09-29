<?php

namespace App\Policies\Channels\Facebook;

use App\Models\User;
use App\Models\FacebookPage;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacebookPagePolicy
{
    use HandlesAuthorization;

    public function view(User $user, FacebookPage $facebookPage)
    {
        return $user->id === $facebookPage->user_id ? Response::allow() : Response::deny("You're not authorized to view the posts of this channel");
    }

    public function postToChannel(User $user, FacebookPage $facebookPage)
    {
        return $user->id === $facebookPage->user_id ? Response::allow() : Response::deny("You're not authorized to post to this channel");
    }

    public function refreshConnection(User $user, FacebookPage $facebookPage)
    {
        return $user->id === $facebookPage->user_id ? Response::allow() : Response::deny("You're not authorized to refresh this channel connection");
    }

    public function disconnect(User $user, FacebookPage $facebookPage)
    {
        return $user->id === $facebookPage->user_id ? Response::allow() : Response::deny("You're not authorized to disconnect this channel");
    }

    public function connectFacebookPage(User $user, $connectedPages) {

        return ( ($user->pages->count() + $connectedPages) <= 3 && $user->plan == 'free') || $user->plan == 'pro' ? Response::allow() : Response::deny('You already connected 3 channels, upgrade your plan to connect more');
    }
}
