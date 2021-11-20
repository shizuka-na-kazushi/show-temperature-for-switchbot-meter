<?php

namespace ShowSwitchBotMeter;

class SsbmShortcode {
  private $settings;
  private $cache = array();
  
  public function __construct($settings) {
    $this->settings = $settings;
    add_shortcode('ssbm-temperature', array($this, 'sc_temperature'));
    add_shortcode('ssbm-humidity', array($this, 'sc_humidity'));
    add_shortcode('ssbm-image', array($this, 'sc_image'));
  }
  public function sc_temperature($attr) {
    return include dirname(__FILE__) . '/sc_temperature.php';
  }
  public function sc_humidity($attr) {
    return include dirname(__FILE__) . '/sc_humidity.php';
  }
  public function sc_image($attr) {
    return include dirname(__FILE__) . '/sc_image.php';
  }
}



