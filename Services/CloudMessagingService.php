<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Services\CloudMessaging;

use App\Company;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

/*
 * CloudMessagingService
 */
class CloudMessagingService
{
    public function isConfigured(): bool
    {
        return config('cloudMessaging.firebaseCredentials') !== null;
    }

    public function sendNotification(Company $company): void
    {
        $factory = (new Factory())->withServiceAccount(config('cloudMessaging.firebaseCredentials'));
        $messaging = $factory->createMessaging();
        $users = $company->users;
        foreach ($users as $user) {
            if (count($user->tokens) > 0) {
                $notification = $this->getNotificationMessage();

                foreach ($user->cloudMessagingTokens as $cloudMessagingToken) {
                    $message = CloudMessage::withTarget('token', $cloudMessagingToken->token)
                        ->withNotification($notification)
                        ->withData(['click_action' => 'FLUTTER_NOTIFICATION_CLICK']);
                    try {
                        $response = $messaging->send($message);
                        Log::info(
                            'Push notification info: notification sent | firebase response: ' . implode(',', $response),
                        );
                    } catch (NotFound $notFound) {
                        $cloudMessagingToken->delete();

                        Log::error('Token was not found: ' . $notFound->getMessage(), [
                            'exception' => $notFound,
                            'user' => $user->email,
                            'notification' => $notification->jsonSerialize(),
                        ]);
                    } catch (FirebaseException $exception) {
                        Log::error('Push notification not sent: ' . $exception->getMessage(), [
                            'exception' => $exception,
                            'user' => $user->email,
                            'notification' => $notification->jsonSerialize(),
                        ]);
                    }
                }
            }
        }
    }

    private function getNotificationMessage(): Notification
    {
        return Notification::create(
            trans('pushNotification.new_delivery_title') . " \u{1F4E6}",
            trans('pushNotification.new_delivery_message'),
        );
    }
}
