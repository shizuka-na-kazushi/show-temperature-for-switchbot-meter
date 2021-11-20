<?php

namespace ShowSwitchBotMeter;

class SsbmSwitchBotApi {
  private $app_token;

  private $stub_devices_1 = '
    {
      "statusCode": 100,
      "body": {
          "deviceList": [
              {
                  "deviceId": "D9E02A645400",
                  "deviceName": "温度計: 書斎1",
                  "deviceType": "Meter",
                  "enableCloudService": true,
                  "hubDeviceId": "E3BDC9C597AE"
              },
              {
                "deviceId": "D9E02A645300",
                "deviceName": "温度計: 書斎2",
                "deviceType": "Meter",
                "enableCloudService": true,
                "hubDeviceId": "E3BDC9C597AE"
              },              
              {
                "deviceId": "D9E02A645200",
                "deviceName": "温度計: キッチン",
                "deviceType": "Meter",
                "enableCloudService": true,
                "hubDeviceId": "E3BDC9C597AE"
              }, 
              {
                  "deviceId": "E3BDC9C597AF",
                  "deviceName": "Hub Mini AF",
                  "deviceType": "Hub Mini",
                  "enableCloudService": false,
                  "hubDeviceId": "000000000000"
              }
          ],
          "infraredRemoteList": [
              {
                  "deviceId": "01-202011011405-01963962",
                  "deviceName": "テレビ",
                  "remoteType": "TV",
                  "hubDeviceId": "E3BDC9C597AF"
              },
              {
                  "deviceId": "01-202011011407-66009828",
                  "deviceName": "プロジェクター",
                  "remoteType": "Projector",
                  "hubDeviceId": "E3BDC9C597AF"
              },
              {
                  "deviceId": "01-202011011410-82554521",
                  "deviceName": "エアコン",
                  "remoteType": "Air Conditioner",
                  "hubDeviceId": "E3BDC9C597AF"
              },
              {
                  "deviceId": "01-202011011439-63342096",
                  "deviceName": "扇風機",
                  "remoteType": "Fan",
                  "hubDeviceId": "E3BDC9C597AF"
              },
              {
                  "deviceId": "02-202107261535-85225439",
                  "deviceName": "書斎エアコン",
                  "remoteType": "Air Conditioner",
                  "hubDeviceId": "E3BDC9C597AF"
              }
          ]
      },
      "message": "success"
  }';
  private $stub_device_status_1 = array(
    'D9E02A645400' => '
      {
        "statusCode": 100,
        "body": {
            "deviceId": "D9E02A645400",
            "deviceType": "Meter",
            "hubDeviceId": "E3BDC9C597AF",
            "humidity": 59,
            "temperature": 20.2
        },
        "message": "success"
      }',
    'D9E02A645300' => '
      {
        "statusCode": 100,
        "body": {
            "deviceId": "D9E02A645300",
            "deviceType": "Meter",
            "hubDeviceId": "E3BDC9C597AF",
            "humidity": 89,
            "temperature": 24.5
        },
        "message": "success"
      }    
      ' ,
    'D9E02A645200' => '
      {
        "statusCode": 100,
        "body": {
            "deviceId": "D9E02A645200",
            "deviceType": "Meter",
            "hubDeviceId": "E3BDC9C597AF",
            "humidity": 75,
            "temperature": 13.2
        },
        "message": "success"
      }',
  );

  public function __construct($token = null) {
    $this->set_app_token($token);
  }

  public function set_app_token($token) {
    $this->app_token = $token;
  }

  public function get_devices() {
    return $this->stub_devices_1;
  }
  
  public function get_device_status($deviceId) {
    $dummy = $this->stub_device_status_1;
    
    if (!array_key_exists($deviceId, $dummy)) {
      return false;
    }
    
    return $dummy[$deviceId];
  }
}
