<?php

namespace App\Services;

interface TwilioServiceInterface
{
    public function getWhatsAppMsgs(): array;
    public function sendWhatsAppMsg(array $data);
}
