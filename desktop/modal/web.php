<?php
/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}

//if (init('ip') == '') {
//    throw new Exception('{{L\'ip alexaamazonmusic ne peut etre vide : }}' . init('op_id'));
//}
$url = "http://".init('ip').":3457";
$url = "http://www.google.fr";
$url = "http://192.168.0.200";
print "Affichage de : ".$url;
//<iframe src="<?php echo $url; ?>" height="100%" width="100%">You need a Frames Capable browser to view this content.</iframe>
?>

Cliquez sur ce lien :
<a target=nouvellefenetre href="http://192.168.0.21:3457">ICI</a>