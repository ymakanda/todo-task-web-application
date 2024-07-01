<?php

namespace App\Services;
use Twilio\Rest\Client;

class TwilioService implements TwilioServiceInterface
{
    protected $twilioSid;
    protected $twilioToken;
    protected $twilioWhatsAppNumber;

    public function __construct()
    {
        $this->twilioSid = env('TWILIO_ACCOUNT_SID');
        $this->twilioToken = env('TWILIO_AUTH_TOKEN');
        $this->twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
    }

    public function getWhatsAppMsgs(): array
    {
        $client = new Client($this->twilioSid, $this->twilioToken);

        try {
            $limit = 10;
            $response = $client->messages->read([], $limit);

            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendWhatsAppMsg(array $data)
    {
        $twilio = new Client($this->twilioSid, $this->twilioToken);
        try {
            $reposnseMessage = $twilio->messages->create(
                $data['recipientNumber'],
                [
                    "from" => 'whatsapp:'.$this->twilioWhatsAppNumber,
                    "body" => $data['replyMessage'],
                    "mediaUrl" =>$data['mediaUrl']
                ]
            );
            return response()->json(['message' => 'WhatsApp message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}