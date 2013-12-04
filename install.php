<?php

//------------------------------------------------------------------------------//
//  Nuked-KlaN - PHP Portal							//
//  http://www.nuked-klan.org							//
//------------------------------------------------------------------------------//
//  This program is free software. you can redistribute it and/or modify	//
//  it under the terms of the GNU General Public License as published by	//
//  the Free Software Foundation; either version 2 of the License.        	//
//------------------------------------------------------------------------------//

define("INDEX_CHECK", 1);

if (is_file('globals.php')) include ("globals.php");
else die('<br /><br /><div style=\"text-align: center;\"><b>install.php must be near globals.php</b></div>');
if (is_file('conf.inc.php')) include ("conf.inc.php");
else die('<br /><br /><div style=\"text-align: center;\"><b>install.php must be near conf.inc.php</b></div>');
if (is_file('nuked.php')) include('nuked.php');
else die('<br /><br /><div style=\"text-align: center;\"><b>install.php must be near nuked.php</b></div>');

function top() {
	global $nuked;

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    	<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>' . $nuked['name'] . ' - Installation</title>
        <link rel="stylesheet" href="modules/Admin/css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="modules/Admin/css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="modules/Admin/css/invalid.css" type="text/css" media="screen" />
        <style type="text/css">
        .css3button {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #050505;
	padding: 5px 20px;
	background: -moz-linear-gradient(top,#ffffff 0%,#c7d95f 50%,#add136 50%,#6d8000);
	background: -webkit-gradient(linear, left top, left bottom,from(#ffffff),color-stop(0.50, #c7d95f),color-stop(0.50, #add136),to(#6d8000));
	border-radius: 12px;
	-moz-border-radius: 12px;
	-webkit-border-radius: 12px;
	border: 1px solid #6d8000;
	-moz-box-shadow:0px 1px 3px rgba(000,000,000,0.5),inset 0px 0px 2px rgba(255,255,255,1);
	-webkit-box-shadow:0px 1px 3px rgba(000,000,000,0.5),inset 0px 0px 2px rgba(255,255,255,1);
	text-shadow:0px -1px 0px rgba(000,000,000,0.2),0px 1px 0px rgba(255,255,255,0.4);
	}
	.function_ok {
        background-image:url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAUCAYAAAB4d5a9AAAAB3RJTUUH3AcbFQ0hfzp18gAAAAlwSFlzAAALEgAACxIB0t1+/AAAAARnQU1BAACxjwv8YQUAAAPqSURBVHjarZXfaxxVFMfvj/m1m91uk911l6RsLEmJ1YeKWIX6oigiin9DHww+KP546UOxpiBUs6VQxIe+KOKDFErT5snEKq3W2DY1bFMKbSohTTY03cSkyf6a3b1zf3ju7G5YiyWL8cIwzNx7z+d8z/fcGYz+h3H0DLJ6EqmeWk3VPnh9MQevVOPyB94uID0aDaf6ox8bNnlNceT+tVQ9+f6r87/AlNcE0e0Avsn0x2PdoSErSD40LLKHmKifWuTFA2+Fc7fubsyVHiC+LcjRS/FQoqvjuOHgQWrgAKbYT1sIHIWo+xMx+8q1sZIunST/FfBkPHIYW+ggpsiWUHQuJWK8fgmpeju66Cuw1NSWGJs7FcInLnfvCobtAa8i3Jmb+Tun3svndSatgC8vJ+OhaOgYdfBB2G0JvVVIxLlCXk0htyRRpSzYwxW2AlM6Pt4s18k3evcGI/ZXpkMPGw59O9JlB5yYmJ6ZYLWmgYfA5FjPjiGYHyQGthXGSMIMAwB0Fqq4EpWLwltf5mMXvy98t7zgresG0BD82Vj3gLPD/Np0yMvUwhY2cBgM3J9IOQEa5JnZ66x2LJOMJeKhITD4XWKggIISSQXZQ3mqVci+JDRArN73Ri+efpie/sldgNiutol+9G1kp9MZ/BzkvwndQf1WIL5bJrXxsz17bGfgBXMuuTs0BM/vQAI+QGgFngIAKCj7Cth6jl8Y+WL1k5krtUWIUm60MTIq2IoGmOyjVSidKZGJCaJmo4YUBQJROtj3UvgAsdFzEmFLQfYKaiTBDAYA5moVUmzk+M9/jBSHs7fZcgPANs9JaF+H1xUhuxVRz0OGhu4UhZU/K/WdIBsM3gXPVMBb6Bzk+QogeNEvEVtb4ufPDa8duTtRnYdtxVaAD1n41eWJATJrR2gKEfyMH5hqgIbV77q9tMHQROBB3eRaRfmAjZwY//10IT0/uVmifwCah1H9+VutGE/haaeTdkPm/RCc1pXo1ZC9aijQ50ArAA/couBQovPXRorp2+OVOVhe+jdA64lXs1dZfmcvyTgRGlUU75M6PKjSoKYC3cxVVwMkK6yI8R9P5D+9Vzf5sYBHPyvy3lVWCCWNG6Ekfhph3KcaZeJgMocQzFXaZF5c5uM3zpaGAbCwFeBRiA/KTtUK4SfEhNNpxkDAU9xD1GPgASioliXL57xzF46vHclO8iysL6CWr227EL902SlRCvfSW1C6FLTsXg4QVlGstCp+yJwtpJem5P2Ggi0Bj4P4ihYnWT6SENdJ0HA5/IyKOXnm5mjp1Pwl3laJWsdWPy39gbMbF25kXm1XQbsQPUiLYn1kRLvBm+Nv/8Mbsh3nOvsAAAAASUVORK5CYII=\');
	width:25px;
	height:20px;
	display:inline-block;
	}
	.function_no {
        background-image:url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAUCAYAAABvVQZ0AAAAB3RJTUUH3AcbFQ04G1HdMgAAAAlwSFlzAAALEgAACxIB0t1+/AAAAARnQU1BAACxjwv8YQUAAAPaSURBVHjajVRdaBxVFD7n3vnZyc4mu23j1m2bVVOhFsRa+mAqSPPQIIiPvgiCwUDtU6koUtCIGAWhCqGIrwqCoFTikyQoViu0aG1t0m6iJbS0tUl263b/ZndmZ+69nru7U7bSBwfO3Dt3vvud77vnzCD0rh8BjK37cqMBgtrz261VWhJwn0vjsvu276qGYWPs4saNfhzXt0u7h92RnVveSpvG7BA3JqdyrvT82qULLQj7iS48kU8/NJp5P2Oy45tt86WXt6a8alRbWfS6OP7VbrAeTm15O8nZUZthxkBwbWT7H0+5nh/UFomwHSccTpozAxxftRgOGUgB+PQuJ1laWq8XbgJELG9kJ4RSR5RSDgUAhQHgPmCy6ddGtk0Rj/0CJU27zkyCq0NkxdYYKQkLKpPiMD05mnlSCzOaCh5rhNKx9CuGYCJ2LFFWN2vxmcLeXCrFeTaBcIgp5JKI9CGFRObpiNRmVDxPS78bay3/e55IXGe0IA0GCSIjq6A5mYKBYc6OIVIaBVyr0eJDurVoXokkFNvi4s/1ZkFr4SfLQWli0NrggGOoVErvohG6jlVHJA1cz+k4SJGEppBQCYUmWj5V86c/3fAWCefraqqTZf/P8aS5nmB4gFQ5hqbokcm+0GQBKWoIBaVQ3PzuTvPIR+veGUI3KCLeq7qYq/jLEynzSpqxg0TmaDL5HzJts01RDeX1r++0XjlRbP5Ke2uaSJOwvjYKz1SrC5GIfhC0KyIr4X1CCBmV2uHcJ8WOtUZMdLdp9TVLJX/2wfSUw/AwA7RUn7V43h2BDSDsHE/ywrla+Fe1jwzj8VR+8LDL2YcmQzeWK7tHB7EF7Fv3hSqttsXki3/XF7SrWBnO70geHWD4gW5Wvb1bNQV+r3JtGmOF+n1vTFLvHTzg8NW5RnRF5+BfZO1xB/GEBTjEoGtHE+k+qlPVapEs01zQutXl6NmVOikkSe6eRxicPh3IokEZ95LkjKkkKNk1EhDYo6hKtVYI1EyGqU07TPbmIGOuIL8mMWjeFmHaQo1YDB6lx8vG7UCcBwsbSuGg3TsUn5A1qcqXA/He8Vr0DS01P95kYcTVsZCho3GyQwZQEXJtxQ+vdc5sIVA3xmwsU6pnAgV2k1Ck6J8/AvXGbD36ljAVzT/fEmefsnmL7O0nnNXBCXXrfCBe/7ypzmnuzhdQ9OVy3mJroZLbGlKurwTy3c88MR92idpxYzd9sZQzsByhIhxcXQrlO182xE9hr3Gxr0Xs52zIVekP9EsbSvTs9Uoed8dd3PM2bNeAswHc1kfQl/Cei3X+Pvd+Gf8b9y9/fVB2NUu6mQAAAABJRU5ErkJggg==\');
	width:19px;
	height:20px;
	display:inline-block;
	}
	</style>';
}

function index() {

	global $nuked;

	top();

        echo '<body id="login">
        <div id="login-wrapper" class="png_bg">
        <div id="login-top">
        <h1>' . $nuked['name'] . ' - Installation</h1>
        <img id="logo" src="modules/Admin/images/logo.png" alt="NK Logo" />
        </div>';
	//Correction par Sekuline
	$version = $nuked['version'];
	$last = $version[0] . '.' . $version[2] . '.' . $version[4];

    	if ($last == '1.7.9') {
                if (function_exists('file_get_contents')) $txt_fgt = 'ok';
                else $txt_fgt = 'no';

		echo '<div class="content-box" style="width:700px!important;margin:auto;">',"\n" //<!-- Start Content Box -->
        	. '<div class="content-box-header"><h3>Installation Module Guilde</h3></div>',"\n"
        	. '<div class="tab-content" id="tab2"><table style="margin:auto;width:80%;color:black;" cellspacing="0" cellpadding="0" border="0">';

		//Vérification si INSTALLATION ou REINSTALLATION du module afin de ne pas dupliquer le liens dans l'admin
		$test = mysql_query("SELECT id FROM " . $nuked['prefix'] . "_modules WHERE nom='Guilde'");
		$req = mysql_num_rows($test);
		if($req == 1) echo '<tr><td style="text-align:center;"><span style="color:red; font-weight:bold;">Attention L\'installation remettra la configuration par défault du module.</span></td></tr>';

		echo '<tr>
		<td>
		Vous allez installer le module <strong>Guilde</strong> <br /><br />
		Créé par <a href="http://www.titeflafla.net" target="_blank">Kipcool</a> Pour <a href="http://www.nuked-klan.eu" target="_blank">Nuked-Klan</a><br /><br />
		<span style="color:red; font-weight:bold;font-size:25px;">Attention</span> : <br />
		Il faut editer le fichier modules/Guilde/conf.php
		</td>
		</tr>
		<td style="padding-top:30px;">
		<b>Vérification des fonctions importantes :</b><br /><br />
		Fonction pour télécharger les images depuis les serveur Blibli : <div class="function_'. $txt_fgt .'"></div><br />
                </td>
		</tr>
		<tr>
		<td style="text-align:center;">
		<input type="button" name="yes" onclick="document.location.href=\'install.php?op=update\';" value="Installer" class="css3button"/>&nbsp;&nbsp;
		<input type="button" name="No" onclick="document.location.href=\'install.php?op=nan\';" value="Ne pas installer" class="css3button"/>
		</td>
		</tr>
		</table>
		</div></div>
		</div>
        	</body>
    		</html>';
	}
	else echo 'Bad version, Only for NK 1.7.9';
}

function update() {

	global $nuked;

	//Efface les tables
	$req = mysql_query("DELETE FROM ". $nuked['prefix'] ."_modules WHERE nom = 'Guilde'");
        $req = mysql_query("DELETE FROM ". $nuked['prefix'] ."_stats WHERE nom = 'Guilde'");

	$sql = mysql_query("INSERT INTO ". $nuked['prefix'] ."_modules (`id`, `nom`, `niveau`, `admin`) VALUES ('', 'Guilde', '0', '9');");
        $sql = mysql_query("INSERT INTO ". $nuked['prefix'] ."_stats (`nom`, `type`, `count`) VALUES ('Guilde', 'pages', '0');");

        top();
        echo '<div class="tab-content" id="tab2" style="width:700px!important;margin:auto;">'
        . "<br /><br /><div class=\"notification success png_bg\"><div>Le module Guilde a été installé correctement.<br />
        N'oublier pas d'ajouter le module dans le menu<br />
        Redirection en cours vers le site ...</div></div>";

	//Supression automatique du fichier install.php
	if(@!unlink("install.php")) echo "<br /><br /><div class=\"notification error png_bg\"><div>Penser à supprimer le fichier install.php de votre FTP .</div></div>";

        echo '</div></body></html>';
	redirect("index.php?file=Guilde", 2);
}

function nan() {

	top();
        echo '<div class="tab-content" id="tab2" style="width:700px!important;margin:auto;">'
	. "<br /><br /><div class=\"notification error png_bg\"><div>Installation annulé .</div></div>";

	if(@!unlink("install.php")) echo "<br /><br /><div class=\"notification error png_bg\"><div>Penser à supprimer le fichier install.php de votre FTP .</div></div>";

        echo '</div></body></html>';

    	redirect("index.php", 2);
}

switch($_GET['op']) {
	case"index":
	index();
	break;

	case"update":
	update();
	break;

	case"nan":
	nan();
	break;

	default:
	index();
	break;
}

?>