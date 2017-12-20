#include <FastIO.h>
#include <I2CIO.h>
#include <LCD.h>
#include <LiquidCrystal.h>


#include <Wire.h> 
#include <LiquidCrystal_I2C.h>

#include <stdio.h>
#include <Keypad.h>


int STEPS_PER_CM = 32; // number of steps per 1 centimeter
const char MOTOR_DIRECTION_UP_PIN = 53, MOTOR_DIRECTION_DOWN_PIN = 51;
const char ENCODER_PIN = A3;
const char CRASH_UP = A8;
const char CRASH_DOWN = A9;

const long WAIT_DELAY_FOR_PROGRAMING = 3000; // 3000ms
const long WAIT_STD_DELAY = 50; // 50ms


LiquidCrystal_I2C lcd(0x3F, 2, 1, 0, 4, 5, 6, 7, 3, POSITIVE);  // Set the LCD I2C address

const byte ROWS = 5; //five rows
const byte COLS = 4; //four columns
//define the cymbols on the buttons of the keypads
char hexaKeys[ROWS][COLS] = {
  {'A','B','#','*'},
  {'1','2','3','U'},
  {'4','5','6','D'},
  {'7','8','9','Q'},
  {'L','0','R','O'}
};
byte rowPins[ROWS] = {34, 36, 38, 40, 42}; //connect to the row pinouts of the keypad
byte colPins[COLS] = {50, 48, 46, 44}; //connect to the column pinouts of the keypad

//initialize an instance of class NewKeypad
Keypad customKeypad = Keypad( makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS); 

String str_display[2] = {"Unesi debljinu:",""};
String temp_move="";
String mode = "F1";
char input_coursor_position = 0;
String temp_str="";

bool ff=false;
int counter_delay=0;
long encoder_count=0; 
bool encoder_old_state=false;
bool encoder_start_flag=false;
const char perid_steps=32; // One period = 1cm move

bool ready_to_go=false;

void removeLastCharacterFromString();
void moveMotor();

void runEncoder();
void checkFinishMove();

void restart( bool );

void checkEndPingSensor();
bool checkStartPingSensor();

void checkCrash();

void writeShift( char );
void runBrent();

void programingMode();
void programingModeCheck();

void setup(){
  lcd.begin(16,2);               // initialize the lcd 
  lcd.clear();

  pinMode(MOTOR_DIRECTION_UP_PIN, OUTPUT); // motor up
  pinMode(MOTOR_DIRECTION_DOWN_PIN, OUTPUT); // motor down

  digitalWrite(MOTOR_DIRECTION_UP_PIN, LOW); // motor up disable
  digitalWrite(MOTOR_DIRECTION_DOWN_PIN, LOW); // motor down disable


  pinMode(CRASH_UP, INPUT);
  pinMode(CRASH_DOWN, INPUT);

  digitalWrite(CRASH_UP, HIGH);
  digitalWrite(CRASH_DOWN, HIGH);
  
  pinMode(ENCODER_PIN, INPUT_PULLUP); // encoder

  customKeypad.addEventListener(keypadEvent); // Add an event listener for this keypad
  restart(true);
}


  
void loop(){
  
  char inputKey = customKeypad.getKey();
  if( !encoder_start_flag ) {
    if( inputKey == 'A' ) { 
      runBrent();
    } else if ( inputKey == 'U' ) {
      upBrent();
    } else if ( inputKey == 'D' ) {
      downBrent();
    } else if ( inputKey == 'L' ) { // remove character
      removeLastCharacterFromString();
    } else if ( inputKey == 'O' ) {
      moveMotor();
    } else if (inputKey  ){
      writeShift(inputKey);
    }

    cursorBlink();

  } else if( inputKey == 'Q' ) {
    restart(true);
  } else {
    runEncoder();
    checkFinishMove();
  }
  
  checkCrash();
}




