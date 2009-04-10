<?php
/*
Plugin Name: Upgrade IE
Plugin URI: http://wordpress.org/extend/plugins/upgrade-ie/
Description: Notify IE users to upgrade their browser.
Version: 1.0.3
Author: Matt Gibbs
Author URI: http://wordpress.org/extend/plugins/upgrade-ie/

Copyright 2009  Matt Gibbs  (email : logikal16@gmail.com)

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
    $uie_label = get_option('uie_label');
    if (empty($uie_label))
    {
        $uie_label = 'This site looks a lot better on an upgraded browser. <a href="http://browsehappy.com/" target="blank">How do I upgrade?</a>';
    }
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

#uIE #hide {
    float: right;
    cursor: pointer;
    margin-right: 10px;
}

#uIE img {
    vertical-align: middle;
}
</style>
<div id="uIE">
    <div id="hover">
        <img src="/wp-content/plugins/upgrade-ie/close.gif" alt="close" id="hide" onclick="createCookie()" />
        <img src="/wp-content/plugins/upgrade-ie/alert.gif" alt="alert" />
        <?php echo $uie_label; ?>
    </div>
    <div style="height:10px"><!--clear--></div>
</div>
<?php
    }
}

function uIE_menu_page()
{
?>
<div class="wrap">
    <h2>Upgrade IE</h2>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Alert Label</th>
                <td>
                    <input type="text" name="uie_label" value="<?php echo get_option('uie_label'); ?>" />
                </td>
            </tr>
        </table>
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="uie_label" />
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>
<?php
}

add_action('wp_head', 'show_banner');
add_action('admin_menu', 'uIE_menu');

function uIE_menu()
{
    add_management_page('Upgrade IE', 'Upgrade IE', 8, 'upgrade-ie', 'uIE_menu_page');
}
