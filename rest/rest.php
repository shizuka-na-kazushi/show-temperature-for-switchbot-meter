<?php

namespace ShowSwitchBotMeter;

class SsbmRest {

  private $settings;

  public function __construct($settings) {
    $this->settings = $settings;

    /* configure rest end point */
    add_action( 'rest_api_init', array($this, 'configure_custom_endpoint'));
  }

  function configure_custom_endpoint() {
    include_once dirname(__FILE__) . '/rest_config_ep.php';
  }
}