void programingModeCheck(){
  unsigned long wait_time, start_time, start_time_std_delay;
  start_time = millis();
  start_time_std_delay = start_time;
  char inputKey;

  while(1){
    wait_time = millis() - start_time;
    if( wait_time > WAIT_DELAY_FOR_PROGRAMING ) { // if hold '*' WAIT_DELAY_FOR_PROGRAMING=3000ms 
      programingMode();
      restart(true);
      return;
    }
    wait_time = millis() - start_time_std_delay;
    if( wait_time > WAIT_STD_DELAY ) { // standard wait delay 50ms for break loop
      start_time_std_delay = millis();
      inputKey = customKeypad.getKey();
      if( inputKey != '*' ) {
        return;
      }
    }

  }

}

void programingMode() {
  str_display[1]="";
  input_coursor_position=0;
  lcd.clear();
  lcd.setCursor (0 , 0 );
  lcd.print("Unesi impuls/cm:");
  lcd.setCursor (0 , 1 );
  lcd.print("_ [mm]");

  while(1) {
    cursorBlink();
    inputKey = customKeypad.getKey();
    if ( inputKey ){
      writeShift(inputKey);
    }

    if ( inputKey == 'O' ) {
      STEPS_PER_CM = str_display[1].toInt(); 
      lcd.clear();
      lcd.setCursor (0 , 0 );
      lcd.print("Impuls/cm je:");
      lcd.setCursor (0 , 1 );
      lcd.print(STEPS_PER_CM + " [mm]");
      delay(2000);
      return;
    } else if ( inputKey == 'Q' ) {
      return;
    }
    delay(10);

  }

}


void cursorBlink() { 
  counter_delay++;
  if(counter_delay==101)
    counter_delay=0;
  if(ff && counter_delay == 100 ){
    lcd.setCursor (input_coursor_position , 1 );
    lcd.print("_");
    ff=!ff;
    
  } else if ( !ff && counter_delay == 100  ){
    lcd.setCursor (input_coursor_position , 1 );
    lcd.print(" ");
    ff=!ff;
  } 
  delay(5);
}

void upBrent(){
  restart(false);
  digitalWrite(MOTOR_DIRECTION_DOWN_PIN, LOW); // motor down disable
  delay(100);
  digitalWrite(MOTOR_DIRECTION_UP_PIN, HIGH); // up direction
  lcd.clear();
}
void downBrent(){
  restart(false);
  digitalWrite(MOTOR_DIRECTION_UP_PIN, LOW); // motor up disable
  delay(100);
  digitalWrite(MOTOR_DIRECTION_DOWN_PIN, HIGH); // down direction
  lcd.clear();
}

void runBrent(){
  ready_to_go=true;
  while(ready_to_go) {
    lcd.clear();
    delay(700);
    lcd.setCursor (0 , 0 );
    lcd.print("Brenta reze");
    lcd.setCursor (0 , 1 );
    lcd.print("dasku od:"+temp_move+"[mm]");
    delay(700);
    checkEndPingSensor();
    checkCrash();
  }

}


void writeShift(char inputKey) {
  int ascii_key_of_input = (int)inputKey;
  if( ascii_key_of_input >= 48 && ascii_key_of_input <= 57 ) { // decimal input 0-9
    if(input_coursor_position+1<6) {
      input_coursor_position++;
      temp_str=str_display[1];
      temp_str+=inputKey;
      str_display[1]=temp_str;
      lcd.setCursor (0 , 1 );
      lcd.print(str_display[1]+"_ [mm]");
    } else { // max.number of characters
      lcd.setCursor (0 , 1 );
      lcd.print("Max.broj cifara!");
      delay(1000);
      lcd.setCursor (0 , 1 );
      lcd.print("                ");
      delay(200);
      lcd.setCursor (0 , 1 );
      lcd.print(str_display[1]+"_ [mm]");
    }
    
  } 
}


