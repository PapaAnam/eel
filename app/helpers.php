<?php

function appName()
{
	return 'HRIS Application';
}

function title()
{
	return ' | '.appName();
}

require_once 'date-helpers.php';

function upper($string)
{
	return ucwords(strtolower($string));
}

function rupiah($duit)
{
	return number_format($duit, 0, ',', '.');
}
function copyright()
{
	$date = 2017;
	if($date!=date('Y'))
		$date .= ' - '.date('Y');
	return '<strong>Copyright &copy; '.$date.' <a href="#">E Boaz System</a>.</strong> All rights
	reserved.';
}
function version()
{
	return '1.0.0';
}

require_once 'button-helpers.php';


function failed($fail)
{
	if($fail){
		echo '<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-warning"></i> Failed!</h4>'.
		$fail.
		'</div>';
	}
}

function success($success)
{
	if($success){
		echo '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>'.
		$success.
		'</div>';
	}
}

function reset_form($action, $csrf_field)
{
	echo 
	'<form id="reset-form" action="'.$action.'" method="post">'.
	$csrf_field.
	'<input type="hidden" name="id" id="reset_id">
	<input type="hidden" name="_method" value="PUT">
	</form>';
}

function error($errors, $field)
{
	if ($errors->has($field)){
		echo '<span class="help-block">
		<strong>'.$errors->first($field).'</strong>
		</span>';
	}
}

function level($id)
{
	switch($id){
		case 2 : return 'Admin'; break;
		case 3 : return 'Supervisor'; break;
		case 4 : return 'Manager'; break;
	}
}

function edit_value($f, $v)
{
	if(old($f))
		echo 'value="'.old($f).'"';
	else
		echo 'value="'.$v.'"';
}

function id_field($id)
{
	echo '<input type="hidden" name="id" value="'.$id.'">';
}

function errors_alert($errors)
{
	if(count($errors)>0){
		echo 
		'<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-warning"></i> Failed!</h4>';
		$no = 1;
		foreach($errors->all() as $er){
			echo $no.'. '.$er.'<br>';
			$no++;
		}
		echo '</div>';
	}
}

function accessed($status)
{
	if($status==0)
		return 'Not Authorized';
	return 'Authorized';
}

function employee_type($type)
{
	if($type==1)
		return 'Free Employee';
	return 'Permanent Employee';
}

function help_block($errors, $field)
{
	if ($errors->has($field)){
		return '<span class="help-block">
		<strong>'.$errors->first($field).'</strong>
		</span>';
	}
}

function active_modul($m, $modul)
{
	if($modul==$m) echo 'class="active"';
}

require_once('form-helpers.php');

function absence_status($s)
{
	$status = ['Present', 'Sick', 'Absent', 'Official Travel', 'Father Leave', 'Annual Leave', 'Special Permit', 'Pregnancy'];
	foreach ($status as $key => $value) {
		if($key == $s)
			return $value;
	}
}

function export_route($c, $r, $same=false)
{
	if($same==false){
		Route::get('print', $c.'to_print')->name($r.'.print');
		Route::get('pdf', $c.'pdf')->name($r.'.pdf');
		Route::get('excel', $c.'excel')->name($r.'.excel');
	}else{
		Route::get($r.'/print', $c.'to_print')->name($r.'.print');
		Route::get($r.'/pdf', $c.'pdf')->name($r.'.pdf');
		Route::get($r.'/excel', $c.'excel')->name($r.'.excel');
	}
}

function scs()
{
	if(session('success'))
		return success(session('success'));
}

function fail($e=null)
{
	if($e==null)
		return failed(session('failed'));
	if(count($e)>0){
		$error= 
		'<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-warning"></i> Failed!</h4>';
		$no = 1;
		foreach($e->all() as $er){
			$error .= $no++.'. '.$er.'<br>';
		}
		return $error.='</div>';
	}
}

