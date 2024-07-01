<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TwilioServiceInterface;


class WhatsAppController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioServiceInterface $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function create (Request $request)
    {
        $data = [];
        $data['recipientNumber'] = 'whatsapp:+27796185041';
        $data['replyMessage'] = "Testing 123";
        $data['mediaUrl'] = "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf";

        try {
            $reposnseMessage = $this->twilioService->sendWhatsAppMsg($data);
            return $reposnseMessage; 
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
   
    public function index(Request $request)
    {
        $recipientNumber = 'whatsapp:+27796185041';
        try {
            $data = $this->twilioService->getWhatsAppMsgs($recipientNumber);
            echo '<pre>';
            echo "\tNumber \t\t\tMessage  \t\t\tUrl  \t\t\tMedia \n";
            
            foreach ($data as $msg) {
                if ($msg->media) {
                    echo "\t".$msg->to ."\t". $msg->body ."\t". $msg->media ."\n";
                } else {
                    echo "\t".$msg->to ."\t". $msg->body ."\t". $msg->uri ."\n";
                }
            }
            echo '</pre>';
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
