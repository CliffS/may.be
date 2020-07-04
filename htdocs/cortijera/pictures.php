<?php

$pic = isset($_GET['pic']) ? $_GET['pic'] : 0;

$pics = get_pics();
do_top();
display($pics, $pic);

function display($pics, $view)
{
    $src = $pics[$view];
    $me = $_SERVER['PHP_SELF'];
    echo <<<html
<h1>Chalet 2, La Cortijera, Mijas Costa</h1>
<div class="big">
<img src="images/$src" width="640" height="450">
</div>
<table class="thumb" width="800px" align="center">
html;
    $count = 0;
    $_tr = "";
    foreach ($pics as $pic)
    {
	if ($count == 6 or $count == 7)
	{
	    echo <<<html
$_tr
<tr>
html;
	    $_tr = "</tr>";
	}
	$span = $count == 6 ? " colspan='6'" : "";
	echo <<<html
<td$span><a href="$me?pic=$count"><img src="images/thumbs/$pic" width="119" height="90"></a></td>
html;
	$count++;
    }
    echo <<<html
</tr>
</table>
</div>
html;
}

function get_pics()
{
    $pics = array(
	"housefront.jpg",
	"diningarea.jpg",
	"lounge.jpg",
	"lounge2.jpg",
	"fireplace.jpg",
	"kitchen.jpg",
	"pool.jpg",
	"stairway.jpg",
	"bedroom1.jpg",
	"ensuite.jpg",
	"bedroom2.jpg",
	"bedroom3.jpg",
	"bathroom.jpg",
    );
    return $pics;
}

function do_top()
{
    echo <<<html
<html>
<head>
<title>La Cortijera</title>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3038629-3";
urchinTracker();
</script>
</head>
<body>
<style>
body {
    font-family : Arial,Helvetica,sans-serif;
    font-size : small;
    color : green;
}
h1 {
    font-size : larger;
    padding : 1em
}
.big {
    text-align : center;
    padding-bottom : 4em;
}
.thumb  td {
    text-align : center;
    padding-bottom : 10px;
}
img {
    border : 3px outset black;
}
</style>
html;
}

