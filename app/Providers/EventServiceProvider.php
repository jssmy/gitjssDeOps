<?php

namespace GitScrum\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'GitScrum\Events\SomeEvent' => [
            'GitScrum\Listeners\EventListener',
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\GitLab\GitLabExtendSocialite@handle',
            'SocialiteProviders\Google\GoogleExtendSocialite@handle',
            'SocialiteProviders\Trello\TrelloExtendSocialite@handle',
            'SocialiteProviders\Slack\SlackExtendSocialite@handle',
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
