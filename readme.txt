=== Show Temperature for SwitchBot Meter ===
Contributors: shizukanakazushi
Tags: temperature, humidity, SwitchBot, meter
Requires at least: 5.0
Tested up to: 5.9
Stable tag: 1.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Don't you want to know temperature from remote?
You can achieve with this plugin, Show Temprature for SwtichBot Meter. It shows temperature and humidity.

== Description ==

This plugin shows temperature and humidity on your WordPress site. The temperature and humidity is remotely detected by [SwitchBot Meter](https://www.switch-bot.com/collections/accessories/products/switchbot-meter).

SwitchBot Meter is small IoT gadget that has ability to send date to smartphone through BlueTooth. So you can see temperature and humidity with SwitchBot App on smartphone without seeing small LCD display on the device directly. And if you have [SwitchBot Hub Mini](https://www.switch-bot.com/products/switchbot-hub-mini) addition to Meter, it's available even outside of your home through their cloud service.

Thanks to SwitchBot service, this plugin allows you to embed temperature and humidity in WordPress content by Shortcode.

Notice that you need SwitchBot account which can be registered by SwitchBot app for Android and iOS. 

== Features ==
* insert temperature and humidity by Shortcode
* insert 'Switchbot Meter image' with temperature and humidity by Shortcode
* change temperature unit between celsius and fahrenheit

== Shortcode examples ==

* temperature value: `[ssbm-temperature deviceid='8090A0B0C0E0']`
* humidity value: `[ssbm-humidity deviceid='8090A0B0C0E0']`
* embeded image: `[ssbm-image deviceid='8090A0B0C0E0' type='2']`

== Installation ==

In order to use this plugin, you need "account" for SwitchBot app and do below steps to obtain "Application Token" on SwitchBot app.

1. Go to Profile > Preference 
2. Tap App Version 10 times. Developer Options will show up Tap Developer Options
3. Tap Get Token

Once you get Token, set it on plugin settings page to complete setup.

== Frequently Asked Questions ==

== Screenshots ==
1. SwitchBot image with CURRENT temperature
2. Config page to input App Token
3. Config page for shortcode


== Changelog ==

= 1.1 =
New image type #5 is added.

= 1.0 =
The first version of "Show Temperature for SwitchBot Meter" plugin.

