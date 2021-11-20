<?php

global $ssbm_api_path;
include_once $ssbm_api_path;
use ShowSwitchBotMeter\SsbmSwitchBotApi;

$deviceId = ($attr != "") ? $attr['deviceid'] : "";

if ($deviceId == null || $deviceId == "") {
  return  __("<div class='ssbm-error-message'>'deviceId' parameter is required</div>", "show-switchbot-meter");
}

$obj = null;

// check cache: cache might be valid if shortcode is called multiple times.
if (!array_key_exists($deviceId, $this->cache)) {
  $api = new SsbmSwitchBotApi($this->settings->get_app_token());
  $stat = $api->get_device_status($deviceId);
  $obj = json_decode($stat, true);
  if (($stat === false) || (($obj['message'] && $obj['message'] != 'success'))) {
    return "--";
  }
  $this->cache[$deviceId] = $obj;
} else {
  $obj = $this->cache[$deviceId];
}

//  var_dump($obj);

// fahrenheit or celsius
$temp_val = $this->settings->get_temperature_in_current_unit($obj['body']['temperature']);

return "<span class='switchbot-meter-temperature'>" 
  . esc_html($temp_val) . "</span>";
