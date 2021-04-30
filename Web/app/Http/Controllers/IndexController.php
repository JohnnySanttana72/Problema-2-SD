<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
//use Salman\Mqtt\MqttClass\Mqtt;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');

    }

    public function publishMqtt(Request $request){

        $msg = array(
            "state" => array(
                "desired" => array(
                    "status_LED" => $request->status
                ),
            ),
        );
        
        $json = json_encode($msg);

        
        $mqtt = MQTT::connection();
        $mqtt->publish('$aws/things/NodeMCU/shadow/update/accepted', $json);

        if($mqtt == true) {

            $result = [];

            set_time_limit(3);

            $mqtt = MQTT::connection();
            $mqtt->subscribe('$aws/things/NodeMCU/shadow/update', function (string $topic, string $message) use ($mqtt, &$result) {
                $result['topic'] = $topic;
                $result['message'] = $message;

                $mqtt->interrupt();
            });

            $mqtt->loop(true, false, 200 );
            

            return response()->json(['message' => 'publicado'], 200);
        } else {
            return response()->json('Falha na publicação', 200);
        }
    }

    public function republishMqtt(Request $request){
       
        $msg = array(
            "state" => array(
                "desired" => array(
                    "status_LED" => $request->status
                ),
            ),
        );
        
        $json = json_encode($msg);
        
        $mqtt = MQTT::connection();
        $mqtt->publish('$aws/things/NodeMCU/shadow/update', $json);

        if($mqtt == true) {
            return response()->json(['message' => 'Publicação para atualizar Shadow Device'], 200);
        } else {
            return response()->json('Falha na publicação', 200);
        }
        
    }

    public function subscribeMqtt(Request $request){

        $topic = $request->topic;
        $mqtt = MQTT::connection();
        $mqtt->publish('$aws/things/NodeMCU/shadow/get', '');
        $result = [];
        $mqtt->subscribe($topic, function (string $topic, string $message) use ($mqtt, &$result) {
            $result['topic'] = $topic;
            $result['message'] = $message;

            $mqtt->interrupt();
        }, 1);
        $mqtt->loop(true);
        return response()->json($result, 200);
    }
}