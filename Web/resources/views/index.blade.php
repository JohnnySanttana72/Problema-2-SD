<!DOCTYPE html>
<html lang="pt-br">

<head>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div href="" class="cube-switch active">
        <span class="switch">
            <span class="switch-state off">Off</span>
            <span class="switch-state on">On</span>
        </span>
    </div>
    <div id="light-bulb" class="off ui-draggable">
        <div id="light-bulb2" style="opacity: 1; "></div>
    </div>
</body>

<style>
    body {
        background: rgb(70, 72, 75);
    }

    /* SWITCH */
    .cube-switch {
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.4);
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.6), inset 0 100px 50px rgba(255, 255, 255, 0.1);
        /* Prevents clics on the back */
        cursor: default;
        display: block;
        height: 100px;
        position: relative;
        margin: 5% 0px 0px 10%;
        overflow: hidden;
        /* Prevents clics on the back */
        pointer-events: none;
        width: 100px;
        white-space: nowrap;
        background: #333;
    }

    /* The switch */
    .cube-switch .switch {
        border: 1px solid rgba(0, 0, 0, 0.6);
        border-radius: 0.7em;
        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, 0.3),
            inset 0 -7px 0 rgba(0, 0, 0, 0.2),
            inset 0 50px 10px rgba(0, 0, 0, 0.2),
            0 1px 0 rgba(255, 255, 255, 0.2);
        display: block;
        width: 60px;
        height: 60px;
        margin-left: -30px;
        margin-top: -30px;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 60px;

        background: #666;
        transition: all 0.2s ease-out;

        /* Allows click */
        cursor: pointer;
        pointer-events: auto;
    }

    /* SWITCH Active State */
    .cube-switch.active {
        /*background:#222;
    box-shadow:
    0 0 5px rgba(0,0,0,0.5),
    inset 0 50px 50px rgba(55,55,55,0.1);*/
    }

    .cube-switch.active .switch {
        background: #333;
        box-shadow:
            inset 0 6px 0 rgba(255, 255, 255, 0.1),
            inset 0 7px 0 rgba(0, 0, 0, 0.2),
            inset 0 -50px 10px rgba(0, 0, 0, 0.1),
            0 1px 0 rgba(205, 205, 205, 0.1);
    }

    .cube-switch.active:after,
    .cube-switch.active:before {
        background: #333;
        box-shadow:
            0 1px 0 rgba(255, 255, 255, 0.1),
            inset 1px 2px 1px rgba(0, 0, 0, 0.5),
            inset 3px 6px 2px rgba(200, 200, 200, 0.1),
            inset -1px -2px 1px rgba(0, 0, 0, 0.3);
    }

    .cube-switch.active .switch:after,
    .cube-switch.active .switch:before {
        background: #222;
        border: none;
        margin-top: 0;
        height: 1px;
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
    $('.cube-switch .switch').click(function () {
        if ($('.cube-switch').hasClass('active')) {
            $('.cube-switch').removeClass('active');
            $('#light-bulb2').css({ 'opacity': '0' });
            console.log('off')
            publish('D')
        } else {
            $('.cube-switch').addClass('active');
            $('#light-bulb2').css({ 'opacity': '1' });
            console.log('on')
            publish('L')
        }
    });

    function publish(status) {
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/publishMqtt',
            type:"POST",
            data:{
                status:status,
                _token: _token
            },
            dataType: 'JSON',
            success: function (res) {
                console.log(res);
            },
            error: function() {
              
                console.log('Dispositivo Desconectado');
                republishShadow(status)
            }
        });
    }

    function republishShadow(status) {
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/republishMqtt',
            type:"POST",
            data:{
                status:status,
                _token: _token
            },
            dataType: 'JSON',
            success: function (res) {
                console.log(res);
            },
        });
    }
</script>

<script>
    $(document).ready(function () {
        subscribe("$aws/things/NodeMCU/shadow/update");
    });

    function subscribe(topic) {
        let _token   = $('meta[name="csrf-token"]').attr('content');
  
        $.ajax({
            url: '/subscribeMqtt',
            type:"POST",
            data:{
                topic:topic,
                _token: _token
            },
            dataType: 'JSON',
            cache: false,
            success: function (res) {
                console.log(res);
                // if (res.state.reported.status_LED === "LIGADO") {
                //     //On
                // } else if (res.state.reported.status_LED === "DESLIGADO") {
                //     //OFF
                // } 

                //Colocar tempo de consumo aqui
                setTimeout(function () {
                    subscribe(topic)
                }, 1000);
            },
            statusCode: {
                500: function () {
                    console.log('reconnect');
                    subscribe(topic)
                }
            }
        });
    }
</script>

</html>