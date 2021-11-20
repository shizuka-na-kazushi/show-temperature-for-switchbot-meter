<?php

namespace ShowSwitchBotMeter;

class SsbmSwitchBotApi {
  private $app_token;

  public function __construct($token = null) {
    $this->set_app_token($token);
  }

  public function set_app_token($token) {
    $this->app_token = $token;
  }

  public function get_devices() {
    $args = array(
      'headers'=> array(
        'Content-Type' => 'application/json; charset=utf-8',
        'Authorization' => $this->app_token,
      )
    );
      
    $response = wp_remote_get('https://api.switch-bot.com/v1.0/devices', $args);
    return wp_remote_retrieve_body($response);
  }
  
  public function get_device_status($deviceId) {
    $args = array(
      'headers'=> array(
        'Content-Type' => 'application/json; charset=utf-8',
        'Authorization' => $this->app_token,
      )
    );
      
    $response = wp_remote_get('https://api.switch-bot.com/v1.0/devices/' . $deviceId . '/status', $args);
    return wp_remote_retrieve_body($response);
  }
}