function color()
{
	$colors = ['black', 'white', 'lime', 'green', 'emerald', 'teal', 'blue', 'cyan', 'cobalt', 'indigo', 'violet', 'pink', 'magenta', 'crimson', 'red', 'orange', 'amber', 'yellow', 'brown', 'olive', 'steel', 'mauve', 'taupe', 'gray', 'dark', 'darker', 'darkBrown', 'darkCrimson', 'darkMagenta', 'darkIndigo', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald', 'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkViolet', 'darkBlue', 'lightBlue', 'lightRed', 'lightGreen', 'lighterBlue', 'lightTeal', 'lightOlive', 'lightOrange', 'lightPink', 'grayDark', 'grayDarker', 'grayLight', 'grayLighter'];
	return $colors[array_rand($colors)];
}

function set_background($color)
{
	$fg = 'fg-white';
	if($color=='white' or $color=='grayLighter')
		$fg = 'fg-black';
	return 'bg-'.$color.' '.$fg;
}

function hint($text, $bg='cyan', $pos='bottom')
{
	$color = 'fg-white';
	if($bg=='white' or $bg=='grayLighter')
		$color = 'fg-black';
	return 'data-role="hint" data-hint="'.$text.'" data-hint-background="bg-'.$bg.'" data-hint-color="'.$color.'" data-hint-mode="2" data-hint-position="'.$pos.'"';
}

function maried($i)
{
	switch ($i) {
		case 1:
		return 'Maried';
		break;
		
		default:
		return 'No Maried';
		break;
	}
}

function non_active($i)
{
	switch ($i) {
		case 1:return 'Stand Down';break;
		case 2:return 'Chronic Pain';break;
		case 3:return 'Move District';break;
		case 4:return 'Family Reason';break;
		case 5:return 'No Mention';break;
		case 6:return 'Termination Of Employment';break;
		case 7:return 'Other';break;
		default:return 'invalid';break;
	}
}

function get_random_color()
{
	$ar = [0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'];
	$colors = [];
	for($a=1;$a<=200;$a++){
		array_push($colors, ('#'.$ar[array_rand($ar)].$ar[array_rand($ar)].$ar[array_rand($ar)].$ar[array_rand($ar)].$ar[array_rand($ar)].$ar[array_rand($ar)]));
	}
	return $colors[array_rand($colors)];
}

function local_file($path)
{
	return str_replace('\\', '/', public_path($path));
}

function simple_route($controller, $route_name, $rules, $show = true)
{
	$controller .= 'Controller@';
	if($show)
		Route::get($route_name.'s', $controller.'index')->name($route_name.'s');
	else
		Route::get($route_name, $controller.'index')->name($route_name);
	$crud = str_split($rules);
	if(in_array('c', $crud))
		Route::post($route_name.'/create', $controller.'create')->name($route_name.'.create');
	if(in_array('u', $crud)){
		Route::post($route_name.'/edit', $controller.'edit')->name($route_name.'.edit');
		Route::put($route_name.'/update', $controller.'update')->name($route_name.'.update');
	}
	if(in_array('d', $crud))
		Route::delete($route_name.'/remove', $controller.'remove')->name($route_name.'.remove');
	if(in_array('t', $crud))
		Route::post($route_name.'/dt', $controller.'dt')->name($route_name.'.dt');
	if(in_array('e', $crud))
		export_route($controller, $route_name, true);
}

function array_key_rename($array, $rename)
{
	$newArray = [];
	foreach ($array as $key => $value) {
		$newValue = [];
		foreach ($value as $k => $v) {
			$get_it = false;
			foreach ($rename as $rk => $rv) {
				if($rk==$k){
					$get_it = true;
					$newValue = array_add($newValue, $rv, $v);
					break;
				}
			}
			if($get_it){
				unset($newValue[$k]);
			}else{
				$newValue = array_add($newValue, $k, $v);
			}
		}
		array_push($newArray, $newValue);
	}
	return $newArray;
}

function convertHour($hours)
{
	$jam   = floor($hours);
	$dec   = $hours - $jam;
	$minutes = round($dec * 60);
	$t = ($jam > 1) ? 'hours' : "hour";
	$prefix = '';
	if($jam<=0){
		$prefix = '';
	}else{
		$prefix = $jam . ' '.$t;
	}
	$suffix = '';
	if($minutes > 1){
		$suffix = ' '.$minutes.' minutes';
	}elseif($minutes > 0){
		$suffix = ' '.$minutes.' minute';
	}
	if(trim($prefix.$suffix) == ''){
		return '-';
	}
	return $prefix.$suffix;
}