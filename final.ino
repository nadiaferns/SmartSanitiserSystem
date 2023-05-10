#include <WiFi.h>
#include <Wire.h>
#include <Adafruit_MLX90614.h>
#include <WebServer.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
//#include <Servo.h>
#include "time.h"

int potPin = 13;
int val = 0;

#define SS_PIN 5  //--> SDA / SS is connected to pinout D2
#define RST_PIN 27  //--> RST is connected to pinout D1
MFRC522 mfrc522(SS_PIN, RST_PIN);  //--> Create MFRC522 instance.
#define echoPin 25 // attach pin 4 Arduino to pin Echo of HC-SR04
#define trigPin 17 //attach pin 5 Arduino to pin Trig of HC-SR04

#define red 32
#define green 33
#define sanitizer 26
#define buzzer 4
//#define gate 13
static const int servoPin = 16;

//Servo servo1;
int angle = 0;
int angleStep = 5;

int angleMin = 0;
int angleMax = 180;

long duration; // variable for the duration of sound wave travel
int distance; // variable for the distance measurement

char* ssid = "Ap";
char* password = "apurva123";

WebServer server(80);  //--> Server on port 80

int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;

Adafruit_MLX90614 mlx = Adafruit_MLX90614();

const char* ntpServer = "pool.ntp.org";
const long  gmtOffset_sec = 0;
const int   daylightOffset_sec = 19800;
   
int noOfEm = 2;
String UserID[2] = {"67 F2 89 2A", "07 E3 85 2A"};

void setup() {
  Serial.begin(9600); //--> Initialize serial communications with the PC
  SPI.begin(); // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522
  mlx.begin();
   pinMode(22, OUTPUT);
  pinMode(21, INPUT_PULLUP);
  Wire.begin(50000);
  delay(500);

  WiFi.begin(ssid, password); //--> Connect to your WiFi router
  Serial.println("");

  pinMode(red, OUTPUT);
  pinMode(green, OUTPUT);
  pinMode(sanitizer, OUTPUT);
  pinMode(buzzer, OUTPUT);
//  pinMode(gate, OUTPUT);
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an OUTPUT
  pinMode(echoPin, INPUT); // Sets the echoPin as an INPUT
 pinMode(sanitizer,OUTPUT);
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");

  }
  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  Serial.println("Please tag a card or keychain to see the UID !");
  Serial.println("");
}

void loop() {
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
return;
}
 
// Select one of the cards
Serial.println("new card");
if ( ! mfrc522.PICC_ReadCardSerial()) {
Serial.println("in if card");
return;
}
Serial.println(" card");
 
// Dump debug info about the card; PICC_HaltA() is automatically called
mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
Serial.println("got new card");

String content = "";
  byte letter;
  for (byte i = 0; i < mfrc522.uid.size; i++)
  {
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  content.toUpperCase();

  for (int i = 0; i < noOfEm; i++) {
    Serial.println(content.substring(1));
    Serial.println(UserID[i]);
    if (content.substring(1) == UserID[i]) //change here the UID of the card/cards that you want to give access
    {
        digitalWrite(red, LOW);
      digitalWrite(green, HIGH);
      digitalWrite(buzzer, LOW);
      for(int angle = 0; angle <= angleMax; angle +=angleStep) {
//        servo1.write(angle);
        Serial.println(angle);
        delay(20);
    }
           /*Serial.print("Ambient = ");
            Serial.print(mlx.readAmbientTempC());
            Serial.print("*C\tTarget= ");
            Serial.print(mlx.readObjectTempC());
            Serial.println("C");*/
      float(data1) = mlx.readObjectTempC();
      String temp1 = String(data1);
      if(data1 > 25){
        digitalWrite(buzzer, HIGH);
        Serial.println("high temperature");
      }
      delay(1000);
     String  postData;
      //Post Data
      postData = "ldrvalue="+temp1+"&id=" + UserID[i]; 
      HTTPClient http;
      http.begin("http://smartsanitisersystem.000webhostapp.com/userdata/InsertDB.php");              //Specify request destination
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
      int httpCode = http.POST(postData);   //Send the request
      String payload = http.getString();    //Get the response payload
      Serial.println(httpCode);   //Print HTTP return code
      Serial.println(payload);    //Print request response payload
      Serial.println("Temp Value=" + temp1);
      http.end();  //Close connection
      delay(1000);
      digitalWrite(green, LOW);
      digitalWrite(buzzer, LOW);
      digitalWrite(red, HIGH);
      /*for(int angle = 180; angle >= angleMin; angle -=angleStep) {
        servo1.write(angle);
        Serial.println(angle);
        delay(200);
    }*/
    }
    else
    {
      digitalWrite(red, HIGH);
      Serial.println("Access denied");
    }
  }

     if(content.substring(0)){   
    HTTPClient http;    //Declare object of class HTTPClient
    String UIDresultSend, postData;
    UIDresultSend = content.substring(1);
    //Post Data
    postData = "UIDresult=" + UIDresultSend;
    http.begin("http://smartsanitisersystem.000webhostapp.com/getUID.php");  //Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header
    int httpCode = http.POST(postData);   //Send the request
    String payload = http.getString();    //Get the response payload
    Serial.println(UIDresultSend);
    Serial.println(httpCode);   //Print HTTP return code
    Serial.println(payload);    //Print request response payload
    http.end();  //Close connection
  }


  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);    // Sets the trigPin HIGH (ACTIVE) for 10 microseconds
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);   // Reads the echoPin, returns the sound wave travel time in microseconds                      
  duration = pulseIn(echoPin, HIGH);
  // Calculating the distance
  distance = duration * 0.034 / 2; // Speed of sound wave divided by 2 (go and back)
  // Displays the distance on the Serial Monitor
  Serial.print("Distance : ");
  Serial.println(distance);
  val = analogRead(potPin);
  Serial.print("Delay : ");
  Serial.println(val);
 
  if (distance < 15) { 
    digitalWrite(sanitizer, HIGH);
    delay(1500);
       digitalWrite(sanitizer, LOW);
  }
  else {
    digitalWrite(sanitizer, LOW);
    delayMicroseconds(200);
  }
  delay(500);
}
