<?php defined('ABSPATH') OR exit('No direct script access allowed');
/**
* Plugin Name:       WP Forex Analysis
* Plugin URI:        https://www.upwork.com/freelancers/~01bf696fab6c7c2afe
* Description:       This plugin will display Forex Trading Analysis cart using shortcode. Example shortcode is like  [fxchart var="EURUSD" theme="dark" height="455" width="125%"]   or you can simple use [fxchart var="EURUSD" ] where var= currency conversion name, height = chrat height, width= chart width, theme = background color (dark or light).
* Version:           1.0.0
* Requires at least: 5.6
* Requires PHP:      7.4
* Author:            Md Nazmul Haque
* Author URI:        https://www.upwork.com/freelancers/~01bf696fab6c7c2afe
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:       wp-forex-analysis
*/
function wp_forex_analysis_cb( $atts, $content = null ) {
$a = shortcode_atts( array(
'var' => 'USDCAD',
'height' => '380',
'width' => '100%',
'theme' => 'dark',
'tab' => 'false',

), $atts );
$currencyName = $a['var'];
$height = $a['height'];
$width = $a['width'];
$theme = $a['theme'];
$tab = $a['tab'];

$output ='
<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js">
{
"interval": "1m",
"width": "'.$width.'",
"isTransparent": false,
"height": "'.$height.'",
"symbol": "FX:'.$currencyName.'",
"showIntervalTabs": '.$tab.',
"locale": "en",
"colorTheme": "'.$theme.'",
"largeChartUrl": "https://tradingfundclub.com/trade-view"
}

</script>
<script>

function update() {
  $.get("response.php", function(data) {
    $("#widget-technical-analysis-container").html(data);
    window.setTimeout(update, 1000);
  });}
</script>
';
return $output;
}
add_shortcode( 'fxchart', 'wp_forex_analysis_cb' );




// market data Shortcode

function wp_forex_marketdata_cb( $atts, $content = null ) {
$a = shortcode_atts( array(
'var' => 'USDCAD',
'height' => '100%',
'width' => '100%',
'theme' => 'light',

), $atts );
$currencyName = $a['var'];
$height = $a['height'];
$width = $a['width'];
$theme = $a['theme'];

$output ='
<div class="tradingview-widget-container__widget"></div>
 <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
  {
 "symbol": "FX:'.$currencyName.'",
  "width": "'.$width.'",
  "height": "'.$height.'",
  "locale": "en",
  "dateRange": "1D",
  "colorTheme": "'.$theme.'",
   "trendLineColor": "rgba(41, 98, 255, 1)",
  "underLineColor": "rgba(41, 98, 255, 0.3)",
  "underLineBottomColor": "rgba(41, 98, 255, 0)",
  "isTransparent": false,
  "autosize": true,
  "largeChartUrl": "https://tradingfundclub.com/trade-view"
}
</script>
';
return $output;
}
add_shortcode( 'fxmarketdata', 'wp_forex_marketdata_cb' );