# Problema-2-SD

## Diretorios e Arquivos

### 1 - Web

Contém a página html que será usada para as operações que controlam a placa NodeMCU ESP8266.

### 1 - libraries

Contém as bibliotecas necessárias para executar o código no NodeMCU ESP8266.

#### 1.1 - NTPClient.zip
	
Usado para se conectar a um servidor de horário NTP para se mantenha sincronizado com o horário da rede.

#### 1.2 - PubSubClient.rar
É uma biblioteca de cliente para mensagens MQTT.

### 2 - wifi 

#### 2.1 - Diretório data

##### 2.1.1 - wifi_credential_example.txt

É um arquivo para configuração das credenciais 'nome_rede_wifi' e 'senha_da_rede_wifi' da rede Wifi. O arquivo devera ser renomeado para 'wifi_credential.txt', para ser possível ser lido.

#### 2.2 - certificates_example.h

É um arquivo para configur os certificados gerados na Aws deverá ser renomeado para 'certificates.h'. O conteúdo dos certificados respectivos(Amazon root CA certificado, A chave privada do dispositivo, O certificao para o dispositivo) deverão ser atribuído as seguintes constates que estão no arquivo .h:
	
	- AWS_CERT_CA;
	- AWS_KEY_PRIVATE;
	- AWS_CERT_CRT.

#### 2.3 - wifi.ino

É o código-fonte que será carregado no NodeMCU ESP8266 para o acionamento de uma LED usando o protocolo MQTT;

Obs:. O endpoint para acesso a AWS IoT dentro do código-fonte deve ser definido. 

