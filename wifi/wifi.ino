/************************************************************
  Parte do código-fonte foi extraído e adaptado dos seguintes sites:
  1 - Comunicação Mqtt aws iot: https://nerdyelectronics.com/iot/how-to-connect-nodemcu-to-aws-iot-core/;
  2 - Definição dos certificados: https://savjee.be/2019/07/connect-esp32-to-aws-iot-with-arduino-code/;
  3 - Configuração NTP: https://www.fernandok.com/2018/12/nao-perca-tempo-use-ntp.html.


  Alunos: Johnny da Silva, Patrícia Carmona, Rafael Brito
  Disciplina: TEC499 
  Turma:TP02             

***********************************************************/
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <NTPClient.h>
#include <WiFiUdp.h>
#include <ArduinoJson.h> 
#include <FS.h>
#include <string.h>
#include "certificates.h"
extern "C" {
  #include "libb64/cdecode.h"
  #include "user_interface.h"
}

const char* ssid; //variável para a rede Wifi
const char* password; //variável para a senha da rede Wifi
const char* endpoint_aws = "a3b300y0i6kc5u-ats.iot.us-east-1.amazonaws.com"; // AWS Endpoint

long lastMsg = 0; // variável que armazena o tempo em milisegundos da última mensagem
char msg[256];  //buffer para conter a mensagem a ser publicada
DynamicJsonDocument doc(1024); // cria um documento do formato json
int timeZone = -3; // configuração do fuso horário de brasília
int tick = 0; // variável do cronômetro do tempo de consumo em segundos
int tack = 0; // variável que acumula o tempo de tick
//int timerValue = 1;
int hour; // variável que armazena a hora recuperada do servidor NTP
int minute; // variável que armazena o minuto recuperado do servidor NTP
int hora; // variável que armazena a hora enviada via MQTT
int minuto; // variável que armazena o minuto enviado via MQTT

//Socket UDP que a biblioteca utiliza para recuperar dados sobre o horário
WiFiUDP ntpUDP;

//Objeto responsável por recuperar dados sobre horário
NTPClient ntpClient(
    ntpUDP,                 //socket udp
    "0.br.pool.ntp.org",    //URL do servidor NTP
    timeZone*3600,          //Deslocamento do horário em relacão ao GMT 0
    60000);

//Objeto que cria o cliente MQTT
WiFiClientSecure espClient;

int status_LED = LOW; // variável que é usada para alterar o valor da LED para acender/apagar
int status_aux_LED = LOW; // variável auxiliar que é usada para alterar o valor da LED em hora marcada

os_timer_t timer; // cria o temporizador
//bool tickTimer;

//Função que recebe os dados da publicação
void callback(char* topic, byte* payload, unsigned int length) 
{
  StaticJsonDocument<256> docs; // variável que é usada para decodificar a mensagem Json
  deserializeJson(docs, payload, length); // decodifica a mensagem Json
 
  Serial.println(msg);
  
  Serial.print("Message arrived [");
  Serial.print(topic);
  Serial.print("] ");
  
  String msg = docs["state"]["desired"]["status_LED"]; // variável que recebe o Json decodificado do status da LED para o acionamento remoto
  String led_status = docs["state"]["desired"]["time"][0]["status_LED"]; // variável que recebe o Json decodificado do status da LED para o agendamento
  hora = docs["state"]["desired"]["time"][0]["hour"]; // variável que recebe o Json decodificado da hora para o agendamento
  minuto = docs["state"]["desired"]["time"][0]["minute"]; // variável que recebe o Json decodificado do minuto para o agendamento
  String timer_status_LED = docs["state"]["desired"]["timer"]["status_LED"];// variável que recebe o Json decodificado do status da LED para o temporizador

  // Condição para o acionamento remoto
  if (msg != NULL){
    if (msg.equals("L")){
      status_LED = LOW;  
      digitalWrite(2, status_LED); 
      initTimer();  
    } else if (msg.equals("D")){
      status_LED = HIGH;  
      digitalWrite(2, status_LED);  
    }
  } 

  // Condição para o acionamento via temorizador
  if (timer_status_LED != NULL){
   
    if (timer_status_LED.equals("L")){
      status_LED = LOW; // atribui status da LED para ligado
      digitalWrite(2, status_LED); // comando que modifica o estado da LED
      initTimer(); // dispara o temporizador
    } else if (timer_status_LED.equals("D")){
      status_LED = HIGH; // atribui status da LED para desligado 
      digitalWrite(2, status_LED); // comando que modifica o estado da LED
    }
  }

  // Condição para o acionamento via Agendamento
  if(led_status != NULL) {
    Serial.println(led_status);
    
    if (led_status.equals("L")){
      status_aux_LED = LOW; // atribui status auxiliar da LED para ligado
    } else if (led_status.equals("D")){
      status_aux_LED = HIGH; //atribui status auxiliar da LED para desligado  
    }

    File file2 = SPIFFS.open("/agenda.txt","w+"); // cria o arquivo para armazenar a hora, minuto e status da LED
     
     if(!file2){
        Serial.println("Erro ao abrir arquivo!");
     } else {
        file2.println(status_aux_LED); //escreve em arquivo o status da LED
        file2.println(hora); //escreve em arquivo a hora marcada
        file2.println(minuto); //escreve em arquivo o minuto marcado
        Serial.println("gravou agenda");
     }
     file2.close();
  }
  
  
}