void removeLastCharacterFromString(){
  temp_str = "";
  String local_temp_str=str_display[1];

  for(int i=0; i<input_coursor_position-1;i++) {
    temp_str+=local_temp_str[i];
  }
  str_display[1]=temp_str;
  lcd.setCursor (0 , 1 );
  lcd.print("                ");
  lcd.setCursor (0 , 1 );
  lcd.print(str_display[1]+"_ [mm]");
  input_coursor_position--;
  if(input_coursor_position<0){
    input_coursor_position=0;
  }
  
}

void moveMotor(){
  temp_move=str_display[1];
  digitalWrite(MOTOR_DIRECTION_UP_PIN, LOW); // motor up disable
  delay(100);
  digitalWrite(MOTOR_DIRECTION_DOWN_PIN, HIGH); // down direction
  lcd.clear();
  lcd.setCursor (0 , 0 );
  lcd.print("Pomijeram za:");
  lcd.setCursor (0 , 1 );
  lcd.print(str_display[1]+" [mm]");
  encoder_start_flag=true;
  
}


void runEncoder(){
  bool encoder_new_change = digitalRead(ENCODER_PIN);
  
  if( encoder_new_change != encoder_old_state ) {
    encoder_old_state = !encoder_old_state;
    encoder_count++;
  }
}


void checkFinishMove(){
  int the_limit_move_mm = str_display[1].toInt(); 
  long limit_move_in_steps_per_mm = the_limit_move_mm * STEPS_PER_CM;
  long limit_move_in_steps_per_cm = limit_move_in_steps_per_mm / 10;
  if( encoder_count >= limit_move_in_steps_per_cm ) {
    restart(true);
  }
  
}

void restart( bool on_off_flag = true ){
    if( on_off_flag ){
      digitalWrite(MOTOR_DIRECTION_DOWN_PIN, LOW); // motor down disable
      digitalWrite(MOTOR_DIRECTION_UP_PIN, LOW); // motor up disable
    }
    str_display[1]="";
    input_coursor_position=0;
    encoder_count=0;
    encoder_start_flag=false;
    lcd.clear();
    lcd.setCursor (0 , 0 );
    lcd.print(str_display[0]);
    lcd.setCursor (0 , 1 );
    lcd.print("_ [mm]");
}

void keypadEvent(KeypadEvent key){

   switch (customKeypad.getState()){
    case PRESSED:
        break;

    case RELEASED:
        if( key == 'U' || key == 'D' ){
           restart(true); 
        }
        break;

    case HOLD:
      if( key == 'U' ){
        lcd.setCursor (0 , 0 );
        lcd.print("Podizem brentu.");
      } else if ( key == 'D' ){
        lcd.setCursor (0 , 0 );
        lcd.print("Spustam brentu.");
      } else if ( key == '*' ){
        lcd.setCursor (0 , 0 );
        lcd.print("Programiraj");
        programingModeCheck();
      }
       break;
    } 
}

long getDistanceCm(uint8_t trig_pin, uint8_t echo_pin) {

    long duration, cm;

    pinMode(trig_pin, OUTPUT);
    digitalWrite(trig_pin, LOW);
    delayMicroseconds(2);
    digitalWrite(trig_pin, HIGH);
    delayMicroseconds(10);
    digitalWrite(trig_pin, LOW);

    pinMode(echo_pin, INPUT);
    duration = pulseIn(echo_pin, HIGH);

    cm = microsecondsToCentimeters(duration);
    return cm ;
}

long microsecondsToCentimeters(long microseconds)
{
    return microseconds / 29 / 2;
}

