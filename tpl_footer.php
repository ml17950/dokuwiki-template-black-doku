<?php
/**
 * Template footer, included in the main and detail files
 * 
 * last change	2019.07.02
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

echo "<!-- ********** TPL_FOOTER ********** -->\n";
echo "<div class='theme-footer'>";

echo "<div class='theme-pagetools'>";
echo "<h3>",$lang['page_tools'],"</h3>";
echo "<ul>";
echo "<li><a href='doku.php?id=start&do=recent'>",$lang['btn_recent'],"</a></li>";
echo "<li><a href='doku.php?id=start&do=index'>Sitemap</a></li>";
echo (new \dokuwiki\Menu\PageMenu())->getListItems('', false); // Parameter: $classprefix = '', $svg = true
if (!empty($_SERVER['REMOTE_USER'])) {
	if ($auth instanceof auth_plugin_authplain) {
		//User Profile link
		echo "<li><a href='doku.php?id=user:admin:start&amp;do=profile'>",$lang['btn_profile'],"</a></li>";
	}
	// MediaManager
	if ($INFO['isadmin'])
		echo "<li><a href='doku.php?id=",$ID,"&do=media&ns=",$INFO['namespace'],"'>",$lang['btn_media'],"</a></li>";
	//Admin tools button
	if ($INFO['isadmin'])
		echo "<li><a href='doku.php?do=admin&id=user%3Aadmin%3Astart'>",$lang['btn_admin'],"</a></li>";
	//Logout Button
	echo "<li><a href='doku.php?id=start&amp;do=logout'>",$lang['btn_logout'],"</a></li>";
}
if (empty($_SERVER['REMOTE_USER'])) {
	//Login Button
	echo "<li><a href='doku.php?do=login&amp;sectok=&amp;id=start'>",$lang['btn_login'],"</a></li>";
}
echo "</ul>";
echo "</div>\n"; // .theme-pagetools

echo "<div class='theme-buttons-and-licence'>";
echo " <a href='https://www.dokuwiki.org/donate' title='Donate' ",$target,"><img src='",tpl_basedir(),"images/button-donate.gif' width='80' height='15' alt='Donate' /></a>";
echo " <a href='https://php.net' title='Powered by PHP' ",$target,"><img src='",tpl_basedir(),"images/button-php.gif' width='80' height='15' alt='Powered by PHP' /></a>";
echo " <a href='//validator.w3.org/check/referer' title='Valid HTML5' ",$target,"><img src='",tpl_basedir(),"images/button-html5.png' width='80' height='15' alt='Valid HTML5' /></a>";
echo " <a href='//jigsaw.w3.org/css-validator/check/referer?profile=css3' title='Valid CSS' ",$target,"><img src='",tpl_basedir(),"images/button-css.png' width='80' height='15' alt='Valid CSS' /></a>";
echo " <a href='https://dokuwiki.org/' title='Driven by DokuWiki' ",$target,"><img src='",tpl_basedir(),"images/button-dw.png' width='80' height='15' alt='Driven by DokuWiki' /></a>";
echo " <br>",tpl_license('', false, true, false);
echo "</div>\n"; // .theme-buttons

echo "<div class='theme-sub-footer'>";
tpl_include_page('footer', true, true);
echo "</div>\n";

echo "</div>\n";