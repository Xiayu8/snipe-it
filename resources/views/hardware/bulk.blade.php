@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('admin/hardware/form.update') }}
@parent
@stop


@section('header_right')
<a href="{{ URL::previous() }}" class="btn btn-sm btn-primary pull-right">
  {{ trans('general.back') }}</a>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">

    <p>{{ trans('admin/hardware/form.bulk_update_help') }}</p>

    <div class="callout callout-warning">
      <i class="fas fa-exclamation-triangle"></i> {{ trans_choice('admin/hardware/form.bulk_update_warn', count($assets), ['asset_count' => count($assets)]) }}
    </div>

    <form class="form-horizontal" method="post" action="{{ route('hardware/bulksave') }}" autocomplete="off" role="form">
      {{ csrf_field() }}

      <div class="box box-default">
        <div class="box-body">
          <!-- Purchase Date
          <div class="form-group {{ $errors->has('purchase_date') ? ' has-error' : '' }}">
            <label for="purchase_date" class="col-md-3 control-label">{{ trans('admin/hardware/form.date') }}</label>
            <div class="col-md-3">
              <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-autoclose="true">
                <input type="text" class="form-control" placeholder="{{ trans('general.select_date') }}" name="purchase_date" id="purchase_date" value="{{ old('purchase_date') }}">
                <span class="input-group-addon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
              </div>
              {!! $errors->first('purchase_date', '<span class="alert-msg"><i class="fas fa-times"></i> :message</span>') !!}
            </div>

            <div class="col-md-3">
              <label>
                {{ Form::checkbox('null_purchase_date', '1', false, ['class' => 'minimal']) }}
                {{ trans_choice('general.set_to_null', count($assets),['asset_count' => count($assets)]) }}
              </label>
            </div>

          </div> -->
          <!-- Expected Checkin Date 
          <div class="form-group {{ $errors->has('expected_checkin') ? ' has-error' : '' }}">
             <label for="expected_checkin" class="col-md-3 control-label">{{ trans('admin/hardware/form.expected_checkin') }}</label>
             <div class="col-md-3">
                  <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-autoclose="true">
                      <input type="text" class="form-control" placeholder="{{ trans('general.select_date') }}" name="expected_checkin" id="expected_checkin" value="{{ old('expected_checkin') }}">
                      <span class="input-group-addon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                 </div>

                 {!! $errors->first('expected_checkin', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
             </div>
              <div class="col-md-6">
                <label>
                  {{ Form::checkbox('null_expected_checkin_date', '1', false, ['class' => 'minimal']) }}
                  {{ trans_choice('general.set_to_null', count($assets), ['asset_count' => count($assets)]) }}
                </label>
              </div>
          </div> -->


          <!-- Status -->
          <div class="form-group {{ $errors->has('status_id') ? ' has-error' : '' }}">
            <label for="status_id" class="col-md-3 control-label">
              {{ trans('admin/hardware/form.status') }}
            </label>
            <div class="col-md-7">
              {{ Form::select('status_id', $statuslabel_list , old('status_id'), array('class'=>'select2', 'style'=>'width:350px', 'aria-label'=>'status_id')) }}
              {!! $errors->first('status_id', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            </div>
          </div>

        @include ('partials.forms.edit.model-select', ['translated_name' => trans('admin/hardware/form.model'), 'fieldname' => 'model_id'])

          <!-- Default Location -->
        @include ('partials.forms.edit.location-select', ['translated_name' => trans('admin/hardware/form.default_location'), 'fieldname' => 'rtd_location_id'])

        <!-- Update actual location  -->
          <div class="form-group">
            <div class="col-md-3"></div>
            <div class="col-md-9">

                <label for="update_real_loc">
                  {{ Form::radio('update_real_loc', '1', old('update_real_loc'), ['class'=>'minimal', 'aria-label'=>'update_real_loc']) }}
                  {{ trans('admin/hardware/form.asset_location_update_default_current') }}
                </label>
                <br>
                <label for="update_default_loc">
                  {{ Form::radio('update_real_loc', '0', old('update_real_loc'), ['class'=>'minimal', 'aria-label'=>'update_default_loc']) }}
                  {{ trans('admin/hardware/form.asset_location_update_default') }}
                </label>

            </div>
          </div> <!--/form-group-->

          @can('superuser')
            <!-- Description -->
          <div class="form-group {{ $errors->has('_snipeit_description_3') ? ' has-error' : '' }}">
              <label for="_snipeit_description_3" class="col-md-3 control-label">
                Description
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_description_3" id="_snipeit_description_3" value="{{ old('_snipeit_description_3') }}" />
                {!! $errors->first('order_number', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>

          <!-- State of Aggregation -->
          <div class="form-group {{ $errors->has('_snipeit_state_of_aggregation_4') ? ' has-error' : '' }}">
              <label for="_snipeit_state_of_aggregation_4" class="col-md-3 control-label">
                State of Aggregation
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_state_of_aggregation_4" id="_snipeit_state_of_aggregation_4" value="{{ old('_snipeit_state_of_aggregation_4') }}" />
                {!! $errors->first('_snipeit_state_of_aggregation_4', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>

              <!-- Quantity -->
          <div class="form-group {{ $errors->has('_snipeit_quantity_5') ? ' has-error' : '' }}">
              <label for="_snipeit_quantity_5" class="col-md-3 control-label">
                Quantity
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_quantity_5" id="_snipeit_quantity_5" value="{{ old('_snipeit_quantity_5') }}" />
                {!! $errors->first('_snipeit_quantity_5', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>

          <!-- Shelf-Nr -->
          <div class="form-group {{ $errors->has('_snipeit_shelf_nr_6') ? ' has-error' : '' }}">
              <label for="_snipeit_shelf_nr_6" class="col-md-3 control-label">
                Shelf-Nr
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_shelf_nr_6" id="_snipeit_shelf_nr_6" value="{{ old('_snipeit_shelf_nr_6') }}" />
                {!! $errors->first('_snipeit_shelf_nr_6', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>

          <!-- haz subst -->
          <div class="form-group {{ $errors->has('_snipeit_haz_subst_7') ? ' has-error' : '' }}">
              <label for="_snipeit_haz_subst_7" class="col-md-3 control-label">
                haz subst
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_haz_subst_7" id="_snipeit_haz_subst_7" value="{{ old('_snipeit_haz_subst_7') }}" />
                {!! $errors->first('_snipeit_haz_subst_7', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>

          <!-- RH -->
          <div class="form-group {{ $errors->has('_snipeit_rh_8') ? ' has-error' : '' }}">
              <label for="_snipeit_rh_8" class="col-md-3 control-label">
                RH
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_rh_8" id="_snipeit_rh_8" value="{{ old('_snipeit_rh_8') }}" />
                {!! $errors->first('_snipeit_rh_8', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>

          <!-- SP -->
          <div class="form-group {{ $errors->has('_snipeit_sp_9') ? ' has-error' : '' }}">
              <label for="_snipeit_sp_9" class="col-md-3 control-label">
                SP
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_sp_9" id="_snipeit_sp_9" value="{{ old('_snipeit_sp_9') }}" />
                {!! $errors->first('_snipeit_sp_9', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>

            <!-- CAS Nr -->
          <div class="form-group {{ $errors->has('_snipeit_cas_nr_10') ? ' has-error' : '' }}">
              <label for="_snipeit_cas_nr_10" class="col-md-3 control-label">
                CAS-Nr
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_cas_nr_10" id="_snipeit_cas_nr_10" value="{{ old('_snipeit_cas_nr_10') }}" />
                {!! $errors->first('_snipeit_cas_nr_10', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div> 

              <!-- PPE -->
          <div class="form-group {{ $errors->has('_snipeit_ppe_12') ? ' has-error' : '' }}">
              <label for="_snipeit_ppe_12" class="col-md-3 control-label">
                PPE
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_ppe_12" id="_snipeit_ppe_12" value="{{ old('_snipeit_ppe_12') }}" />
                {!! $errors->first('_snipeit_ppe_12', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div> 

                <!-- SDS -->
          <div class="form-group {{ $errors->has('_snipeit_sds_13') ? ' has-error' : '' }}">
              <label for="_snipeit_sds_13" class="col-md-3 control-label">
                SDS
              </label>
              <div class="col-md-7">
                <input class="form-control" type="text" maxlength="200" name="_snipeit_sds_13" id="_snipeit_sds_13" value="{{ old('_snipeit_sds_13') }}" />
                {!! $errors->first('_snipeit_sds_13', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div> 
          @endcan

          <!-- Purchase Cost 
          <div class="form-group {{ $errors->has('purchase_cost') ? ' has-error' : '' }}">
            <label for="purchase_cost" class="col-md-3 control-label">
              {{ trans('admin/hardware/form.cost') }}
            </label>
            <div class="input-group col-md-3">
              <span class="input-group-addon">{{ $snipeSettings->default_currency }}</span>
                <input type="text" class="form-control"  maxlength="10" placeholder="{{ trans('admin/hardware/form.cost') }}" name="purchase_cost" id="purchase_cost" value="{{ old('purchase_cost') }}">
                {!! $errors->first('purchase_cost', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            </div>
          </div> -->
          

          <!-- Supplier -->
           @include ('partials.forms.edit.supplier-select', ['translated_name' => trans('general.supplier'), 'fieldname' => 'supplier_id'])
          <!-- Company 
          include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])
          -->
          <!-- Order Number -->
          <div class="form-group {{ $errors->has('order_number') ? ' has-error' : '' }}">
            <label for="order_number" class="col-md-3 control-label">
              {{ trans('admin/hardware/form.order') }}
            </label>
            <div class="col-md-7">
              <input class="form-control" type="text" maxlength="200" name="order_number" id="order_number" value="{{ old('order_number') }}" />
              {!! $errors->first('order_number', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            </div>
          </div>

          <!-- Warranty 
          <div class="form-group {{ $errors->has('warranty_months') ? ' has-error' : '' }}">
            <label for="warranty_months" class="col-md-3 control-label">
              {{ trans('admin/hardware/form.warranty') }}
            </label>
            <div class="col-md-3">
              <div class="input-group">
                <input class="col-md-3 form-control" maxlength="4" type="text" name="warranty_months" id="warranty_months" value="{{ old('warranty_months') }}" />
                <span class="input-group-addon">{{ trans('admin/hardware/form.months') }}</span>
                {!! $errors->first('warranty_months', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
              </div>
            </div>
          </div> -->

          <!-- Requestable 
          <div class="form-group {{ $errors->has('requestable') ? ' has-error' : '' }}">
            <div class="control-label col-md-3">
              <strong>{{ trans('admin/hardware/form.requestable') }}</strong>
            </div>
            <div class="col-md-7">
              <label class="radio">
                <input type="radio" class="minimal" name="requestable" value="1"> {{ trans('general.yes')}}
              </label>
              <label class="radio">
                <input type="radio" class="minimal" name="requestable" value="0"> {{ trans('general.no')}}
              </label>
              <label class="radio">
                <input type="radio" class="minimal" name="requestable" value="" checked> {{ trans('general.do_not_change')}}
              </label>
            </div>
          </div> -->

          @foreach ($assets as $key => $value)
            <input type="hidden" name="ids[{{ $value }}]" value="1">
          @endforeach
        </div> <!--/.box-body-->

        <div class="text-right box-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-check icon-white" aria-hidden="true"></i> {{ trans('general.save') }}</button>
        </div>
      </div> <!--/.box.box-default-->
    </form>
  </div> <!--/.col-md-8-->
</div>
@stop
