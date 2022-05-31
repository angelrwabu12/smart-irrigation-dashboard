#include <ESP8266WiFi.h>
#include <ESPAsyncTCP.h>
#include <WiFiClient.h>
#include <ESPAsyncWebServer.h>
#include <ESP8266mDNS.h>
#include <ESP8266HTTPClient.h>
#include <FS.h>
#include <DHT.h>
#include "DHT.h"
#define DhtPin D3
#define DhtType DHT11

WiFiClient client;
const char* ssid = "CANALBOX-BA81";
const char* password = "8955819532";
DHT dht(DhtPin, DhtType);
AsyncWebServer server(80);
//SSID and Password of your WiFi router
unsigned long previousMillis = 0;    // will store last time DHT was updated

// Updates DHT readings every 10 seconds
const long interval = 2000; 
//int b;
int led=16;
int msensor=A0;
int msvalue=0;
int water=711;
int nowater=1024;
int percentage;
float t=0.0;
float h=0.0;
String serverName = "http://192.168.1.73/SmartIrrigation/insert.php";
String serverNames = "http://192.168.1.73/SmartIrrigation/status.php";
void setup() {
  Serial.begin(115200);
 // pinMode(2,OUTPUT);
 pinMode(msensor,INPUT);
 //pinMode(Bulb, OUTPUT);
 pinMode(led,OUTPUT);
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");
   while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
  dht.begin();

}
 
void loop() {
  // Read temperature as Celsius (the default)
  t = dht.readTemperature();
  // Read Humidity
  h = dht.readHumidity();
   //analogWrite(led1,led);
 // b=digitalRead(Bulb);
  msvalue=analogRead(msensor);
percentage=map(msvalue,water,nowater,100,0);

//if(percentage<=20)
//{
//  digitalWrite(led,HIGH);
//}
//else{
// digitalWrite(led,LOW);
//}
delay(1000);

  if (WiFi.status() == WL_CONNECTED) {
          HTTPClient http;
         String serverPath = serverName + "?temp=" + String(t) + "&hum=" + String(h)+ "&water=" + String(percentage);
         Serial.println("Temperature =" + String(t));
         Serial.println("Humidity =" + String(h));
         Serial.println("water level =" + String(percentage));
         http.begin(client, serverPath.c_str());
          // Send HTTP GET request
          int httpResponseCode = http.GET();
          delay(1000);
          if (httpResponseCode > 0) {
            Serial.print("HTTP Response code: ");
            Serial.println(httpResponseCode);
            String payload = http.getString();
            Serial.println(payload);
         
          }
          else {
            Serial.print("Error code: ");
            Serial.println(httpResponseCode);
          }
          // Free resources
          http.end();
            
        HTTPClient https;
        String serverPaths = serverNames;
         // Your Domain name with URL path or IP address with path
          https.begin(client, serverPaths.c_str());
    
          // Send HTTP GET request
          int httpResponseCodes = https.GET();
          delay(1000);
    
          if (httpResponseCodes > 0) {
            Serial.print("HTTP Response code: ");
            Serial.println(httpResponseCodes);
            String payloads = https.getString();
            char a=payloads[3];
            Serial.print(a);
            if (a=='1'){
              digitalWrite(led,HIGH);
              
            }else
              {
                digitalWrite(led,LOW);   
               
              }
          }
          else {
            Serial.print("Error code: ");
            Serial.println(httpResponseCodes);
          }
          https.end();
  }
   
        else {
          Serial.println("WiFi Disconnected");
        }
        delay(1000);
        }
