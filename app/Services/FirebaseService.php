<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(
                storage_path('firebase/firebase.json')
            );

        $this->messaging = $factory->createMessaging();
    }

    public function enviarNotificacion(
        $token,
        $titulo,
        $mensaje
    ) {
        $message = CloudMessage::withTarget(
            'token',
            $token
        )->withNotification(
            Notification::create(
                $titulo,
                $mensaje
            )
        );

        $this->messaging->send($message);
    }
}