void checkEndPingSensor(){
    long cm_end_ping = getDistanceCm (24,26);

    if( cm_end_ping<50 ) { // detected balvan
      while( ready_to_go ) {
        cm_end_ping = getDistanceCm (24,26);
        if(cm_end_ping<100) { // detected end of balvan
          lcd.clear();
          lcd.setCursor (0 , 0 );
          lcd.print("ODMICEM BRENTU");
          lcd.setCursor (0 , 1 );
          lcd.print("ZA 5 [mm]");
          delay(1000);
          digitalWrite(MOTOR_DIRECTION_DOWN_PIN, LOW); // motor down disable
          delay(100);
          digitalWrite(MOTOR_DIRECTION_UP_PIN, HIGH); // up direction
          long the_limit_move_mm = 5;
          long limit_move_in_steps = (the_limit_move_mm *32)/10;

          encoder_count=0;
          while( 1 ) {
            checkCrash();
            runEncoder();
            if( encoder_count >= limit_move_in_steps ) {
              break;
            }
          }

          restart(true);

          while(1){
            checkCrash();
            lcd.clear();
            lcd.setCursor (0 , 0 );
            lcd.print("VRACAM BRENTU");
            lcd.setCursor (0 , 1 );
            lcd.print(">>>>>>>>>>>>>>>>");
            delay(700);
            lcd.setCursor (0 , 1 );
            lcd.print("<<<<<<<<<<<<<<<<");
            delay(700);  
            if( checkStartPingSensor()){
              break;
            }
            
          }
          
          ready_to_go=false;
          restart(true);
          
        }
      }
    }
}

bool checkStartPingSensor(){
  
    long cm_start_ping = getDistanceCm (28,30);
    if(cm_start_ping<50) { // detected start end of balvan
      while(1){
        cm_start_ping = getDistanceCm (28,30);
        if(cm_start_ping<100) { // detected end of end balvan
          lcd.clear();
          lcd.setCursor (0 , 0 );
          lcd.print("PRIMICEM BRENTU");
          lcd.setCursor (0 , 1 );
          lcd.print("ZA 5 [mm]");
          delay(1000);
          digitalWrite(MOTOR_DIRECTION_UP_PIN, LOW); // motor up disable
          delay(100);
          digitalWrite(MOTOR_DIRECTION_DOWN_PIN, HIGH); // down direction
          long the_limit_move_mm = 5;
          long limit_move_in_steps = (the_limit_move_mm *32)/10;

          encoder_count=0;
          while( 1 ) {
            checkCrash();
            runEncoder();
            if( encoder_count >= limit_move_in_steps ) {
              break;
            }
          }
          return true;
          
          lcd.clear();
          lcd.setCursor (0 , 0 );
          lcd.print("Izrezana daska");
          lcd.setCursor (0 , 1 );
          lcd.print("debljine:"+str_display[1] + "[mm]");
          delay(5000);

        }
      }
    }
    return false;
}

void checkCrash() {
   bool crash_up = digitalRead(CRASH_UP);
   bool crash_down = digitalRead(CRASH_DOWN);

   if( crash_up == LOW ) {
      restart(true);
      lcd.clear();
      lcd.setCursor (0 , 0 );
      lcd.print("LIMIT !!!");
      lcd.setCursor (0 , 1 );
      lcd.print("SPUSTI BRENTU");
     
      bool crash_up_null;
      while(1) {
        delay(10);
        crash_up_null = digitalRead(CRASH_UP);
        if( crash_up_null == HIGH ){
            restart(true);
            break;
        }
      }
   }

   if( crash_down == LOW ) {
      restart(true);
      lcd.clear();
      lcd.setCursor (0 , 0 );
      lcd.print("LIMIT !!!");
      lcd.setCursor (0 , 1 );
      lcd.print("PODIGNI BRENTU");
      
      bool crash_down_null;
      while(1) {
        delay(10);
        crash_down_null = digitalRead(CRASH_DOWN);
        char inputKey = customKeypad.getKey();
    if ( inputKey == 'U' ) {
      restart(false);
      digitalWrite(MOTOR_DIRECTION_DOWN_PIN, LOW); // motor down disable
      delay(100);
      digitalWrite(MOTOR_DIRECTION_UP_PIN, HIGH); // up direction
      lcd.clear();
    } 
        
        if( crash_down_null == HIGH ){
            restart(true);
            break;
        }
      }
   }

  
}
