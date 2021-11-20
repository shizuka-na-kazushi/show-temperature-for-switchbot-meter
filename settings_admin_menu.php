<?php

namespace ShowSwitchBotMeter;

class SsbmSettingsAdminMenu
{
  protected $settings;

  // This page will be under "Settings"
  public function __construct($settings) {

    $this->settings = $settings;

    add_options_page(
      __('SwitchBot API Setting', 'show-switchbot-meter'), 
      'Show SwitchBot Meter', 
      'manage_options',
      'sbm_setting_admin',
      array($this, 'create_admin_page')
    );
  }

  private function setup_js_and_css() {
    wp_enqueue_style('ssbmscript', plugins_url('css/ssbm.css', __FILE__));
    wp_enqueue_script('ssbmscript', plugins_url('js/ssbm.js', __FILE__));
  }

  /**
   * Options page callback
   */
  public function create_admin_page()
  {
    // setup (enqueue) JS/CSS 
    $this->setup_js_and_css();

    // Set class property
    $token = $this->settings->get_app_token();
?>
    <div class="wrap">
      <form method="post" action="options.php">
        <?php

        settings_fields('sbm_option_group');

        if ($token != "") {
          $this->render_detail_desc();
        }
        
        do_settings_sections('sbm_setting_admin');
        submit_button();

        if ($token != "") {
          $this->developer_info();
        }
        ?>
      </form>
    </div>
<?php
  }

  private function render_detail_desc() {
    global $ssbm_api_path;
    include_once $ssbm_api_path;
    
    $api = new SsbmSwitchBotApi($this->settings->get_app_token());
    $devices = $api->get_devices();
    $obj = json_decode($devices, true);

    if ($devices === false) {
      _e('<div class="notice notice-error"><p>Error occurs : no device found.<p></div>', "show-switchbot-meter");
    } else if ($obj['message'] && $obj['message'] != 'success') {
      $this->render_server_error($obj);
    } else {
      $this->render_devices($obj);
      $this->render_thumbs();
    } 
  }

  private function render_server_error($obj) {
    printf(
      __('<div class="notice notice-error"><p>Error occurs (message: "%s"). Check whether token is correct.</p></div>', "show-switchbot-meter"),
      esc_html($obj['message']));
  }

  private function render_devices($obj) 
  {
    _e("<h2>Available Switchbot Meter Devices</h2>", "show-switchbot-meter");
    echo '<table class="wp-list-table widefat fixed striped">';
    _e('<thead><tr><th>Device name</th><th>Device ID</th><th width="50%">Shortcode</th></tr></thead>', "show-switchbot-meter");

    echo '<tbody>';
    foreach($obj['body']['deviceList'] as $d) {
      if ($d['deviceType'] == 'Meter') {
        echo '<tr>';
        printf("<td>%s</td>", esc_html($d['deviceName']));
        printf("<td>%s</td>", esc_html($d['deviceId']));
        echo "<td>";
        {
          _e("<span class='ssbm-shortcode-type-desc'>Temperature: </span>", "show-switchbot-meter");
          echo "<code>[ssbm-temperature deviceid='" . esc_html($d['deviceId']) . "'] </code><br>";
          _e("<span class='ssbm-shortcode-type-desc'>Humidity: </span>", "show-switchbot-meter");
          echo "<code>[ssbm-humidity deviceid='" . esc_html($d['deviceId']) . "']</code><br>";
          _e("<span class='ssbm-shortcode-type-desc'>Image: </span>", "show-switchbot-meter");
          echo "<code>[ssbm-image deviceid='" . esc_html($d['deviceId']). "' <span class='ssbm-image-type'></span>]</code><br>";
        }
        echo "</td>";
        echo '</tr>';
      }
    }
    echo '</tbody>';
    echo '</table>';
  }

  private function render_thumbs() {
    echo '<p>';
    _e("<h3>Embedded Image Types</h3>", "show-switchbot-meter");
    _e('<div class"switchbot-meter-thumgs-desc"> You can use images below by specifying "type" field in shortcode "ssbm-image".</div><br>', "show-switchbot-meter");
    echo '<div class="switchbot-meter-thumbs">';
    echo '<fieldset>';
    $widget_dirs = scandir (dirname(__FILE__) . '/widgets');
    foreach($widget_dirs as $idx => $dir) {
      $thumb_file_name = dirname(__FILE__) . "/widgets/" . $dir . '/sb-image-thumb-128.jpg';
      if (file_exists($thumb_file_name)) {
        $thumb_url = plugin_dir_url(__FILE__) . 'widgets/' . $dir . '/sb-image-thumb-128.jpg';
        printf('<input type="radio" value="%s" id="thumb-id-%s" name="switchbot-meter-thumb-radio"', esc_attr($dir), esc_attr($dir));
        printf('<label for="thumb-id-%s">', esc_html($idx));
        printf('Type %s <img class="ssbm-thumb-img" height="64" src="%s">', esc_html($dir), esc_url($thumb_url));
        printf('</label>');
        printf('</input><br>');
      }
    }
    echo '</fieldset>';
    echo '</div>';
    echo '</p><br><br>';
  }

  private function developer_info() {
    echo '<div class="ssbm-dev-info">';
      echo '<input type="checkbox" id="dev-info-check1" class="accordion-hidden">';

        echo '<label for="dev-info-check1" class="accordion-open">';
          _e('<h4> For developers..., </h4>', "show-switchbot-meter");
        echo '</label>';

        echo '<label for="dev-info-check1" class="accordion-close">';
          echo '<div>';
          _e('This plugin exports REST API endpoint <code> /wp-json/show-switchbot-meter/v1/{deviceId}</code> . <br>', "show-switchbot-meter");
          _e('{deviceId} is available in device list above.<br><br>', "show-switchbot-meter");
          _e('It will return temperature and humidity info from specific device in JSON format, something like below:</br>', "show-switchbot-meter");
          echo '<br>';
          echo '<code>{"status":"ok","temperature":"78.44","unit":"1","humidity":"50"}</code>';
          echo '<br><br>';
          _e('"unit" attribute represents temperature unit, and "0" is for celsius, "1" is for fahrenheit.', "show-switchbot-meter");
          echo '</div>';
        echo '</label';

      echo '</input>';
    echo '</div>';
  }
}

$ssbm_settings_admin_menu = new SsbmSettingsAdminMenu($this); // $this need to be SsbmSettings instance
