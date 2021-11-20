<?php

namespace ShowSwitchBotMeter;

class SsbmSettingsAdminInit
{
  protected $settings;

  // This page will be under "Settings"
  public function __construct($settings) {

    $this->settings = $settings;

    register_setting(
      'sbm_option_group', // Option group
      $settings->get_option_name(), // Option name
      array($this, 'sanitize') // Sanitize
    );

    add_settings_section(
      'setting_section_id', // ID
      __('Show SwitchBot Meter Settings', "show-switchbot-meter"),
      array($this, 'print_section_info'), // Callback
      'sbm_setting_admin' // Page
    );

    add_settings_field(
      'app_token', // ID
      'Application Token', // Title 
      array($this, 'app_token_callback'), // Callback
      'sbm_setting_admin', // Page
      'setting_section_id' // Section           
    );

    add_settings_field(
      'temperature_unit', // ID
      'Temperature Unit', // Title 
      array($this, 'temperature_unit_callback'), // Callback
      'sbm_setting_admin', // Page
      'setting_section_id' // Section  
    );
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function sanitize($input)
  {
    $new_input = array();
    if (isset($input['app_token']))
      $new_input['app_token'] = sanitize_text_field($input['app_token']);

    if (isset($input['temperature_unit'])) {
      $new_input['temperature_unit'] = (strcmp($input['temperature_unit'], '1') == 0) ? '1' : '0';
    }

    return $new_input;
  }

  /** 
   * Print the Section text
   */
  public function print_section_info()
  {
    $token = $this->settings->get_app_token();
    ($token == "") && $this->render_description_for_switchbot_token();
  }

  private function render_description_for_switchbot_token()
  {
    echo '<div class="notice notice-info"><p>';
    
    _e("<div>As first step, setup is required with <em>SwitchBot Application Token</em>.</div><br>", "show-switchbot-meter");
    _e("<div>To obtain your own <em>Application token</em>, please execute following steps:</div>", "show-switchbot-meter");

    echo '<ol>';
    _e("<li> the SwitchBot app on App Store or Google Play Store </li>", "show-switchbot-meter"); 
    _e("<li> Register a SwitchBot account and log in into your account</li>", "show-switchbot-meter");
    _e("<li> Generate an Application Token within the app a) Go to Profile > Preference b) Tap App Version 10 times. Developer Options will show up c) Tap Developer Options d) Tap Get Token</li>", "show-switchbot-meter");
    _e("<li> Enter the token to below text box and click save button.</li>", "show-switchbot-meter");
    echo '</ol>';
    echo '<div>';
    _e("For more details, visit SwitchBot official <a target='_blank' href='https://github.com/OpenWonderLabs/SwitchBotAPI'>Github site. </a>", "show-switchbot-meter");
    echo '</div>';
    _e("<div>Once setup is completed successfully, shortcodes are listed on this screen.</div>", "show-switchbot-meter");

    echo '</p></div>'; // class=notice
  }

  /** 
   * Get the settings option array and print one of its values
   */
  public function app_token_callback()
  {
    $option_name = $this->settings->get_option_name();
    $app_token = $this->settings->get_app_token();
    printf(
      '<input type="text" id="app_token" name="%s[app_token]" value="%s" size="100" />',
      esc_attr($option_name),
      ($app_token != "") ? esc_attr($app_token) : ''
    );
  }

  public function temperature_unit_callback() {
    $option_name = $this->settings->get_option_name();
    $temp_unit = $this->settings->get_temperature_unit();
    printf(
      '<select name="%s[temperature_unit]">
        <option value="0" %s> &#x2103; </option>
        <option value="1" %s> &#x2109; </option>
      </select>',
      esc_attr($option_name),
      ($temp_unit != "1") ? 'selected' : '',
      ($temp_unit == "1") ? 'selected' : ''
    );
  }

}

$ssbm_settings_admin_menu = new SsbmSettingsAdminInit($this); // $this need to be SsbmSettings instance
