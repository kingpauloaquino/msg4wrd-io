<?php

namespace KPAWork\MSG4wrdIO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MSG4wrdIOController extends Controller
{
    public static $token;
    public static $url = "https://msg4wrd.io";

    public function SampleMessage(Request $requst)
    {
        if (!isset($requst->mobile)) {
            return ["status" => 401, "message" => "US and PH number are allowed to send message."];
        }

        $mobile = $requst->mobile;
        if (!str_contains($requst->mobile, '+')) {
            $mobile = "+" . $requst->mobile;
        }

        $country = config('msg4wrdio.country');

        $local = $country == "PH" ? 0 : 1;

        return $this->SendMessage($mobile, "This is a sample SMS Message", ["sendername" => "msg4wrd", "priority" => 0, "local" => $local]);
    }

    public function SendMessage($mobile, $message, $option = ["sendername" => "default", "priority" => 0, "local" => 0])
    {
        if (strlen($mobile) == 12) {
            $country = substr($mobile, 0, 2);
            if ($country != "+1") {
                return ["status" => 401, "message" => "US and PH number are allowed to send message."];
            }
        } else if (strlen($mobile) == 13) {
            $country = substr($mobile, 0, 3);
            if ($country != "+63") {
                return ["status" => 402, "message" => "US and PH number are allowed to send message."];
            }
        } else {
            return ["status" => 403, "message" => "Please enter a valid US/PH Mobile number."];
        }

        if (strlen($message) == 0 || strlen($message) > 160) {
            return ["status" => 404, "message" => "Minimum characters is 10 and Maximum characters is 160."];
        }

        $parameters = [
            'mobile' => $mobile,
            'message' => $message,
            'sendername' => $option["sendername"],
            'priority' => $option["priority"],
            'local' => $option["local"]
        ];

        $response = $this->PhpCurl($parameters);

        return $response;
    }

    public function PhpCurl($parameters)
    {
        $ch = curl_init();

        $url = config('msg4wrdio.domain');
        $token = config('msg4wrdio.token');

        $headers = array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $token
        );

        $postdata = json_encode($parameters);
        curl_setopt($ch, CURLOPT_URL, $url . '/api/v2/sms');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
}
