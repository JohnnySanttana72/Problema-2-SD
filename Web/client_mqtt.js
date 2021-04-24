var awsIot = require('aws-iot-device-sdk');
const express = require('express'); // Bilioteca para criar um servidor
const app = express();

let http = require('http');
let fs = require('fs');

let handleRequest = (request, response) => {
    response.writeHead(200, {
        'Content-Type': 'text/html'
    });
    fs.readFile('./lampada.html', null, function (error, data) {
        if (error) {
            response.writeHead(404);
            respone.write('Whoops! File not found!');
        } else {
            response.write(data);
        }
        response.end();
    });
};

http.createServer(handleRequest).listen(8000);

// app.listen(process.env.PORT || 3000);

var device = awsIot.device({
   keyPath: "faebd263ac-private.pem.key",
  certPath: "faebd263ac-certificate.pem.crt",
    caPath: "AmazonRootCA1.pem",
  clientId: "NodeMCU",
      host: "a3b300y0i6kc5u-ats.iot.us-east-1.amazonaws.com"
});

device.on('connect', function() {
    console.log('connect');
    device.subscribe('topic_1');
    device.publish('topic_2', JSON.stringify({ test_data: 1}));
});

device.on('message', function(topic, payload) {
    console.log('message', topic, payload.toString());
});