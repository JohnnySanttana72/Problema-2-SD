#include <ESP8266WiFi.h> 
#include <FS.h>

const char* ssid;
const char* password; 

WiFiServer server(80);
int status_LED = LOW; 

void config_wifi(String path) {
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
}

void setup()
{
  Serial.begin(115200); // Inicializa a serial
 
  Serial.println();   // Pula uma linha na janela da serial

  config_wifi("/wifi_credential.txt");
  
  pinMode(2, OUTPUT);              
  digitalWrite(2, LOW);
  
  WiFi.begin(ssid, password); //Passa os parâmetros para a função que vai fazer a conexão com a rede sem fio
  delay(1000); // Intervalo de 1000 milisegundos
  Serial.print("Conectando"); // Escreve um texto na serial
  
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500); // Intervalo de 500 milisegundos
    Serial.print("."); //Escreve o caractere na serial
  }
  
  Serial.println();
  server.begin();  //Inicia o Servidor para receber dados na porta definida em "WiFiServer server(porta)"
  Serial.print("Endereço IP: "); // Escreve na janela da serial
  
  Serial.println(WiFi.localIP()); // Escreve na  o IP recebido dentro da rede sem fio (recebido de forma automática)
  
  delay(1000); // Intervalo de 1000 milisegundos

}

void loop() {
  
  WiFiClient client = server.available();  //Verifica se algum Cliente está conectado no Servidor   
  
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
}
