<?php
// -------------------------------------------------------------------------//
// Nuked-KlaN - PHP Portal                                                  //
// http://www.nuked-klan.org                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
if (!defined("INDEX_CHECK")) die ("<div style=\"text-align: center;\">You cannot open this page directly</div>");

global $nuked, $language, $user;
translate("modules/Guilde/lang/". $language .".lang.php");
include('modules/Guilde/conf.php');

$visiteur = !$user ? 0 : $user[1];
$ModName = basename(dirname(__FILE__));
$level_access = nivo_mod($ModName);

if (($visiteur >= $level_access && $level_access > -1)) {

        function index() {

                global $nuked, $bgcolor2, $bgcolor1, $guilde;

                opentable();

                if ($_REQUEST['orderby'] == 'name') $sort = 'name';
                else if ($_REQUEST['orderby'] == 'class' || $_REQUEST['orderby'] == 'race' || $_REQUEST['orderby'] == 'gender' || $_REQUEST['orderby'] == 'level' || $_REQUEST['orderby'] == 'rank') $sort = $_REQUEST['orderby'];
                else $sort = 'rank';

                if ($_REQUEST['sort'] == 'asc' || $_REQUEST['sort'] == '') $s_s = 'asc';
                else $s_s = 'desc';

                $ar = new BattlenetArmory($guilde['wow_region'],$guilde['wow_stream']);
                $ar->setLocale($guilde['wow_locale']);
                $ar->UTF8(TRUE);
                $guild = $ar->getGuild($guilde['wow_guilde']);
                $members = $guild->getMembers($sort,$s_s);

                echo '<script type="text/javascript" src="modules/Guilde/guilde.js"></script>'
                . '<br /><div class="g2_title">Membre de la Guilde '. $guilde['wow_guilde'] .'</div><br />'
                . '<div class="centeredmenu"><div class="nav l_g"><ul>'
                . "<li><a href=\"index.php?file=Guilde&amp;orderby=name&amp;sort=". $s_s ."&amp;p=1\"><span>Nom</span></a></li>"
                . "<li><a href=\"index.php?file=Guilde&amp;orderby=race&amp;sort=". $s_s ."&amp;p=1\"><span>Race</span></a></li>"
                . "<li><a href=\"index.php?file=Guilde&amp;orderby=class&amp;sort=". $s_s ."&amp;p=1\"><span>Classe</span></a></li>"
                . "<li><a href=\"index.php?file=Guilde&amp;orderby=level&amp;sort=". $s_s ."&amp;p=1\"><span>Niveau</span></a></li>"
                . "<li><a href=\"index.php?file=Guilde&amp;orderby=rank&amp;sort=". $s_s ."&amp;p=1\"><span>Rang</span></a></li>"
                . '</ul></div></div><div class="clear"></div><br /><br /><div style="text-align: center;">';

                if ($s_s == 'desc') echo '<a href="index.php?file=Guilde&amp;orderby='. $sort .'&amp;sort=asc&amp;p=1"><img src="modules/Guilde/images/up_alt.png" alt="" /></a>&nbsp;&nbsp;<img src="modules/Guilde/images/down_alt_on.png" alt="" />';
                else if ($s_s == 'asc') echo '<img src="modules/Guilde/images/up_alt_on.png" alt="" />&nbsp;&nbsp;<a href="index.php?file=Guilde&amp;orderby='. $sort .'&amp;sort=desc&amp;p=1"><img src="modules/Guilde/images/down_alt.png" alt="" /></a>';
                echo '</div>';

                $nb_membres = '10';
                if (!$_REQUEST['p']) $_REQUEST['p'] = 1;

                $pages = array_chunk($members, $nb_membres, true);
                $count = count($members);

                if ($count > $nb_membres) {                	echo "<br /><br /><table class=\"g2_cadre_table_page\" style=\"background: ". $bgcolor1 .";\" cellspacing=\"5\" cellpadding=\"5\">"
            		. "<tr><td>";
                	number($count, $nb_membres, "index.php?file=Guilde&amp;orderby=". $sort ."&amp;sort=". $s_s);
                	echo "</td></tr></table><br /><br />";
                }

                echo "<table class=\"table_98_border\" cellspacing=\"0\" cellpadding=\"0\">"
                . "<tr>"
                . "<td class=\"td_1_b_r_t_l_1\" style=\"width:20%;\">Nom</td>"
                . "<td class=\"td_1_b_r_t_l\" style=\"width:7%;\">Race</td>"
                . "<td class=\"td_1_b_r_t_l\" style=\"width:7%;\">Classe</td>"
                . "<td class=\"td_1_b_r_t_l\" style=\"width:6%;\">Niveau</td>"
                . "<td class=\"td_1_b_r_t_l\" style=\"width:25%;\">R&eacute;putation</td>"
                . "<td class=\"td_1_t_l_2\" style=\"width:35%;\">Rang guilde</td>"
                . "</tr>";

                $i = '';

                foreach($pages[$_REQUEST['p']-1] as $p) {

                        $mrank = $p['rank'];
                        $mrace = $p['character']['race'];
                        $mlevel = $p['character']['level'];
                        $mclass = $p['character']['class'];
                        $mgender = $p['character']['gender'];
                        $mthumbnail = $p['character']['thumbnail'];
                        $mname = mb_convert_encoding($p['character']['name'], "ISO-8859-1", "UTF-8");

                        if (!file_exists('modules/Guilde/images/race/'. $mrace .'-'. $mgender .'.jpg')) {                        	$picture_race = dl_picture($mrace .'-'. $mgender .'.jpg', 'modules/Guilde/images/race/', 'http://eu.battle.net/wow/static/local-common/images/wow/race/'. $mrace .'-'. $mgender .'.jpg');
	   		} else $picture_race = 'modules/Guilde/images/race/'. $mrace .'-'. $mgender .'.jpg';

                        if (!file_exists('modules/Guilde/images/class/'. $mclass .'.jpg')) {                        	$picture_class = dl_picture($mclass .'.jpg', 'modules/Guilde/images/class/', 'http://eu.battle.net/wow/static/local-common/images/wow/class/'. $mclass .'.jpg');
	   		} else $picture_class = 'modules/Guilde/images/class/'. $mclass .'.jpg';

                        if ($i == 0) {
                                $bg = $bgcolor2;
                                $i++;
                        } else {
                                $bg = $bgcolor1;
                                $i = 0;
                        }
                        $character = $ar->getCharacter(mb_convert_encoding($p['character']['name'], "ISO-8859-1", "UTF-8"));
                        $validcharacter = $character->isValid();
                        if ($validcharacter == TRUE) {
	                        $reputation = $character->getReputation();
	                        foreach($reputation as $r) {
			              	if ($r['name'] == 'Guilde') {
			              		$rgv = $r['value'];
			                	$rgm = " / ". $r['max'];
			                	$rgt = " : ". $r['standingName'];
			                	$rgs = $r['standing'];
			                	$ss  = round(($r['value'] * 100) / $r['max']);
			                }
			        }
			        unset($r);
                        } else {
                        	$rgv = '';
			        $rgm = '';
			        $rgt = 'no found';
			        $rgs = '0';
			        $ss  = '0';
                        }
                        echo "<tr style=\"background: ". $bg . ";\">"
                        . "<td class=\"td_2_b_rt_t_l\"><a href=\"http://eu.battle.net/wow/fr/character/". $guilde['wow_stream'] ."/". $mname ."/simple\" onclick=\"window.open(this.href,'_blank');return false;\">". $mname ."</a></td>"
                        . "<td class=\"td_2_b_rt_t_c\"><img class=\"frame_18\" src=\"". $picture_race ."\" alt=\"\" /></td>"
                        . "<td class=\"td_2_b_rt_t_c\"><img class=\"frame_18\" src=\"". $picture_class ."\" alt=\"\" /></td>"
                        . "<td class=\"td_2_b_rt_t_c\">". $mlevel ."</td>"
                        . "<td class=\"td_2_b_rt_t_c\"><div class=\"rank-". $rgs ."\"><div class=\"faction-standing\"><div class=\"faction-bar\"><div class=\"faction-score\">". $rgv ."". $rgm ."". $rgt ."</div><div class=\"faction-fill\" style=\"width:". $ss ."%;\"></div></div></div></div></td>"
                        . "<td class=\"td_2_b_t_t_l\">". translate_rank($mrank) ."</td>"
                        . "</tr>";
                }

                echo '</table>';
                if ($count > $nb_membres) {
                	echo "<br /><br /><table class=\"g2_cadre_table_page\" style=\"background: ". $bgcolor1 .";\" cellspacing=\"5\" cellpadding=\"5\">"
            		. "<tr><td>";
                	number($count, $nb_membres, "index.php?file=Guilde&amp;orderby=". $sort ."&amp;sort=". $s_s);
                	echo "</td></tr></table><br /><br />";
                }else echo '<br /><br />';

                echo '<script type="text/javascript">
	        	window.___DarkTipSettings = {
				\'resources\': {
			      		\'qtip2\'  : [
			        	\'modules/Guilde/qtip2/jquery.qtip.min.js\',
			        	\'modules/Guilde/qtip2/jquery.qtip.min.css\'
			      	],
	                	\'extras\': [
		                	\'modules/Guilde/js/wow.css\',
				        \'modules/Guilde/js/wow.js\',
				        \'modules/Guilde/js/wow.realm.js\',
				        \'modules/Guilde/js/wow.quest.js\',
				        \'modules/Guilde/js/wow.item.js\',
				        \'modules/Guilde/js/wow.item.equipped.js\',
				        \'modules/Guilde/js/wow.character.js\',
				        \'modules/Guilde/js/wow.character.spec.js\',
				        \'modules/Guilde/js/wow.character.pvp.js\',
				        \'modules/Guilde/js/wow.guild.js\',
				        \'modules/Guilde/js/wow.arena.js\',
				        \'modules/Guilde/js/wow.achievement.js\',
				        \'modules/Guilde/js/wow.spell.js\'
                		]
    			}
  		};
                </script>
                <script type="text/javascript" src="modules/Guilde/DarkTip.js"></script>';

                closetable();
        }

        switch ($_REQUEST['op']) {
                case"index":
                index();
                break;

                default:
                index();
                break;
        }

} else if ($level_access == -1) {
    	opentable();
    	echo "<br /><br /><div style=\"text-align: center;\">" . _MODULEOFF . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a><br /><br /></div>";
    	closetable();
} else if ($level_access == 1 && $visiteur == 0) {
    	opentable();
    	echo "<br /><br /><div style=\"text-align: center;\">" . _USERENTRANCE . "<br /><br /><b><a href=\"index.php?file=User&amp;op=login_screen\">" . _LOGINUSER . "</a> | <a href=\"index.php?file=User&amp;op=reg_screen\">" . _REGISTERUSER . "</a></b><br /><br /></div>";
    	closetable();
} else {
    	opentable();
    	echo "<br /><br /><div style=\"text-align: center;\">" . _NOENTRANCE . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a><br /><br /></div>";
    	closetable();
}

?>