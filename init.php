<?php
/*
Plugin Name: Upgrade IE
Plugin URI: http://uproot.us/
Description: Get your users to ditch IE!
Version: 1.0.0
Author: Matt Gibbs
Author URI: http://uproot.us/

Copyright 2008  Matt Gibbs  (email : logikal16@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function show_banner()
{
    $cookie = $_COOKIE['hideAlert'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (empty($cookie) &&
        (false !== strpos($browser, 'MSIE 5') || false !== strpos($browser, 'MSIE 6')))
    {
?>
<script type="text/javascript">
function createCookie() {
    var hours = 12;
    var date = new Date();
    date.setTime(date.getTime()+(hours*3600000));
    document.cookie = "hideAlert=1; expires="+date.toGMTString()+"; path=/";
    jQuery("#uIE").fadeOut();
}
</script>
<style type="text/css">
#uIE #hover {
    top: 0;
    width: 100%;
    height: 24px;
    position: absolute;
    text-align: center;
    background: #FFFFC8;
}

#uIE img {
    vertical-align: middle;
}
</style>
<div id="uIE">
    <div id="hover">
        <div style="float:right; padding-right:10px"><a href="#" onclick="createCookie()">hide</a></div>
        <img src="/wp-content/plugins/upgrade-IE/booey.png" alt="booey" />
        This site looks a lot better on an upgraded browser. <a href="http://browsehappy.com/" target="blank">How do I upgrade?</a>
    </div>
    <div style="height:10px"><!--clear--></div>
</div>
<?php
    }
}

// Hook for displaying the banner
add_action('wp_head', 'show_banner');

