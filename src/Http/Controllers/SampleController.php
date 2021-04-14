<?php


namespace KPAWork\MSG4wrdIO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleController extends Controller
{

    public function ShowStatus(Request $requst)
    {
        return view('msg4wrd-io::status');
    }

    public function Demo(Request $request) {

        $msg4wrd = new MSG4wrdIOController();

        $res = $msg4wrd->SampleMessage($request);

        return $res;
    }
}
