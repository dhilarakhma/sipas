@php
$is_required          = isset($required) ? ($required ? 'required="required"' : '') : 'required="required"';
$is_required2         = isset($required) ? ($required ? '<span class="text-danger">*</span>' : '') : '<span class="text-danger">*</span>';
$is_max               = isset($max) ? 'max="'.$max.'"' : '';
$is_min               = isset($min) ? 'min="'.$min.'"' : '';
$is_readonly          = isset($readonly) ? 'readonly="'.$readonly.'"' : '';
$is_disabled          = isset($disabled) ? 'disabled="'.$disabled.'"' : '';
$is_accept            = isset($accept) ? 'accept="'.$accept.'"' : '';
$is_type              = $type ?? 'text';
$is_type              = 'type="'.$is_type.'"';
$name_temp            = $name ?? $id;
$is_name              = 'name="'.$name_temp.'"';
$value_temp           = $value ?? old($name_temp);
$is_value             = old($name_temp) ? 'value="'.old($name_temp).'"' : ($value_temp ? 'value="'.$value_temp.'"' : '');
$is_ikon              = isset($ikon) ? ((strpos($ikon, 'fa-') !== false) ? '<i class="'.$ikon.'"></i>' : $ikon) : '';
$is_ikon2             = isset($ikon2) ? ((strpos($ikon2, 'fa-') !== false) ? '<i class="'.$ikon2.'"></i>' : $ikon2) : '';
$status_class         = (count($errors->all()) > 0) ? ($errors->has($name_temp) ? 'is-invalid' : 'is-valid' ) : '';
$feedback             = $errors->has($name_temp) ? '<span class="invalid-feedback">'.$errors->first($name_temp).'</span>' : '<span class="valid-feedback">Data sudah benar</span>';
$is_label             = isset($label) ? $label : \Str::title(str_replace('_', ' ', $name_temp));
$is_class_append      = $class_append ?? '';
@endphp

<div class="form-group">
  <label for="{{ $id }}">{{ $is_label }} {!! $is_required2 !!}</label>
  
  <select {!! $is_required !!} class="form-control {{ $status_class }} {{ $is_class_append }}" {!! $is_name !!} id="{{ $id }}">
    @foreach ($select_data as $option => $optionText)
    <option @if($value_temp == $option) selected="selected" @endif value="{{ $option }}">{{ $optionText }}</option>
    @endforeach
  </select>

  {!! $feedback !!}

</div>

