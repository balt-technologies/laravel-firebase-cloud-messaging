<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Listeners;


use ExampleEvent;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Services\CloudMessaging\CloudMessagingService;

class ExamplePushNotification
{
    /**
     * @var CloudMessagingService
     */
    private CloudMessagingService $cloudMessagingService;

    /**
     * Create the event listener.
     *
     * @param CloudMessagingService $cloudMessagingService
     */
    public function __construct(CloudMessagingService $cloudMessagingService)
    {
        $this->cloudMessagingService = $cloudMessagingService;
    }

    /**
     * Handle the event.
     *
     * @param ExampleEvent $event
     * @return void
     */
    public function handle(ExampleEvent $event)
    {
        if ($this->cloudMessagingService->isConfigured()) {
            $this->cloudMessagingService->sendNotification($event->exampletarget);
        }
    }
}
