<?php
header("Content-type: text/css");
require_once("browser.php");
$browser = new Browser();
switch($browser->getBrowser())
{
	case Browser::BROWSER_FIREFOX:	$font = ".woff"; $fonttype="woff";
	break;
	case Browser::BROWSER_CHROME:	$font = ".svg";	$fonttype="svg";
	break;
	case Browser::BROWSER_IE:	$font = ".eot"; $fonttype="embedded-opentype";
	break;
	default:	$font = ".ttf"; $fonttype="truetype";
	break;
}
$Lato_weights = array("bold","normal","italic","light");
$UI_weights = array("normal");
foreach($Lato_weights as $w)
{
if($w=="normal") $fw = "regular";
else $fw = $w;
if($font==".svg") $fontre = $font."#lato".$fw;
else $fontre = $font;
echo "
@font-face {
  font-family: 'Lato';
  src: url('lato/lato-".$fw."-webfont".$fontre."') format('".$fonttype."');";
if($font==".eot") echo "src: url('lato/lato".$w."-webfont.eot?#iefix') format('".$fonttype."');";
if($w=="italic")
echo "font-weight: normal;
  font-style: ".$w.";
}";
else if($w=="light")
echo "font-weight: 300;
  font-style: normal;
}";
else
echo "font-weight: ".$w.";
  font-style: normal;
}";
}
?>
