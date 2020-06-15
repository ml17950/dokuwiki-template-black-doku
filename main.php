<?php
/**
 * Black-Doku Template
 * 
 * last change	2020.06.15
 *
 * @link		http://wiki.andev.de/doku.php/projekte:black-doku
 * @author		M. Lindner <martin@andev.de>
 * @license		GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
header('X-UA-Compatible: IE=edge');

$hasSidebar		= page_findnearest($conf['sidebar']);
$showSidebar	= $hasSidebar && ($ACT=='show');

echo "<!DOCTYPE html>\n";
echo "<html lang='",$conf['lang'],"' dir='",$lang['direction'],"' class='no-js'>\n";
echo "<head>\n";
echo "<meta charset='utf-8' />\n";
echo "<meta name='viewport' content='width=device-width,initial-scale=1' />\n";
echo "<title>",tpl_pagetitle(null, true)," [",strip_tags($conf['title']),"]</title>\n";
// echo "<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>\n";
tpl_metaheaders(); // TODO
echo tpl_favicon(array('favicon', 'mobile'));
////tpl_includeFile('meta.html');
echo "<script async src='",tpl_basedir(),"theme.js'></script>\n";
echo "<link rel='stylesheet' href='",tpl_basedir(),"style.css' />\n";
// echo "<link rel='stylesheet' href='",tpl_basedir(),"css/print.css' media='print' />\n";
// https://cdn.byu.edu/byu-theme-components/1.x.x/byu-theme-components.min.js
// https://cdn.byu.edu/byu-theme-components/1.x.x/byu-theme-components.min.css
echo "</head>\n";
echo "<body>\n";

// get logo either out of the template images folder or data/media folder
$logoSize = array();
$logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);

echo "<div class='theme-page' id='dokuwiki__top'>";

echo "<div class='theme-header'>";
echo "<div class='theme-header-logo'><a href='",wl(),"' title='",$conf['title'],"'><img src='",$logo,"' alt='logo' width='64' height='64'></a></div>\n";
echo "<div class='theme-header-title'>",tpl_link(wl(),$conf['title'],'', true),"</div>\n";
echo "<div class='theme-header-search'>";
tpl_searchform(true, false);
echo "</div>\n";
echo "</div>\n"; // .theme-header

if ($conf['youarehere'] > 0) {
	echo "<div class='theme-youarehere'>",tpl_youarehere(null, true);
// 	if (!empty($_SERVER['REMOTE_USER']) && ($INFO['isadmin']))
// 		echo " <span style='font-size: 8pt'>(<a href='doku.php?do=admin&id=user%3Aadmin%3Astart'>",$lang['btn_admin'],"</a>)</span>";
	if ($INFO['editable'] == 1) {
		if ($INFO['exists'] == 1)
			echo " <span style='font-size: 8pt'>(<a href='",wl($ID, 'do=edit'),"'>",$lang['btn_secedit'],"</a>)</span>";
		else
			echo " <span style='font-size: 8pt'>(<a href='",wl($ID, 'do=edit'),"'>",$lang['btn_create'],"</a>)</span>";
	}
	echo "</div>\n";
}
if ($conf['breadcrumbs'] > 0) {
	echo "<div class='theme-breadcrumb'>",tpl_breadcrumbs(null, true),"</div>\n";
}

if ($showSidebar) {
	echo "<div class='theme-sidebar-left'>";
	echo "<!-- sidebar start -->\n";
	echo "<h3>Navigation</h3>";
// 	tpl_includeFile('sidebarheader.html');
	tpl_include_page($conf['sidebar'], true, true);
// 	tpl_includeFile('sidebarfooter.html');
	echo "<!-- sidebar stop -->\n";
	echo "</div>\n";
}

// echo "<div class='theme-hsc'>",hsc($ID),"</div>\n";

echo "<div class='theme-content'>";

echo "<div class='theme-messages'>",html_msgarea(),"</div>\n";

echo "<div class='theme-main'>";
// tpl_includeFile('pageheader.html');
echo "<!-- wikipage start -->\n";
tpl_content(false);
echo "<!-- wikipage stop -->\n";
// tpl_includeFile('pagefooter.html');
echo "</div>\n"; // .theme-main

echo "<div class='theme-pageinfo'>",tpl_pageinfo(true),"</div>\n";

// ===== DEBUG =====
// echo $ID,"<hr>";
// echo "doku.php?id=",hsc($ID),"&do=edit<hr>";
// echo wl($ID, 'do=edit'),"<hr>";
 //echo highlight_string(print_r($INFO, true));
// echo highlight_string(print_r($conf, true));
//echo getNS(cleanID(getID())),"<hr>";
// ===== DEBUG =====

echo "</div>\n"; // .theme-content

echo "<div class='theme-sidebar-right'>",tpl_toc(true),"</div>";

include('tpl_footer.php');

echo "</div>\n"; // .theme-page

/* provide DokuWiki housekeeping, required in all templates */
echo "<div class='no' style='display: none;'>";
tpl_indexerWebBug();
echo "</div>\n";

/* helper to detect CSS media query in script.js */
echo "<div id='screen__mode' class='no'></div>\n";

echo "</body>\n";
echo "</html>";
/*
function theme_list_pages($path, $level) {
// 	$pagearr = array();
	echo "<hr><b>",$path," [",$level,"]</b><br><br>";
	$files = @glob($path.'/*');
	if (count($files) > 0) {
		ksort($files);
		foreach ($files as $file) {
			if (is_dir($file)) {
				$levelid = basename($file);
// 				echo $file," = dir [",$level,$levelid,"]<br>";
				theme_list_pages($file, $level.$levelid.':');
			}
			else {
				$pageid = substr(basename($file), 0, -4);
// 				echo $file," = page [",$pageid,"]<br>";
				echo "((",tpl_pagelink($level.$pageid, null, true),")) ";
// 				$pagearr[$level][] = basename($file);
			}
		}
	}
// 	return $pagearr;
}

// echo highlight_string(print_r($conf, true));
// echo highlight_string(print_r($ID, true));
echo "<hr>",$conf['datadir'];
// theme_list_pages($conf['datadir'], ':');
// echo highlight_string(print_r($pages, true));
// echo "<hr>",$conf['start'];
// echo tpl_pagelink(':'.$conf['start'], null, true);

function theme_search($x) {
}

    $data = array();
//     search($data,$conf['datadir'],'search_index',array('ns' => ':'));
//     search($data,$conf['datadir'].'/hardware','search_index',array('ns' => ':'));
	search($data,$conf['datadir'],theme_search,null,'',10);
    echo highlight_string(print_r($data, true));
*/