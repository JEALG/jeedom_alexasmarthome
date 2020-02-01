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
	throw new Exception('401 Unauthorized');
}

$json=file_get_contents("http://" . config::byKey('internalAddr') . ":3456/reminders");
$json = json_decode($json,true);

//log::add('alexaamazonmusic', 'warning', '**********************************************'."http://" . config::byKey('internalAddr') . ":3456/reminders");


function sortBy($field, &$array, $direction = 'asc')
{
    usort($array, create_function('$a, $b', '
        $a = $a["' . $field . '"];
        $b = $b["' . $field . '"];

        if ($a == $b) return 0;

        $direction = strtolower(trim($direction));

        return ($a ' . ($direction == 'desc' ? '>' : '<') .' $b) ? -1 : 1;
    '));

    return true;
}
sortBy('status', $json, 'desc');
/*

foreach($json as $item)
	{



						$device = $item['name'];
						$serial = $item['serial'];
						$type = $item['type'];
						$online = $item['online'];


		$alexaamazonmusic = alexaamazonmusic::byLogicalId($serial, 'alexaamazonmusic');
		if (!is_object($alexaamazonmusic)) {
			$alexaamazonmusic = new alexaamazonmusic();
			$alexaamazonmusic->setName($device);
			$alexaamazonmusic->setLogicalId($serial); 
			$alexaamazonmusic->setEqType_name('alexaamazonmusic');
			$alexaamazonmusic->setIsEnable(1);
			$alexaamazonmusic->setIsVisible(1);
		}
		$alexaamazonmusic->setConfiguration('serial',$serial); 
		$alexaamazonmusic->setConfiguration('device',$device);
		$alexaamazonmusic->setConfiguration('type',$type);
		$alexaamazonmusic->setStatus('online',$online);
		$alexaamazonmusic->save();
 }
*/

//$eqLogics = alexaamazonmusic::byType('alexaamazonmusic');
?>

<table class="table table-condensed tablesorter" id="table_healthNetwork">
	<thead>
		<tr>
			<th>{{Alexa}}</th>
			<th>{{Type}}</th>
			<th>{{Nom ou Musique}}</th>
			<th>{{Heure}}</th>
			<th>{{Date}}</th>
			<th>{{Activé}}</th>
			<th>{{Répétition}}</th>
			<th>{{Supprimer}}</th>
		</tr>
	</thead>
	<tbody>
	 <?php
foreach($json as $item)
{

//log::add('alexaamazonmusic_debug', 'info', json_encode($item));

switch ($item['type']) {
    case "Alarm":
		$couleur="primary";
        break;
    case "MusicAlarm":
		$couleur="warning";
        break;
    case "Reminder":
		$couleur="info";
        break;
    case "Timer":
		$couleur="success";
        break;
    default:
		$couleur="danger";
        break;
}
	

	if ($item['status'] == 'ON'){
		$present = '<a class="btn btn-success disableReminder" data-id="'. $item['id'] .'"><span class="label label-success" style="font-size : 1em;" title="{{Actif}}"><i class="fa fa-check-circle"></i></span></a>';
	} else {
		$present = '<a class="btn btn-default enableReminder" data-id="'. $item['id'] .'"><span class="label label-default" style="font-size : 1em;" title="{{Inactif}}"><i class="fa fa-times-circle"></i></span></a>';
		$couleur="default";
	}


switch ($item['type']) {
    case "Alarm":
		$type = '<span class="label label-'.$couleur.'" style="font-size : 1em;" title="{{Alarme}}"><i class="fa fa-bell"></i> Alarme</span>';
        break;
     case "MusicAlarm":
		$type = '<span class="label label-'.$couleur.'" style="font-size : 1em;" title="{{Alarme Musicale}}"><i class="fa loisir-musical7"></i> Alarme musicale</span>';
        break;
   case "Reminder":
		$type = '<span class="label label-'.$couleur.'" style="font-size : 1em;" title="{{Rappel}}"><i class="fa divers-circular114"></i> Rappel</span>';
        break;
    case "Timer":
		$type = '<span class="label label-'.$couleur.'" style="font-size : 1em;" title="{{Minuteur}}"><i class="fa divers-circular114"></i> Minuteur</span>';
        break;
    default:
		$type = '<span class="label label-'.$couleur.'" style="font-size : 1em;" title="{{????}}"><i class="fa fa-bell"></i> ????</span>';
        break;
}	
			
	
$repetition="";	
	switch ($item['recurringPattern']) {
    case "P1D":
        $repetition="Tous les jours";
        break;
    case "XXXX-WD":
        $repetition="En semaine";
        break;
    case "XXXX-WE":
        $repetition="Week-ends";
        break;
    case "XXXX-WXX-1":
        $repetition="Chaque lundi";
        break;
    case "XXXX-WXX-2":
        $repetition="Chaque mardi";
        break;
    case "XXXX-WXX-3":
        $repetition="Chaque mercredi";
        break;
    case "XXXX-WXX-4":
        $repetition="Chaque jeudi";
        break;
    case "XXXX-WXX-5":
        $repetition="Chaque vendredi";
        break;
    case "XXXX-WXX-6":
        $repetition="Chaque samedi";
        break;
    case "XXXX-WXX-7":
        $repetition="Chaque dimanche";
        break;
}

            // Retireve the device (if already registered in Jeedom)
            $device = alexaamazonmusic::byLogicalId($item['deviceSerialNumber'], 'alexaamazonmusic');
            if (is_object($device))
				
			
			
	echo '<tr><td><span class="label label-'.$couleur.'" style="font-size : 1em; cursor : default;">'.$device->getName().'</span></td>';
			else
	echo '<tr><td><span class="label label-danger" style="font-size : 1em; cursor : default;">?????</span></td>';




	echo '<td>' . $type . '</td>';
	echo '<td><span class="label label-'.$couleur.'" style="font-size : 1em; cursor : default;">' . $item['soundDisplayName']. $item['musicEntity']. $item['reminderLabel'] . '</span></td>';

            if ($item['type'] =="Timer")
			{
			//$date = DateTime::createFromFormat('U',strval(intval(intval($item['remainingTime'])/1000)));
			$remainingTime=intval($item['remainingTime']);
			$heures=floor($remainingTime/1000/60/60);
			$minutes=floor(($remainingTime-$heures*60)/1000/60);
			$secondes=floor($remainingTime/1000-$minutes*60);
			if ($heures<10) $heures='0'.$heures;
			if ($minutes<10) $minutes='0'.$minutes;
			if ($secondes<10) $secondes='0'.$secondes;
			
			echo '<td><span class="label label-'.$couleur.'" style="font-size : 1em; cursor : default;"> Dans ' .$heures.":".$minutes.":".$secondes.'</span></td>';
			}
		else
			echo '<td><span class="label label-'.$couleur.'" style="font-size : 1em; cursor : default;">' . substr($item['originalTime'],0,5). '</span></td>';

	echo '<td><span class="label label-'.$couleur.'" style="font-size : 1em; cursor : default;">' .substr($item['originalDate'],8,2). substr($item['originalDate'],4,4). substr($item['originalDate'],0,4) . '</span></td>';
	echo '<td>' . $present . '</td>';
	echo '<td><span class="label label-'.$couleur.'" style="font-size : 1em; cursor : default;">' . $repetition . '</span></td>';
	//echo '<td><span class="label label-'.$couleur.'" style="font-size : 1em; cursor : default;">' . $item['id'] . '</span></td>';
	echo '<td><a class="btn btn-danger deleteReminder" data-id="'. $item['id'] .'"><i class="fa fa-times-circle"></i></a></td>';
			//$present = '<span class="label label-default" style="font-size : 1em;" title="{{Inactif}}"><i class="fa fa-times-circle"></i></span>';

	echo '</tr>';
}
?>
	</tbody>
</table>

<a class="btn btn-default pull-right refreshAction" data-action="refresh"><i class="fa fa-refresh"></i>  {{Rafraichir}}</a>
    
<script>


$('.deleteReminder').off('click').on('click',function(){
    jeedom.plugin.node.action({
        action : 'delete',
        node_id: $(this).attr('data-id'),
        error: function (error) {
	//$('#div_alert').showAlert({message: error.message, level: 'danger'});
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');

       },
       success: function (data) {
        // $('#div_alert').showAlert({message: '{{Action réalisée avec succès}}', level: 'success'});
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');
     }
 });
});

$('.disableReminder').off('click').on('click',function(){
    jeedom.plugin.node.action({
        action : 'disable',
        node_id: $(this).attr('data-id'),
        error: function (error) {
	//$('#div_alert').showAlert({message: error.message, level: 'danger'});
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');

       },
       success: function (data) {
        // $('#div_alert').showAlert({message: '{{Action réalisée avec succès}}', level: 'success'});
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');
     }
 });
});

$('.enableReminder').off('click').on('click',function(){
    jeedom.plugin.node.action({
        action : 'enable',
        node_id: $(this).attr('data-id'),
        error: function (error) {
	//$('#div_alert').showAlert({message: error.message, level: 'danger'});
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');

       },
       success: function (data) {
        // $('#div_alert').showAlert({message: '{{Action réalisée avec succès}}', level: 'success'});
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');
     }
 });
});

$('.deleteReminder2').off('click').on('click',function(){
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');
});

$('.refreshAction[data-action=refresh]').off('click').on('click',function(){
	$('#md_modal').dialog('close');
	$('#md_modal').dialog({title: "{{Rappels / Alarmes}}"});
	$('#md_modal').load('index.php?v=d&plugin=alexaamazonmusic&modal=reminders&id=alexaamazonmusic').dialog('open');
});
</script>

<?php include_file('desktop', 'alexaamazonmusic', 'js', 'alexaamazonmusic');?>
