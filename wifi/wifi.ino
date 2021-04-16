#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <NTPClient.h>
#include <WiFiUdp.h> 
#include <FS.h>
#include <string.h>
#include "certificates.h"
extern "C" {
  #include "libb64/cdecode.h"
  #include "user_interface.h"
}

const char* ssid;
const char* password;
const char* endpoint_aws = "seu-endpoint.iot.us-east-1.amazonaws.com"; // AWS Endpoint

long lastMsg = 0;
char msg[50];  //buffer para conter a mensagem a ser publicada
int count_send = 0;
int timeZone = -3;
int tick = 0;
int timerValue = 1;

//Socket UDP que a biblioteca utiliza para recuperar dados sobre o horário
WiFiUDP ntpUDP;

//Objeto responsável por recuperar dados sobre horário
NTPClient ntpClient(
    ntpUDP,                 //socket udp
    "0.br.pool.ntp.org",    //URL do servidor NTP
    timeZone*3600,          //Deslocamento do horário em relacão ao GMT 0
    60000);

WiFiClientSecure espClient;

/*WiFiServer server(80);*/
int status_LED = LOW;

os_timer_t timer; // cria o temporizador
bool tickTimer;

String getValue(String data, char separator, int index)
{
    int found = 0;
    int strIndex[] = { 0, -1 };
    int maxIndex = data.length() - 1;

    for (int i = 0; i <= maxIndex && found <= index; i++) {
        if (data.charAt(i) == separator || i == maxIndex) {
            found++;
            strIndex[0] = strIndex[1] + 1;
            strIndex[1] = (i == maxIndex) ? i+1 : i;
        }
    }
    return found > index ? data.substring(strIndex[0], strIndex[1]) : "";
}

void callback(char* topic, byte* payload, unsigned int length) 
{
  String msg;
  
  Serial.print("Message arrived [");
  Serial.print(topic);
  Serial.print("] ");
  for (int i = 0; i < length; i++) 
  {
    Serial.print((char)payload[i]);
    char c = (char)payload[i];
    msg += c;
  }
  Serial.println();

  if (msg.equals("L")){
    status_LED = LOW;    
  } else if (msg.equals("D")){
    status_LED = HIGH;    
  } else if (msg.indexOf("timer/") != -1){
    String val = getValue(msg, '/', 1);
    timerValue = val.toInt();
    Serial.println(val);
    initTimer();
  }
  
  digitalWrite(2, status_LED);
}

PubSubClient client_pubsub(endpoint_aws, 8883, callback, espClient); //Começamos conectando a um número de porta MQTT de conjunto de rede WiFi para 8883 conforme padrão

void config_wifi(String path) 
{
  String ssid_wifi = "";
  String password_wifi = "";
  int count = 0;
  
  File file = SPIFFS.open(path, "r");
  
  if (!file) {
    Serial.println("Erro ao abrir arquivo!");
  }
  
  while (file.available()) {
    if (count == 0)
      ssid_wifi = file.readStringUntil('\n'); //na primeira linha está o SSID
    else
      password_wifi = file.readStringUntil('\n'); //na segunda linha está a senha
    count++;
  }
  file.close();
  
  ssid_wifi.trim(); //remove \n do final da string lida do arquivo
  password_wifi.trim();//remove \n do final da string lida do arquivo
  
  ssid = ssid_wifi.c_str(); //conversão de string para const char
  password = password_wifi.c_str(); //conversão de string para const char

  Serial.println(ssid);
  Serial.println(password);
}

void setupNTP()
{
    //Inicializa o client NTP
    ntpClient.begin();
    
    //Espera pelo primeiro update online
    Serial.println("Esperando pela primeira atualização");
    while(!ntpClient.update())
    {
        ntpClient.forceUpdate();
    }

    // É usado para setar no espClient o tempo do servidor NTP para validar o certificado X509 e estabelecer conexão com o servidor aws
    espClient.setX509Time(ntpClient.getEpochTime());
}