//Conectando a um número de porta MQTT 8883 conforme padrão
PubSubClient client_pubsub(endpoint_aws, 8883, callback, espClient); 

//Função que configura as credênciais da rede Wifi
void config_wifi(String path) 
{
  String ssid_wifi = "";
  String password_wifi = "";
  int count = 0;
  
  File file = SPIFFS.open(path, "r");// Abre arquivo que contém as credênciais da rede Wifi
  
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
  file.close(); // fecha arquivo
  
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

//função que decodifica o base64 do certificado 
int b64decode(String b64Text, uint8_t* output) 
{
  base64_decodestate s;
  base64_init_decodestate(&s);
  int cnt = base64_decode_block(b64Text.c_str(), b64Text.length(), (char*)output, &s);
  return cnt;
}

// função para confurar os certificados
void config_certify() 
{
  
  uint8_t binaryCert[AWS_CERT_CRT.length() * 3 / 4];//converte o tamanho do certificado pra um número binário sem sinal 
  int len = b64decode(AWS_CERT_CRT, binaryCert); //decodifica na base 64 o certificado 
  espClient.setCertificate(binaryCert, len); //atribui o certificado Root ao cliente MQTT
  
  uint8_t binaryPrivate[AWS_KEY_PRIVATE.length() * 3 / 4];//converte o tamanho do certificado pra um número binário sem sinal 
  len = b64decode(AWS_KEY_PRIVATE, binaryPrivate); //decodifica na base 64 o certificado 
  espClient.setPrivateKey(binaryPrivate, len); //atribui a chave privada ao cliente MQTT

  uint8_t binaryCA[AWS_CERT_CA.length() * 3 / 4];
  len = b64decode(AWS_CERT_CA, binaryCA); //atribui o certificado ao cliente MQTT
  espClient.setCACert(binaryCA, len);
}

// função executada pelo temporizador
void timerCallback(void *timing){
  tick++;
  Serial.println(tick);
  
  if(status_LED == HIGH){
     tack += tick;
       
     doc.clear();
     doc["state"]["reported"]["tempo_consumo"] = tack;// atribui o valor do tempo em segundos ao documento Json
     serializeJson(doc, msg);
     Serial.print("Publish message: ");
     Serial.println(msg);
  
     // publicar mensagens no tópico "outTopic"
     client_pubsub.publish("$aws/things/NodeMCU/shadow/update", msg); // publica o tempo em segundos de consumo da LED
     tick = 0;
     os_timer_disarm(&timer);//interrompe o temporizador
  }

  
}

// função que inicia o temporizador
void initTimer() {
  os_timer_setfn(&timer,timerCallback , NULL);
  os_timer_arm(&timer, 1000, true);
}

// função que inicializa as configurações para a conexão da rede Wifi, conexão MQTT
void setup()
{
  Serial.begin(115200); // Inicializa a serial
 
  Serial.println();   // Pula uma linha na janela da serial

  espClient.setBufferSizes(512, 512); // seta o valor máximo do buffer para o cliente MQTT

  config_wifi("/wifi_credential.txt"); // configuração a rede wifi
  
  pinMode(2, OUTPUT); // define o pino da LED como pino de saída              
  digitalWrite(2, LOW); // atribui o status da LED como ligado
  initTimer(); // dispara o cronômetro
  
  WiFi.begin(ssid, password); //Passa os parâmetros para a função que vai fazer a conexão com a rede sem fio
  delay(1000); // Intervalo de 1000 milisegundos
  Serial.print("Conectando à rede Wifi"); // Escreve um texto na serial
  
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500); // Intervalo de 500 milisegundos
    Serial.print("."); //Escreve o caractere na serial
  }
  
  Serial.println();
  Serial.println("WiFi conectado");
  Serial.print("Endereço IP: "); // Escreve na janela da serial
  Serial.println(WiFi.localIP()); // Escreve na  o IP recebido dentro da rede sem fio (recebido de forma automática)

  setupNTP();// inicia o servidor NTP para a recuperar o horário atual(horário de Brasília) 
  
  delay(1000); // Intervalo de 1000 milisegundos

  config_certify();// configura os certificados

}

