<?php
#FORM HELPER

function has_error($errors, $field)
{
  if($errors->has($field)) return 'has-error';
}

function label($l, $f)
{
  if(is_null($l) or $l==''){
    $l = ucfirst($f);
    if(strpos($f, '_') !== false){
      $L = explode('_', $f);
      $l = '';
      foreach ($L as $ll) {
        $l .= ucfirst($ll).' ';
      }
    }
  }
  return $l;
}
function input_date($name, $placeholder=null, $value='', $optional='')
{
  echo 
  '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input id="'.$name.'" type="text" '.get_date_mask().' class="form-control date-mask" placeholder="Insert '.label($placeholder, $name).'" name="'.$name.'" value="'.$value.'" '.$optional.'>
  <span class="help-block"><strong></strong></span>
  </div>';
}
function inp_text($f, $l = null, $a='')
{
  $l = label($l, $f);
  return 
  '<div class="form-group">
  <label for="'.$l.'">'.$l.'</label>
  <input onfocus="resetError(this)" '.$a.' type="text" class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.$l.'">
  <span class="help-block"><strong></strong></span>
  </div>'
  ;   
}

function input_text($name, $placeholder='', $value='', $additional='')
{
  echo '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input onfocus="resetError(this)" '.$additional.' type="text" class="form-control" id="'.$name.'" name="'.$name.'" placeholder="Insert '.label($placeholder, $name).'" value="'.$value.'">
  <span class="help-block"><strong></strong></span>
  </div>';
}

function inp_file($f, $l=null, $o='')
{
  $l = label($l, $f);
  return
  '<div class="form-group">
  <label>'.$l.'</label>
  <input '.$o.' class="form-control" onchange="resetError(this)" id="'.$f.'" type="file" name="'.$f.'">
  <span class="help-block"><strong></strong></span>
  </div>';
}

function input_file($name, $placeholder='', $value='', $additional='')
{
  echo '<div class="form-group">
  <label for="file_'.$name.'">'.label($placeholder, $name).'</label>
  <input onfocus="resetError(this)" '.$additional.' type="file" class="form-control" id="file_'.$name.'" name="file_'.$name.'" placeholder="Insert '.label($placeholder, $name).'" value="'.$value.'">
  <span class="help-block"><strong></strong></span>
  </div>
  <input type="hidden" name="'.$name.'" id="'.$name.'">
  ';
}

function inp_time($f, $l=null, $o='')
{
	$l = label($l, $f);
	return
  '<div class="form-group">
  <label for="'.$f.'">'.$l.'</label>
  <input '.$o.' type="text" class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.$l.'" data-inputmask="\'alias\': \'hh:mm:ss\'" data-mask>
  <span class="help-block"><strong></strong></span>
  </div>';
}

function input_time($name, $placeholder=null, $value='', $optional='')
{
  echo 
  '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input id="'.$name.'" type="text" data-inputmask="\'alias\': \'hh:mm:ss\'" data-mask class="form-control date-mask" placeholder="Insert '.label($placeholder, $name).'" name="'.$name.'" value="'.$value.'" '.$optional.'>
  <span class="help-block"><strong></strong></span>
  </div>';
}

function ed_inp_time($v, $f, $l=null, $o='')
{
  $l = label($l, $f);
  return
  '<div class="form-group">
  <label for="'.$f.'">'.$l.'</label>
  <input '.$o.' type="text" value="'.$v.'" class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.$l.'" data-inputmask="\'alias\': \'hh:mm:ss\'" data-mask>
  <span class="help-block"><strong></strong></span>
  </div>';
}

function ed_inp_txt($v, $f, $l=null, $o = '')
{
  $l = label($l, $f);
  return 
  '<div class="form-group">
  <label for="'.$f.'">'.$l.'</label>
  <input onfocus="resetError(this)" '.$o.' value="'.$v.'" type="text" class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.$l.'">
  <span class="help-block"><strong></strong></span>
  </div>';   
}

function inp_textarea($f, $l=null, $o='')
{
  $l = label($l, $f);
  return 
  '<div class="form-group">
  <label for="'.$f.'">'.$l.'</label>
  <textarea '.$o.' class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.$l.'"></textarea>
  <span class="help-block"><strong></strong></span>
  </div>';
}