int b64decode(String b64Text, uint8_t* output) 
{
  base64_decodestate s;
  base64_init_decodestate(&s);
  int cnt = base64_decode_block(b64Text.c_str(), b64Text.length(), (char*)output, &s);
  return cnt;
}

void config_certify() 
{
  
  uint8_t binaryCert[AWS_CERT_CRT.length() * 3 / 4];
  int len = b64decode(AWS_CERT_CRT, binaryCert);
  espClient.setCertificate(binaryCert, len);
  
  uint8_t binaryPrivate[AWS_KEY_PRIVATE.length() * 3 / 4];
  len = b64decode(AWS_KEY_PRIVATE, binaryPrivate);
  espClient.setPrivateKey(binaryPrivate, len);

  uint8_t binaryCA[AWS_CERT_CA.length() * 3 / 4];
  len = b64decode(AWS_CERT_CA, binaryCA);
  espClient.setCACert(binaryCA, len);
}

void getDate()// Não está sendo usado ainda
{
    //Recupera os dados de data e horário usando o client NTP
    //String formattedTime = ntpClient.getFormattedTime();
    String formattedTime = ntpClient.getFormattedDate();
    Serial.print("Formato Hora e Data: ");
    Serial.println(formattedTime);

    unsigned long epochTime = ntpClient.getEpochTime();
    struct tm *ptm = gmtime ((time_t *)&epochTime);
    String date = String(ptm->tm_year+1900) + "-" + String(ptm->tm_mon+1) + "-" + String(ptm->tm_mday);
    Serial.print("Data: ");
    Serial.println(date);

    String hour = String(ntpClient.getHours()) + ":" + String(ntpClient.getMinutes());
    Serial.print("Horas: ");
    Serial.println(hour); 
    Serial.println(); 
}

void timerCallback(void *timing){
  tick++;
  Serial.println(tick);
  
  if(tick == timerValue && status_LED == HIGH){
      status_LED = LOW;
      digitalWrite(2, status_LED);
      tick = 0;
      os_timer_disarm(&timer);
  } else if(tick == timerValue && status_LED == LOW){
     status_LED = HIGH;
     digitalWrite(2, status_LED);
     tick = 0;
     os_timer_disarm(&timer);
  }

  
}

void initTimer() {
  os_timer_setfn(&timer,timerCallback , NULL);
  os_timer_arm(&timer, 1000, true);
}

void setup()
{
  Serial.begin(115200); // Inicializa a serial
 
  Serial.println();   // Pula uma linha na janela da serial

  espClient.setBufferSizes(512, 512);

  config_wifi("/wifi_credential.txt");
  
  pinMode(2, OUTPUT);              
  digitalWrite(2, LOW);
  
  WiFi.begin(ssid, password); //Passa os parâmetros para a função que vai fazer a conexão com a rede sem fio
  delay(1000); // Intervalo de 1000 milisegundos
  Serial.print("Conectando à "); // Escreve um texto na serial
  Serial.println(ssid);
  
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500); // Intervalo de 500 milisegundos
    Serial.print("."); //Escreve o caractere na serial
  }
  
  Serial.println();
  Serial.println("WiFi conectado");
  //server.begin();  //Inicia o Servidor para receber dados na porta definida em "WiFiServer server(porta)"
  Serial.print("Endereço IP: "); // Escreve na janela da serial
  Serial.println(WiFi.localIP()); // Escreve na  o IP recebido dentro da rede sem fio (recebido de forma automática)

  setupNTP();
  
  delay(1000); // Intervalo de 1000 milisegundos

  config_certify();

}

