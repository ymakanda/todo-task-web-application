<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;


class WhatsAppController extends Controller
{
    public function create (Request $request)
    {
        $twilioSid = env('TWILIO_ACCOUNT_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $recipientNumber = 'whatsapp:+27796185041';
        $replyMessage = "Mayandie Experience";

        $twilio = new Client($twilioSid, $twilioToken);

        try {
            $reposnseMessage = $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => 'whatsapp:'.$twilioWhatsAppNumber,
                    "body" => $replyMessage,
                    "mediaUrl" => "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf"
                ]
            );
            print($reposnseMessage);
            //print($reposnseMessage->sid);

            return response()->json(['message' => 'WhatsApp message sent successfully', 'data'  => $recipientNumber ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function index(Request $request)
    {
        $twilioSid = env('TWILIO_ACCOUNT_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $recipientNumber = 'whatsapp:+27796185041';

        $client = new Client($twilioSid, $twilioToken);

        try {
            $limit = 5;
            $messageList = $client->messages->read([], $limit);
            echo '<pre>';
            echo "\tNumber \t\t\tMessage  \t\t\tUrl  \t\t\tMedia \n";
            
            foreach ($messageList as $msg) {
                if ($msg->media) {
                    echo "\t".$msg->to ."\t". $msg->body ."\t". $msg->media ."\n";
                } else {
                    echo "\t".$msg->to ."\t". $msg->body ."\t". $msg->uri ."\n";
                }
            }
            echo '</pre>';
            return response()->json(['message' => 'WhatsApp message sent successfully', 'data'  => $recipientNumber ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
