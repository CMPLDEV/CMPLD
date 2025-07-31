@if($data->isNotEmpty())
 @foreach($data as $row)
  @php
   $values = explode(',',$row->value);
  @endphp
<div class="row element">

<input type="hidden" name="cat_attr_id[]" value="{{$row->id}}" />    
    
<div class="col-sm-5">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key" value="{{$row->key}}" readonly><label for="floatingInput">Key</label>
</div>
</div>

<div class="col-sm-7">
<div class="form-floating mb-3">
<select class="form-control" name="value[]">
 <option value="none">None</option>
 @foreach($values as $value)
  <option value="{{$value}}">{{$value}}</option>
 @endforeach
</select>    
<label for="floatingInput">Value</label>
</div>
</div>

</div>
  @endforeach
 @endif