void reconnect() 
{
  // Loop até estarmos reconectados
  while (!client_pubsub.connected()) // Enquanto falhar a conexão
  {
    Serial.print("Tentando conexão MQTT AWS IoT...");
    // Tentativa de conexão
    if (client_pubsub.connect("ESPthing")) 
    {
      Serial.println("Conectado");
      // Depois de conectado, publique uma aviso ...
      client_pubsub.publish("outTopic", "hello world");
      // ... e reinscrever
      client_pubsub.subscribe("inTopic");
    } 
    else
    {
      Serial.print("falhou, rc=");
      Serial.print(client_pubsub.state());
      Serial.println(" tente novamente em 5 segundos");
  
      char buf[256];
      espClient.getLastSSLError(buf, 256);
      Serial.print("Erro de SSL de WiFiClientSecure: ");
      Serial.println(buf);
  
      // Aguarde 5 segundos antes de tentar novamente
      delay(5000);
    }
  }
}

void loop() {

  if (!client_pubsub.connected()) // Se não houver a conexão
  {
    reconnect(); // tenta reconectar
  }
  client_pubsub.loop();
  
  long now = millis();
  if (now-lastMsg > 5000) // se o tempo da mensagem atual menos o tempo da ultima mensagem ultrapassar os 5 segundos
  {
    lastMsg = now;
    count_send++;
    
    //crie a mensagem a ser enviada
    if(status_LED == LOW)
    {
      snprintf (msg, 75, "{\"Message\": \"LIGADO\"}"); 
    }else {
       snprintf (msg, 75, "{\"Message\": \"DESLIGADO\"}"); 
    }
    //snprintf (msg, 75, "{\"Message\": \"Energy Consumption\",\"value\": %d}", count_send); 
    Serial.print("Publish message: ");
    Serial.println(msg);
  
    // publicar mensagens no tópico "outTopic"
    client_pubsub.publish("outTopic", msg);  
  }
}  
  /*WiFiClient client = server.available();  //Verifica se algum Cliente está conectado no Servidor   
  
  if (!client) {  // Se não existir Cliente conectado, faz
    return; // Reexecuta o processo até que algum Cliente se conecte ao Servidor
  }

  while(!client.available()){ // Enquanto o Cliente estiver conectado
    delay(1); //Intervalo de um milisegundo
  }
  
  String request = client.readStringUntil('\r');  //Faz a leitura da primeira linha da Requisição
  Serial.println("Nome da Requisicao");
  Serial.println(request); //Escreve a requisição na serial
  client.flush(); //Aguarda até que todos os dados de saída sejam enviados ao cliente
 

  if (request.indexOf('/LED=ON') != -1){
    status_LED = LOW;
  } else if (request.indexOf('/LED=OFF') != -1){
    status_LED = HIGH;
  }
 
  digitalWrite(2, status_LED);
 

  client.println("HTTP/1.1 200 OK"); //Escreve para o cliente a versão do HTTP
  client.println("Content-Type: text/html"); //Escreve para o cliente o tipo de conteúdo (texto/Html)
  client.println("");

  client.println("<!DOCTYPE HTML>"); //Informa ao navegador a especificação do Html
  client.println("<html>"); //Abre a tag "html"
  client.println("<head>"); //Abre o Head
  client.println("<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>");
  client.println("</head>"); //Fecha o Head
  client.println("<h1><center>Ola cliente!</center></h1>"); //Escreve "Ola cliente!" na página
  client.println("<center><font size='5'>SD - Sistemas Digitais</center>"); //Escreve "Seja bem vindo!" na página
  client.println();

 // client.println("<h3>Dispositivo Conectado</>");
  
  client.println();
  client.println("<div>");  
   if(status_LED == HIGH)  {
    client.print("<input type='image' src='https://thumbs.dreamstime.com/b/ícone-do-interruptor-de-ligar-desligar-no-fundo-branco-115192535.jpg' style='display:block; margin:auto' width='30%' onClick=location.href='/LED=ON'>");
   } else {
    client.print("<input type='image' src='https://thumbs.dreamstime.com/b/ícone-do-interruptor-de-ligar-desligar-no-fundo-branco-115194802.jpg' style='display:block; margin:auto' width='30%' onClick=location.href='/LED=OFF'>");
   }
 client.println("</div>");
 
 client.println("</html>");  //Fecha a tag "html"
 delay(1); //Intervalo de 1 milisegundo 
 Serial.println(""); //Pula uma linha na janela serial
 */
