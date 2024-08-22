<?php

namespace App\Providers;

use App\Models\FacebookPage;
use App\Models\FacebookPost;
use App\Policies\Channels\Facebook\FacebookPagePolicy;
use App\Policies\Channels\Facebook\FacebookPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        FacebookPage::class => FacebookPagePolicy::class,
        FacebookPost::class => FacebookPostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
