<?php

namespace KPAWork\MSG4wrdIO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MSG4wrdIOController extends Controller
{
    public static $token;
    public static $url = "https://outbound.msg4wrd.io";
    // public static $url = "http://localhost:8011";

    public function ShowStatus(Request $requst) {
        return view('msg4wrd-io::status');
    }

    public function SampleMessage($token, Request $requst)
    {
        MSG4wrdIOController::$token = $token;
        $mobile = $requst->mobile;
        if (!str_contains($mobile, '+')) {
            $mobile = "+" . $requst->mobile;
        }
        return $this->SendMessage($mobile, "Yeah", ["sendername" => "Default", "priority" => 0, "local" => 1]);
    }

    public function SendMessage($mobile, $message, $option = ["sendername" => "Default", "priority" => 0, "local" => 0]) {

        if(strlen($mobile) == 12) {
            $country = substr($mobile, 0, 2);
            if ($country != "+1") {
                return ["status" => 401, "message" => "US and PH number are allowed to send message."];
            }
        }

        else if (strlen($mobile) == 13) {
            $country = substr($mobile, 0, 3);
            if ($country != "+63") {
                return ["status" => 402, "message" => "US and PH number are allowed to send message."];
            }
        }
        else {
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

        $res = $this->PhpCurl($parameters);

        return $res;
    }

    public function PhpCurl($parameters)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, MSG4wrdIOController::$url . '/api/v1/messages/' . MSG4wrdIOController::$token);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }
}
