<?php

/*** configurations ***/
$defaultImageType = "1";
$widgetDir = "../widgets/";
$svgFilename = "/sb-image.svg";


/** parameters **/
$deviceId = ($attr != "") ? $attr['deviceid'] : "";

if ($deviceId == null || $deviceId == "") {
  return  __("<div class='ssbm-error-message'>'deviceId' parameter is required</div>", "show-switchbot-meter");
}

/** determine image type **/
$imageType = ($attr != "") ? $attr['type'] : "";
if ($imageType == null || $imageType == "") {
  $imageType = $defaultImageType;
}

/** check folder: if it doesn't exist, fallback to default path **/
$imageType = (file_exists(dirname(__FILE__) . '/' . $widgetDir . $imageType . $svgFilename)) ? $imageType : $defaultImageType;

/** contract url for svg file **/
$svg_script_path  = plugin_dir_url(__FILE__) . $widgetDir . $imageType . $svgFilename;

return "<object type='image/svg+xml' data='" . esc_url($svg_script_path)
  . "' deviceid='" . esc_attr($deviceId) . "' " 
  . " width=640 height=360></object>";

