<?php

namespace ShowSwitchBotMeter;

class SsbmRestConfigEndpoint {

  private $settings;

  public function __construct($settings) {

    $this->settings = $settings;

    register_rest_route(
      'show-switchbot-meter/v1',
      '/(?P<key>[-_.!~*()a-zA-Z0-9%]+)',
      [
        'methods'  =>  \WP_REST_Server::READABLE,
        'permission_callback' => '__return_true',
        'callback' => array($this, 'fetch_get_state'),
      ]
    );
  }

  function response($file_name, $param = null) {
    $api_file = dirname(__FILE__) . "/${file_name}.php";
    $res      = file_exists($api_file) ? include_once $api_file : [];
    $response = new \WP_REST_Response($res);
    $response->set_status(200);
    return $response;
  }
    
  function fetch_get_state($param) {
      return $this->response('get_state', $param);
  }
}

$ssbm_rest_config_endpoint = new SsbmRestConfigEndpoint($this->settings);

