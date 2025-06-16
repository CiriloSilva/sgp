/*
  NodeMCU ESP8266 + PN532 (I²C)
  Envia UID via HTTP para servidor PHP
*/
#include <Wire.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Adafruit_PN532.h>

// ---- Wi‑Fi ----
const char* SSID="SEU_SSID";
const char* PASSWORD="SUA_SENHA";

// ---- Servidor ----
const char* SERVER_URL="http://SEU_PC_IP/ponto/presenca.php";


// ---- I²C ----
#define SDA_PIN D2
#define SCL_PIN D1
Adafruit_PN532 nfc(-1, -1, &Wire);

unsigned long lastSend = 0;
const unsigned long SEND_DELAY = 3000;

void setup() {
  Serial.begin(115200);
  Wire.begin(SDA_PIN, SCL_PIN);
  pinMode(SDA_PIN, INPUT_PULLUP);
  pinMode(SCL_PIN, INPUT_PULLUP);

  nfc.begin();
  if (!nfc.getFirmwareVersion()) {
    Serial.println(F("PN532 não encontrado."));
    while(true) yield();
  }
  nfc.SAMConfig();
  Serial.println(F("NFC pronto."));

  WiFi.begin(SSID, PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print('.');
  }
  Serial.println("\nWi‑Fi conectado!");
}

void loop() {
  uint8_t uid[7]; uint8_t uidLen;
  if (nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A, uid, &uidLen)) {
    String uidStr;
    for (uint8_t i=0;i<uidLen;i++){ if(uid[i]<0x10)uidStr+='0'; uidStr+=String(uid[i],HEX); }
    uidStr.toUpperCase();
    Serial.println("UID: "+uidStr);

    if (millis()-lastSend > SEND_DELAY) {
      sendToServer(uidStr);
      lastSend = millis();
    }
  }
  yield();
}

void sendToServer(const String& uid){
  if(WiFi.status()!=WL_CONNECTED) return;
  HTTPClient http;
  WiFiClient client;
  http.begin(client, SERVER_URL);
  http.addHeader("Content-Type","application/x-www-form-urlencoded");
  int code = http.POST("uid="+uid);
  Serial.printf("HTTP %d\n", code);
  http.end();
}
