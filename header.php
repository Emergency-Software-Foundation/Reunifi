<?php
session_start();
include("db.php");
	
function topbar($pageName, $pathToRoot $loginrequired = false) {
	echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    ";
	echo "<title>".$pageName." | ReUnifi</title>";
	echo "</head><body><div class=\"page\">";
	include("db.php");
	$loggedin = true;
	if ((!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"])) {
		if ($loginrequired) {
			die("<script>location.href = 'login.php?error=notlogged'</script>");
		} else {
			$loggedin = false;
		}
	}

	$pages = array("Home"=>".");
	if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) {
		$pages["All Cases"] = "managecases.php";
	}
	echo "<div id = \"navbar\"><img id = \"logo\" href = \"#\" src=\"...\" alt=\"Page logo\"><div id = \"navmenu\"><ul>";
	foreach($pages as $page => $link) {
		if ($page == $pageName) {
			echo "<li><a class=\"navMenuItem\" id=\"navMenuSelected\" href=\"".$pathToRoot.$link."\">".$page."</a></li>";
		} else {
			echo "<li><a class=\"navMenuItem\" href=\"".$pathToRoot.$link."\">".$page."</a></li>";
		}
	}
	if ($loggedin) {
		echo "<li><a class=\"navMenuItem\" id=\"logout\" href=\"".$pathToRoot."logout.php\">Logout</a></li>";
	} else {
		echo "<li><a class=\"navMenuItem\" id=\"logout\" href=\"".$pathToRoot."login.php\">Log In</a></li>";
	}
	echo "</ul></div></div>";
}

function footer() {
	echo "</div></div></body></html>";
}

function polyfill() {
	if (!function_exists('str_starts_with')) {
		function str_starts_with($haystack, $needle) {
			return (string)$needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0;
		}
	}
	if (!function_exists('str_ends_with')) {
		function str_ends_with($haystack, $needle) {
			return $needle !== '' && substr($haystack, -strlen($needle)) === (string)$needle;
		}
	}
	if (!function_exists('str_contains')) {
		function str_contains($haystack, $needle) {
			return $needle !== '' && mb_strpos($haystack, $needle) !== false;
		}
	}
}
?>