// função para reconectar ao broker MQTT
void reconnect() 
{
  int count_agenda = 0;// variável para contar a quantidade de linhas do arquivo
  // Ler arquivo da agenda
  File agenda = SPIFFS.open("/agenda.txt","r"); // abre o arquivo para leitura dos valores referentes a hora, minuto e status da LED
  
  if (!agenda) {
    Serial.println("Erro ao abrir arquivo com o agendamento!");
  }

  String status_arquivo; //variável que recupera o status da LED
  String hora_arquivo; //variável que recupera a hora agendada
  String minuto_arquivo; //variável que recupera o minuto agendado
  
  while (agenda.available()) {
    if (count_agenda == 0)
       status_arquivo = agenda.readStringUntil('\n'); //na primeira linha está o status da LED
    else if (count_agenda == 1)
       hora_arquivo = agenda.readStringUntil('\n'); //na segunda linha está a hora
    else
       minuto_arquivo = agenda.readStringUntil('\n'); //na terceira linha está o minuto
    count_agenda++;
  }
  agenda.close(); // fecha arquivo

  status_arquivo.trim(); //remove \n do final da string lida do arquivo
  hora_arquivo.trim();//remove \n do final da string lida do arquivo
  minuto_arquivo.trim();//remove \n do final da string lida do arquivo
  
  status_aux_LED = status_arquivo.toInt(); //conversão de string para inteiro
  hora = hora_arquivo.toInt(); //conversão de string para inteiro
  minuto = minuto_arquivo.toInt(); //conversão de string para inteiro
  
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
      client_pubsub.subscribe("$aws/things/NodeMCU/shadow/update/accepted");
    } 
    else
    {
      Serial.print("falhou, rc=");
      Serial.print(client_pubsub.state());
      Serial.println(" tente novamente em 5 segundos");
  
      char buf[256]; // cria buffer para armazenar a mensagem que será enviada no formato Json
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
  client_pubsub.loop(); //chama novamente a função loop
  
  long now = millis();
  if (now-lastMsg > 5000) // se o tempo da mensagem atual menos o tempo da ultima mensagem ultrapassar os 5 segundos
  {
    lastMsg = now;// recupera o tempo atual em milissegundos
    
    hour = ntpClient.getHours(); // recupera a hora atual
    minute = ntpClient.getMinutes(); // recupera o minuto atual
    
    
    String horas = (String)hour+":"+(String)minute;// formata o horário atual
    Serial.print("Horas: ");
    Serial.println(horas);

    // condição que verifica se o horário atual é igual ao horário agendado
    if(hour == hora && minute == minuto) {
      
      status_LED = status_aux_LED;
      digitalWrite(2, status_LED);
      if(status_LED == LOW) {
        initTimer(); 
      }
      
    }
    
    doc.clear(); // apaga o doc do json

    // condição que diferencia a mensagem de ligar e desligar
    if(status_LED == LOW)
    {
      doc["state"]["reported"]["status_LED"] = "LIGADO";
    }else {
      doc["state"]["reported"]["status_LED"] = "DESLIGADO"; 
    }
    serializeJson(doc, msg); // serializa a mensagem Json
    Serial.print("Publish message: ");
    Serial.println(msg);
  
    // publicar mensagens no tópico "$aws/things/NodeMCU/shadow/update"
    client_pubsub.publish("$aws/things/NodeMCU/shadow/update", msg);  
  }
}  
