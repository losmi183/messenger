<?php

namespace App\Mail\Transport;

use Resend;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

class ResendTransport extends AbstractTransport
{
    protected $client;

    public function __construct(string $apiKey)
    {
        parent::__construct();
        $this->client = Resend::client($apiKey);
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());
        
        $payload = [
            'from' => $email->getFrom()[0]->toString(),
            'to' => array_map(fn($address) => $address->toString(), $email->getTo()),
            'subject' => $email->getSubject(),
        ];

        if ($email->getTextBody()) {
            $payload['text'] = $email->getTextBody();
        }

        if ($email->getHtmlBody()) {
            $payload['html'] = $email->getHtmlBody();
        }

        $this->client->emails->send($payload);
    }

    public function __toString(): string
    {
        return 'resend';
    }
}