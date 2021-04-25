<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 2/22/19
 * Time: 1:29 PM
 */

return [
    'host'      => env('MQTT_HOST', 'a3b300y0i6kc5u-ats.iot.us-east-1.amazonaws.com'),
    'password'  => env('MQTT_PASSWORD', ''),
    'username'  => env('MQTT_USERNAME', ''),
    'certfile'  => env('MQTT_CERT_FILE', 'C:/Users/Rafael/Documents/GitHub/Web/certificates/AmazonRootCA1.pem'),
    'localcert' => env('MQTT_LOCAL_CERT', 'C:/Users/Rafael/Documents/GitHub/Web/certificates/faebd263ac-certificate.pem.crt'),
    'localpk'   => env('MQTT_LOCAL_PK', 'C:/Users/Rafael/Documents/GitHub/Web/certificates/faebd263ac-private.pem.key'),
    'port'      => env('MQTT_PORT', '8883'),
    'timeout'   => (int) env('MQTT_TIMEOUT', 10),
    'debug'     => (bool) env('MQTT_DEBUG', false), //Optional Parameter to enable debugging set it to True
    'qos'       => env('MQTT_QOS', 1), // set quality of service here
    'retain'    => env('MQTT_RETAIN', 0) // it should be 0 or 1 Whether the message should be retained.- Retain Flag
];
