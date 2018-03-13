<?php
function ed_btn($id)
{
	return '<span data-role="hint" data-hint-background="bg-darkMagenta" data-hint-color="fg-white" data-hint-mode="2" data-hint="Edit" data-hint-position="top"
><a href="#" onclick="edit(\''.$id.'\')" class="button bg-darkMagenta fg-white cycle-button"><span class="mif-pencil"></span></a></span>';
}

function edit_btn($id)
{
	echo ed_btn($id);
}

function get_edit_button($id, $url, $size='default')
{
	return '<span data-role="hint" data-hint-background="bg-darkMagenta" data-hint-color="fg-white" data-hint-mode="2" data-hint="Edit" data-hint-position="top"
><a href="#" onclick="edit(\''.$id.'\', \''.$url.'\', \''.$size.'\')" class="button bg-darkMagenta fg-white cycle-button"><span class="mif-pencil"></span></a></span>';
}

function edit_button($id, $size='default')
{
	echo get_edit_button($id, $size);
}

function det_btn($event=null)
{
	return '<a data-role="hint" data-hint-background="bg-darkIndigo" data-hint-color="fg-white" data-hint-mode="2" data-hint="Detail" data-hint-position="top" onclick="detail(\''.$event.'\')" class="button fg-white bg-darkIndigo cycle-button" href="#"><span class="mif-eye"></span></a>';
}

function get_detail_button($id, $url, $size='default')
{
	$event = 'detail(\''.$id.'\', \''.$url.'\', \''.$size.'\')';
	return '<a data-role="hint" data-hint-background="bg-darkIndigo" data-hint-color="fg-white" data-hint-mode="2" data-hint="Detail" data-hint-position="top" onclick="'.$event.'" class="button fg-white bg-darkIndigo cycle-button" href="#"><span class="mif-eye"></span></a>';
}

function del_btn($id)
{
	return '<a data-role="hint" data-hint-background="bg-red" data-hint-color="fg-white" data-hint-mode="2" data-hint="Delete" data-hint-position="top" onclick="remove('.$id.')" class="fg-white button cycle-button bg-red"><span class="mif-bin"></span></a>';
}

function get_delete_button($id, $url=null)
{
	return '<a data-role="hint" data-hint-background="bg-red" data-hint-color="fg-white" data-hint-mode="2" data-hint="Delete" data-hint-position="top" onclick="remove('.$id.', \''.$url.'\')" class="fg-white button cycle-button bg-red"><span class="mif-bin"></span></a>';
}

function delete_button($id)
{
	echo get_delete_button($id);
}

function save_btn($additional = '', $callback=null)
{
	$onclick = 'save(this, event)';
	if($callback!=null)
		$onclick = 'save(this, event, '.$callback.')';
	return
	'<div class="form-group">
	    <label for="submit"></label>
	    <button onclick="'.$onclick.'" '.$additional.' type="submit" id="submit" class="button loading-pulse lighten primary">Save</button>
	  </div>';
}

function save_button($action='insert', $text='Save', $additional='')
{
	$onclick = 'save(this, event, \''.$action.'\')';
	echo '<a onclick="'.$onclick.'" '.$additional.' type="submit" id="save" class="button save-button loading-pulse lighten primary">'.$text.'</a>';
}

function save_close_button($action='insert', $text='Save & Close', $additional='')
{
	$onclick = 'save(this, event, \''.$action.'\', true)';
	echo '<a onclick="'.$onclick.'" '.$additional.' type="submit" id="save-close" class="button save-button loading-pulse lighten btn-default">'.$text.'</a>';
}

function export_btn($m, $rules=null)
{
	$hint = 'data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom"';
	if($rules==null){
		echo '
		<a '.$hint.' href="'.route($m.'.print').'" data-hint="Print" data-hint-background="bg-steel" target="_blank"  class="button bg-steel fg-white cycle-button"><span class="mif-printer"></span></a>
		<a target="_blank" '.$hint.' href="'.route($m.'.pdf').'" data-hint="PDF" data-hint-background="bg-red" class="button danger fg-white cycle-button"><span class="mif-file-pdf"></span></a>
		<a target="_blank" '.$hint.' href="'.route($m.'.excel').'" data-hint="Excel" data-hint-background="bg-green" class="button success fg-white cycle-button"><span class="mif-file-excel"></span></a>
		<a '.$hint.' href="#" onclick="refreshTable()" data-hint="Refresh" data-hint-background="bg-cyan" class="button bg-cyan fg-white cycle-button"><span class="mif-loop2"></span></a>
		';
	}else{
		$rules = str_split($rules);
		if(in_array('p', $rules))
			echo '<a '.$hint.' href="'.route($m.'.print').'" data-hint="Print" data-hint-background="bg-steel" target="_blank"  class="button bg-steel fg-white cycle-button"><span class="mif-printer"></span></a>';
		if(in_array('f', $rules))
			echo '<a '.$hint.' href="'.route($m.'.pdf').'" data-hint="PDF" data-hint-background="bg-red" class="button danger fg-white cycle-button"><span class="mif-file-pdf"></span></a>';
		if(in_array('e', $rules))
			echo '<a '.$hint.' href="'.route($m.'.excel').'" data-hint="Excel" data-hint-background="bg-green" class="button success fg-white cycle-button"><span class="mif-file-excel"></span></a>';
	}
}

function refresh_btn($callback)
{
	$hint = 'data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom"';
	echo '<a '.$hint.' href="#" onclick="'.$callback.'" data-hint="Refresh" data-hint-background="bg-cyan" class="button bg-cyan fg-white cycle-button"><span class="mif-loop2"></span></a>
	';
}

function refresh_button($callback)
{
	$hint = 'data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom"';
	echo '<a '.$hint.' href="#" onclick="'.$callback.'" data-hint="Refresh" data-hint-background="bg-cyan" class="button bg-cyan fg-white cycle-button"><span class="mif-loop2"></span></a>
	';
}

function get_restore_button($id, $url=null)
{
	return '<a '.hint('Restore', 'blue').' href="#" onclick="restore(\''.$id.'\', \''.$url.'\')" class="button bg-blue fg-white cycle-button"><i class="fa fa-undo"></i></a>
	';
}

function get_permanent_delete_button($id, $url)
{
	return '<a '.hint('Permanent Delete', 'red').' href="#" onclick="permanentDelete(\''.$id.'\', \''.$url.'\')" class="button bg-red fg-white cycle-button"><i class="fa fa-trash"></i></a>
	';
}

function reload_btn()
{
	$hint = 'data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom"';
	return '<a '.$hint.' href="#" onclick="refreshTable()" data-hint="Refresh" data-hint-background="bg-cyan" class="button bg-cyan fg-white cycle-button"><span class="mif-loop2"></span></a>
	';
}