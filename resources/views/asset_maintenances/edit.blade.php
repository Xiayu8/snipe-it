@extends('layouts/default')

{{-- Page title --}}
@section('title')
  @if ($item->id)
    {{ trans('admin/asset_maintenances/form.update') }}
  @else
    {{ trans('admin/asset_maintenances/form.create') }}
  @endif
  @parent
@stop


@section('header_right')
<a href="{{ URL::previous() }}" class="btn btn-primary pull-right">
  {{ trans('general.back') }}</a>
@stop


{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-9">
    @if ($item->id)
      <form class="form-horizontal" method="post" action="{{ route('maintenances.update', $item->id) }}" autocomplete="off">
      {{ method_field('PUT') }}
    @else
      <form class="form-horizontal" method="post" action="{{ route('maintenances.store') }}" autocomplete="off">
    @endif
    <!-- CSRF Token -->
    {{ csrf_field() }}

    <div class="box box-default">
      <div class="box-header with-border">
        <h2 class="box-title">
          @if ($item)
          {{ $item->name }}
          @endif
        </h2>
      </div><!-- /.box-header -->

      <div class="box-body">
        @include ('partials.forms.edit.asset-select', ['translated_name' => trans('admin/hardware/table.asset_tag'), 'fieldname' => 'asset_id', 'required' => 'true'])

        <!-- Maintenace Type (hidden, fixed Maintenance)-->
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" hidden>
          <label for="asset_maintenance_type" class="col-md-3 control-label">
            {{ trans('admin/asset_maintenances/form.asset_maintenance_type') }}
          </label>
          <div class="col-md-7">
            <input class="form-control" type="text" name="asset_maintenance_type" id="asset_maintenance_type" aria-label="asset_maintenance_type" value="Maintenance" />
            {!! $errors->first('asset_maintenance_type', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
        </div>

        <!-- Supplier (hidden, fixed n.a.)-->
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" hidden>
          <label for="supplier_id" class="col-md-3 control-label">
            {{ trans('general.supplier') }}
          </label>
          <div class="col-md-7">
            <input class="form-control" type="text" name="supplier_id" id="supplier_select" aria-label="supplier_id" value=2 />
            {!! $errors->first('supplier_id', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
        </div>

        <!-- Title -->
        <div class="form-group {{ $errors->has('supplier_id') ? ' has-error' : '' }}">
          <label for="title" class="col-md-3 control-label">
            {{ trans('admin/asset_maintenances/form.title') }}
          </label>
          <div class="col-md-7{{  (Helper::checkIfRequired($item, 'title')) ? ' required' : '' }}">
          <input class="form-control" type="text" name="title" id="title" placeholder="purpose (e.g., LPF Harz, Mediumherstellung)" 
            {!! $errors->first('title', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
        </div>

        <!-- Completion Date
        <div class="form-group {{ $errors->has('completion_date') ? ' has-error' : '' }}">
          <label for="start_date" class="col-md-3 control-label">{{ trans('admin/asset_maintenances/form.completion_date') }}</label>

          <div class="input-group col-md-3{{  (Helper::checkIfRequired($item, 'completion_date')) ? ' required' : '' }}">
            <div class="input-group date" data-date-clear-btn="true" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-autoclose="true">
              <input type="text" class="form-control" placeholder="{{ trans('general.select_date') }}" name="completion_date" id="completion_date" value="{{ old('completion_date', $item->completion_date) }}">
              <span class="input-group-addon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
            </div>
            {!! $errors->first('completion_date', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
        </div>-->

        <!-- Warranty
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="1" name="is_warranty" id="is_warranty" {{ Request::old('is_warranty', $item->is_warranty) == '1' ? ' checked="checked"' : '' }} class="minimal"> {{ trans('admin/asset_maintenances/form.is_warranty') }}
              </label>
            </div>
          </div>
        </div>-->

        <!-- Asset Maintenance Cost
        <div class="form-group {{ $errors->has('cost') ? ' has-error' : '' }}">
          <label for="cost" class="col-md-3 control-label">{{ trans('admin/asset_maintenances/form.cost') }}</label>
          <div class="col-md-2">
            <div class="input-group">
              <span class="input-group-addon">
                @if (($item->asset) && ($item->asset->location) && ($item->asset->location->currency!=''))
                  {{ $item->asset->location->currency }}
                @else
                  {{ $snipeSettings->default_currency }}
                @endif
              </span>
              <input class="col-md-2 form-control" type="text" name="cost" id="cost" value="{{ old('cost', Helper::formatCurrencyOutput($item->cost)) }}" />
              {!! $errors->first('cost', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            </div>
          </div>
        </div>-->

        <!-- Notes -->
        <div class="form-group {{ $errors->has('notes') ? ' has-error' : '' }}">
          <label for="notes" class="col-md-3 control-label">{{ trans('admin/asset_maintenances/form.notes') }}</label>
          <div class="col-md-7">
          <textarea class="col-md-6 form-control" id="notes" placeholder="any additional information (optional)" name="notes">{{ old('notes', $item->notes) }}</textarea>
            {!! $errors->first('notes', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
        </div>

                <!-- old weight -->
      <div class="form-group {{ $errors->has('old_weight') ? ' has-error' : '' }}">
          <label for="old_weight" class="col-md-3 control-label">Old Weight</label>
          <div class="col-md-5">
          <div class="input-group">
              <span class="input-group-addon">
                [g]
              </span>
            <input class="col-md-6 form-control" id="old_weight" name="old_weight" placeholder="1234,56789" value="{{ old('old_weight', \App\Helpers\Helper::formatWeightOutput($item->old_weight)) }}"</input>
            {!! $errors->first('old_weight', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
        </div>

      </div> <!-- .box-body -->

      <!-- new weight -->
      <div class="form-group {{ $errors->has('new_weight') ? ' has-error' : '' }}">
          <label for="new_weight" class="col-md-3 control-label">New Weight</label>
          <div class="col-md-5">
          <div class="input-group">
              <span class="input-group-addon">
                [g]
              </span>
            <input class="col-md-6 form-control" id="new_weight" name="new_weight" placeholder="1234,56789" value="{{ old('new_weight', \App\Helpers\Helper::formatWeightOutput($item->new_weight)) }}"></input>
            {!! $errors->first('new_weight', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
          <p class="help-block">
          Use suitable scale to measure the difference in weight!
      </p>
        </div>
      </div> <!-- .box-body -->

       <!-- Start Date -->
       <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
          <label for="start_date" class="col-md-3 control-label">Date</label>

          <div class="input-group col-md-3{{  (Helper::checkIfRequired($item, 'start_date')) ? ' required' : '' }}">
            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-autoclose="true" data-date-clear-btn="true">
              <input type="text" class="form-control" placeholder="{{ trans('general.select_date') }}" name="start_date" id="start_date" value="{{ old('start_date', ($item->start_date) ? $item->start_date : Carbon::now()->format('Y-m-d')) }}">
              <span class="input-group-addon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
            </div>
            {!! $errors->first('start_date', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
          </div>
        </div>

      <div class="box-footer text-right">
        <button type="submit" class="btn btn-success"><i class="fas fa-check icon-white" aria-hidden="true"></i> {{ trans('general.save') }}</button>
      </div>
    </div> <!-- .box-default -->
    </form>
  </div>
</div>

@stop
