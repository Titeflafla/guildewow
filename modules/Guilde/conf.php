<?php

include_once('Includes/wowarmoryapi/BattlenetArmory.class.php');

$GLOBALS['wowarmory']['db']['driver']   = 'mysql';
$GLOBALS['wowarmory']['db']['hostname'] = $global['db_host'];
$GLOBALS['wowarmory']['db']['dbname']   = $global['db_name']; // le nom de votre table mysql
$GLOBALS['wowarmory']['db']['username'] = $global['db_user']; // le nom d'utilisateur
$GLOBALS['wowarmory']['db']['password'] = $global['db_pass']; // le mot de pass

$guilde['wow_region'] = 'EU';       // US, EU, KR, TW
$guilde['wow_stream'] = 'Uldaman';  // votre serveur
// Set the locale. Will default back to region default if not defined. English normally.
// us.battle.net: en_US, es_MX
// eu.battle.net: en_GB, es_ES, fr_FR, ru_RU, de_DE
// kr.battle.net: ko_KR
// tw.battle.net: zh_TW
// battlenet.com.cn: zh_CN
$guilde['wow_locale'] = 'fr_FR';
$guilde['wow_guilde'] = 'Atome';   // nom de la guilde


function translate_rank($id_name) {
	switch ($id_name) {
 		case 0:  // 0 est toujours le MG
                $titre = 'Maître de guilde';
                break;
                case 1:
   		$titre = 'rang 1';
     		break;
                case 2:
                $titre = 'rang 2';
                break;
                case 3:
                $titre = 'rang 3';
                break;
                case 4:
                $titre = 'rang 4';
                break;
                case 5:
                $titre = 'rang 5';
                break;
                case 6:
                $titre = 'rang 6';
                break;
                case 7:
                $titre = 'rang 7';
                break;
                case 8:
                $titre = 'rang 8';
                break;
                case 9:
                $titre = 'rang 9';
                break;
 	}
  	if($titre != '') return $titre;
   	else return $id_name;
}

function dl_picture($img, $img_dir, $url) {
	$image = $img_dir .'/'. $img;
	$url_thumb = file_get_contents($url);
	$fp = fopen("$image", 'w+b');
	fwrite($fp, $url_thumb);
	fclose($fp);

	return $image;
}


?>