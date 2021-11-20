<?php

global $ssbm_api_path;
include_once $ssbm_api_path;
use ShowSwitchBotMeter\SsbmSwitchBotApi;

$api = new SsbmSwitchBotApi($this->settings->get_app_token());
$deviceId = $param->get_param('key');
$stat = $api->get_device_status($deviceId);
$obj = json_decode($stat, true);

// '1' : fahrenheit
$temp_unit = $this->settings->get_temperature_unit();
// fahrenheit or celsius
$temp_val = $this->settings->get_temperature_in_current_unit($obj['body']['temperature']);

if ($obj['body']['temperature'] == null || $obj['body']['humidity'] == null) {
  return [
    'status'  => 'error',
  ];
} else {
  return [
    'status'        => 'ok',
    'temperature'   => '' . $temp_val,
    'unit'          => '' . $temp_unit,
    'humidity'      => '' . $obj['body']['humidity'],
  ];
}
?>
