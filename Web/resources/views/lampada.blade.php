
<html>
    <head>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

        </head>
    <body>
        <div href="" class="cube-switch">
            <span class="switch">
                <span class="switch-state off">Off</span>
                <span class="switch-state on">On</span>
            </span>
    </div>
    <div id="light-bulb" class="off ui-draggable" ><div id="light-bulb2" style="opacity: 0; "></div></div>
    </body>


</html>

<style>
    body {
  background: rgb(70, 72, 75);
}

/* SWITCH */
.cube-switch {
    border-radius:10px;
    border:1px solid rgba(0,0,0,0.4);
    box-shadow: 0 0 8px rgba(0,0,0,0.6), inset 0 100px 50px rgba(255,255,255,0.1);
    /* Prevents clics on the back */
    cursor:default;    
    display: block;
    height: 100px;
    position: relative;
    margin: 5% 0px 0px 10%;
    overflow:hidden;
    /* Prevents clics on the back */
    pointer-events:none;
    width: 100px;
    white-space: nowrap;
    background:#333;
}

/* The switch */
.cube-switch .switch {
    border:1px solid rgba(0,0,0,0.6);
    border-radius:0.7em;
    box-shadow:
    inset 0 1px 0 rgba(255,255,255,0.3),
    inset 0 -7px 0 rgba(0,0,0,0.2),
    inset 0 50px 10px rgba(0,0,0,0.2),
    0 1px 0 rgba(255,255,255,0.2);
    display:block;
    width: 60px;
    height: 60px;
    margin-left:-30px;
    margin-top:-30px;
    position:absolute;
    top: 50%;
    left: 50%;
    width: 60px;
 
    background:#666;
    transition: all 0.2s ease-out;

    /* Allows click */
    cursor:pointer;
    pointer-events:auto;
}

/* SWITCH Active State */
.cube-switch.active {
    /*background:#222;
    box-shadow:
    0 0 5px rgba(0,0,0,0.5),
    inset 0 50px 50px rgba(55,55,55,0.1);*/
}

.cube-switch.active .switch {
    background:#333;
    box-shadow:
    inset 0 6px 0 rgba(255,255,255,0.1),
    inset 0 7px 0 rgba(0,0,0,0.2),
    inset 0 -50px 10px rgba(0,0,0,0.1),
    0 1px 0 rgba(205,205,205,0.1);
}

.cube-switch.active:after,
.cube-switch.active:before {
    background:#333; 
    box-shadow:
    0 1px 0 rgba(255,255,255,0.1),
    inset 1px 2px 1px rgba(0,0,0,0.5),
    inset 3px 6px 2px rgba(200,200,200,0.1),
    inset -1px -2px 1px rgba(0,0,0,0.3);
}

.cube-switch.active .switch:after,
.cube-switch.active .switch:before {
    background:#222;
    border:none;
    margin-top:0;
    height:1px;
}

.cube-switch .switch-state {
    display: block;
    position: absolute;
    left: 40%;
    color: #FFF;

    font-size: .5em;
    text-align: center;
}

/* SWITCH On State */
.cube-switch .switch-state.on {
    bottom: 15%;
}

/* SWITCH Off State */
.cube-switch .switch-state.off {
    top: 15%;
}

#light-bulb2 {
width: 150px;
height: 150px;
background: url(https://lh4.googleusercontent.com/-katLGTSCm2Q/UJC0_N7XCrI/AAAAAAAABq0/6GxNfNW-Ra4/s300/lightbulb.png) no-repeat 0 0;
}

#light-bulb {
position: absolute;
width: 150px;
height: 150px;
top: 5%;
left: 40%;
background: url(https://lh4.googleusercontent.com/-katLGTSCm2Q/UJC0_N7XCrI/AAAAAAAABq0/6GxNfNW-Ra4/s300/lightbulb.png) no-repeat -150px 0;
cursor: move;
z-index: 800;
}

</style>

<script>
    $('.cube-switch .switch').click(function() {
    if ($('.cube-switch').hasClass('active')) {
        $('.cube-switch').removeClass('active');
        $('#light-bulb2').css({'opacity': '0'});
    } else {
        $('.cube-switch').addClass('active');
        $('#light-bulb2').css({'opacity': '1'});
    }
});
</script>

<!-- <script src="client_mqtt.js" type="text/javascript"></script> -->




<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/core-min.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/hmac-min.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/sha256-min.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script> 

<script type="text/javascript">
    // gets MQTT client 
function initClient() {    
    const clientId = Math.random().toString(36).substring(7); 
    const _client = new Paho.MQTT.Client(getEndpoint(), clientId);
 
    // publish method added to simplify messaging 
    _client.publish = function(topic, payload) { 
        let payloadText = JSON.stringify(payload); 
        let message = new Paho.MQTT.Message(payloadText); 
        message.destinationName = topic; 
        message.qos = 0; 
        _client.send(message); 
    } 
    return _client; 
} 

function getEndpoint() { 
// WARNING!!! It is not recommended to expose 
// sensitive credential information in code. 
// Consider setting the following AWS values 
// from a secure source. 

    // example: us-east-1 
    const REGION = "us-east-1";   

    // example: blahblahblah-ats.iot.your-region.amazonaws.com 
    const IOT_ENDPOINT = "a3b300y0i6kc5u-ats.iot.us-east-1.amazonaws.com";  

    // sua AWS chave de acesso
    const KEY_ID = "faebd263ac-private.pem.key"; 

    // your AWS secret access key 
    const SECRET_KEY = "faebd263ac-certificate.pem.crt"; 

    // date & time 
    const dt = (new Date()).toISOString().replace(/[^0-9]/g, ""); 
    const ymd = dt.slice(0,8); 
    const fdt = `${ymd}T${dt.slice(8,14)}Z` 
    
  const scope = `${ymd}/${REGION}/iotdevicegateway/aws4_request`; 
    const ks = encodeURIComponent(`${KEY_ID}/${scope}`); 
    let qs = `X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=${ks}&X-Amz-Date=${fdt}&X-Amz-SignedHeaders=host`; 
    const req = `GET\n/mqtt\n${qs}\nhost:${IOT_ENDPOINT}\n\nhost\n${p4.sha256('')}`; 
    qs += '&X-Amz-Signature=' + p4.sign( 
        p4.getSignatureKey( SECRET_KEY, ymd, REGION, 'iotdevicegateway'), 
        `AWS4-HMAC-SHA256\n${fdt}\n${scope}\n${p4.sha256(req)}`
    ); 
    return `wss://${IOT_ENDPOINT}/mqtt?${qs}`; 
}  
    
</script>