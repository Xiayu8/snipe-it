@if (($model) && ($model->fieldset))
  @foreach($model->fieldset->fields AS $field)
    <div class="form-group{{ $errors->has($field->db_column_name()) ? ' has-error' : '' }}">
      <label for="{{ $field->db_column_name() }}" class="col-md-3 control-label">{{ $field->name }} </label>
      <div class="col-md-7 col-sm-12{{ ($field->pivot->required=='1') ? ' required' : '' }}">


          @if ($field->element!='text')
              <!-- Listbox -->
              @if ($field->element=='listbox')
                   {{ Form::select($field->db_column_name(), $field->formatFieldValuesAsArray(),
                  Request::old($field->db_column_name(),(isset($item) ? Helper::gracefulDecrypt($field, htmlspecialchars($item->{$field->db_column_name()}, ENT_QUOTES)) : $field->defaultValue($model->id))), ['class'=>'format select2 form-control']) }}

              @elseif ($field->element=='textarea')
                  <textarea class="col-md-6 form-control" id="{{ $field->db_column_name() }}" name="{{ $field->db_column_name() }}">{{ Request::old($field->db_column_name(),(isset($item) ? Helper::gracefulDecrypt($field, $item->{$field->db_column_name()}) : $field->defaultValue($model->id))) }}</textarea>

              @elseif ($field->element=='checkbox')
                    <!-- Checkboxes -->
                  @foreach ($field->formatFieldValuesAsArray() as $key => $value)
                      <div>
                          <label>
                              <p>
                              <input type="checkbox" value="{{ $value }}" name="{{ $field->db_column_name() }}[]" class="minimal" {{  isset($item) ? (in_array($value, array_map('trim', explode(',', $item->{$field->db_column_name()}))) ? ' checked="checked"' : '') : (Request::old($field->db_column_name()) != '' ? ' checked="checked"' : (in_array($key, array_map('trim', explode(',', $field->defaultValue($model->id)))) ? ' checked="checked"' : '')) }}>
                                <?php
                                    $ghs = array ("M003" => "ISO_7010_M003.svg", "M004" => "ISO_7010_M004.svg", "M009" => "ISO_7010_M009.svg", "M010" => "ISO_7010_M010.svg",
                                                    "M011" => "ISO_7010_M011.svg", "M013" => "ISO_7010_M013.svg", "M014" => "ISO_7010_M014.svg",
                                                    "M016" => "ISO_7010_M016.svg", "M017" => "ISO_7010_M017.svg", "M018" => "ISO_7010_M018.svg", "M019" => "ISO_7010_M019.svg");
                                    foreach ($ghs as $key => $val){
                                        if (strpos($value, $key) !== false){
                                            echo '<img style="height: 35px; width: 35px;" src="https://Chemikalienliste/uploads/'.$val.'" alt="'.$key.'">';
                                        }
                                    }
                              ?>
                              {{ $value }}
                              </p>
                          </label>
                      </div>
                  @endforeach

              @elseif ($field->element=='radio')
              @foreach ($field->formatFieldValuesAsArray() as $value)

              <div>
                  <label>
                      <input type="radio" value="{{ $value }}" name="{{ $field->db_column_name() }}" class="minimal" {{ isset($item) ? ($item->{$field->db_column_name()} == $value ? ' checked="checked"' : '') : (Request::old($field->db_column_name()) != '' ? ' checked="checked"' : (in_array($value, explode(', ', $field->defaultValue($model->id))) ? ' checked="checked"' : '')) }}>
                      {{ $value }}
                  </label>
              </div>
          @endforeach

              @endif


          @else
            <!-- Date field -->

                @if ($field->format=='DATE')

                        <div class="input-group col-md-5" style="padding-left: 0px;">
                            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-autoclose="true" data-date-clear-btn="true">
                                <input type="text" class="form-control" placeholder="{{ trans('general.select_date') }}" name="{{ $field->db_column_name() }}" id="{{ $field->db_column_name() }}" readonly value="{{ old($field->db_column_name(),(isset($item) ? Helper::gracefulDecrypt($field, $item->{$field->db_column_name()}) : $field->defaultValue($model->id))) }}"  style="background-color:inherit">
                                <span class="input-group-addon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                            </div>
                        </div>


                @else
                    @if (($field->field_encrypted=='0') || (Gate::allows('admin')))
                    <input type="text" value="{{ Request::old($field->db_column_name(),(isset($item) ? Helper::gracefulDecrypt($field, $item->{$field->db_column_name()}) : $field->defaultValue($model->id))) }}" id="{{ $field->db_column_name() }}" class="form-control" name="{{ $field->db_column_name() }}" placeholder="Enter {{ strtolower($field->format) }} text">
                        @else
                            <input type="text" value="{{ strtoupper(trans('admin/custom_fields/general.encrypted')) }}" class="form-control disabled" disabled>
                    @endif
                @endif

          @endif

              @if ($field->help_text!='')
              <p class="help-block">{{ $field->help_text }}</p>
              @endif

          <?php
          $errormessage=$errors->first($field->db_column_name());
          if ($errormessage) {
              $errormessage=preg_replace('/ snipeit /', '', $errormessage);
              print('<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> '.$errormessage.'</span>');
          }
            ?>
      </div>

        @if ($field->field_encrypted)
        <div class="col-md-1 col-sm-1 text-left">
            <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/custom_fields/general.value_encrypted') }}"></i>
        </div>
        @endif


    </div>
  @endforeach
@endif
