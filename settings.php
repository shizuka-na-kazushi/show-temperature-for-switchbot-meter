<?php

namespace ShowSwitchBotMeter;

class SsbmSettings
{
  private $option_name = 'switchbot_meter_options';

  /**
   * Holds the values to be used in the fields callbacks
   */
  private $options;

  /**
   * Start up
   */
  public function __construct()
  {
    add_action('admin_menu', array($this, 'add_option_page'));
    add_action('admin_init', array($this, 'admin_init'));
    register_uninstall_hook(__FILE__, array($this, 'uninstall_plugin'));
  }

  public function add_option_page() {
    include_once dirname(__FILE__) . '/settings_admin_menu.php';
  }
  /**
   * Register and add settings
   */
  public function admin_init() {
    load_plugin_textdomain('show-switchbot-meter', false, 'show-temperature-for-switchbot-meter/languages');
    include_once dirname(__FILE__) . '/settings_admin_init.php';
  }

  public function get_app_token() {
    $this->options = get_option($this->option_name);
    return $this->options['app_token'];
  }
  
  public function get_temperature_unit() {
    $this->options = get_option($this->option_name);
    return $this->options['temperature_unit'];
  }

  public function get_temperature_in_current_unit($api_temp_value) {
    $temp_unit = $this->get_temperature_unit();
    // api always returns it in celsius.
    $temp_val = $api_temp_value; 
    // if user settings is fahrenheit, need to transform to be in celsius.
    if (strcmp($temp_unit, '1') == 0) { // '1' : fahrenheit
      $temp_val = sprintf('%.1f', ($temp_val * 9.0 / 5.0) + 32);
    }
    return $temp_val;
  }

  public function get_option_name() {
    return $this->option_name;
  }

  public function uninstall_plugin() {
    delete_option($this->option_name);
  }
}