function textarea($f, $l='', $v='', $o = '')
{
  $l = label($l, $f);
  echo 
  '<div class="form-group">
  <label for="'.$f.'">'.$l.'</label>
  <textarea '.$o.' class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.$l.'">'.$v.'</textarea>
  <span class="help-block"><strong></strong></span>
  </div>';
}

function edit_input_textarea($errors, $v, $f)
{
  echo
  '<div class="form-group '.has_error($errors, $f).'">
  <label for="'.$f.'">'.ucfirst($f).'</label>
  <textarea required class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.ucfirst($f).'">';
  if(count($errors)>0)
    echo old($f);
  else
    echo $v;
  echo '</textarea>
  </div>'.
  help_block($errors, $f)
  ;   
}

function ed_inp_textarea($v, $f, $l=null, $o='')
{
  $l = label($l, $f);
  return
  '<div class="form-group">
  <label for="'.$f.'">'.$l.'</label>
  <textarea '.$o.' class="form-control" id="'.$f.'" name="'.$f.'" placeholder="Insert '.$l.'">'.$v.'</textarea>
  <span class="help-block"><strong></strong></span>
  </div>';
}

function cb($v, $n, $p)
{
  return 
  '<div class="form-group">
  <label class="input-control checkbox">
  <input type="checkbox" name="'.$n.'" value="'.$v.'" class="minimal check-menu"> '.$p.'
  </label>
  </div>';
}

function ed_cb($v, $d, $f, $p)
{
  $c = '';
  if($v==$d)
    $c = 'checked';
  return 
  '<div class="form-group">
  <label><input type="checkbox" class="minimal check-menu" name="'.$f.'" value="'.$d.'" '.$c.'> '.$p.'</label>
  </div>';
}

function old_fl($v, $f)
{
  return '<input type="hidden" name="old_'.$f.'" value="'.$v.'">';
}

function inp_hid($v, $f)
{
  return '<input type="hidden" value="'.$v.'" name="'.$f.'">';
}

function edit_url($v)
{
  echo '<input type="hidden" id="edit-url" value="'.$v.'">';
}

function in_hid($v, $f)
{
  echo '<input type="hidden" value="'.$v.'" name="'.$f.'">';
}

function inp_date($f, $l=null, $o='')
{
  $l = label($l, $f);
  echo
  '<div class="form-group" data-role="datepicker" data-scheme="darcula" data-format="yyyy-mm-dd">
  <label for="'.$f.'">'.$l.'</label>
  <input '.$o.' type="text" placeholder="Insert '.$l.'" name="'.$f.'" id="'.$f.'" class="form-control">
  <span class="help-block"><strong></strong></span>
  </div>';
}

function ed_inp_date($v, $f, $l=null, $o='')
{
  $l = label($l, $f);
  return
  '<div class="form-group" data-role="datepicker" data-scheme="darcula" data-format="yyyy-mm-dd">
  <label for="'.$f.'">'.$l.'</label>
  <input '.$o.' type="text" value="'.$v.'" placeholder="Insert '.$l.'" name="'.$f.'" id="'.$f.'" class="form-control">
  <span class="help-block"><strong></strong></span>
  </div>';
}

function inp_pass($f='password', $l=null)
{
  $l = label($l, $f);
  return 
  '<div class="form-group">
  <label for="'.$f.'">'.$l.'</label>
  <input name="'.$f.'" required type="password" id="'.$f.'" class="form-control" placeholder="'.$l.'">
  <span class="help-block"><strong></strong></span>
  </div>';
}

function inp_pass_conf($f=null)
{
  return 
  '<div class="form-group">
  <label for="password_confirmation">Password Confirmation</label>
  <input name="password_confirmation" required type="password" id="password_confirmation" class="form-control" placeholder="Insert Password Confirmation">
  <span class="help-block"><strong></strong></span>
  </div>';
}


function get_date_mask()
{
  return 'data-inputmask="\'alias\': \'yyyy-mm-dd\'" data-mask';
}

function select($name, $placeholder, $data, $additional='', $selected=null)
{
  echo '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <select '.$additional.' id="'.$name.'" name="'.$name.'" class="form-control select2" style="width: 100%;">';
  foreach ($data as $key => $value) {
    if($selected==$key){
      echo '<option value="'.$key.'" selected>'.$value.'</option>';
    }else{
      echo '<option value="'.$key.'">'.$value.'</option>';
    }
  }  
  echo  '</select>
  <span class="help-block"><strong></strong></span>
  </div>';
}