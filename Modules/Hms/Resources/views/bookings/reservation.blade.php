@extends('layouts.auth')
@section('title', __('hms::lang.add_bookings'))
@section('content')
    <!-- Main content -->
    <section class="content">
    <div class="row">
       <div class="col-md-12">
  @php
    $form_id = 'contact_add_form';
    if(isset($quick_add)){
      $form_id = 'quick_add_contact';
    }

    if(isset($store_action)) {
      $url = $store_action;
      $type = 'lead';
      $customer_groups = [];
    } else {
      $url = action([\App\Http\Controllers\ContactController::class, 'store']);
      $type = isset($selected_type) ? $selected_type : '';
      $sources = [];
      $life_stages = [];
    }
  @endphp
    {!! Form::open(['url' => $url, 'method' => 'post', 'id' => $form_id ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang('contact.add_contact')</h4>
    </div>

    <div class="modal-body">
        <div class="row">            
            <div class="col-md-4 contact_type_div">
                <div class="form-group">
                    {!! Form::label('type', __('contact.contact_type') . ':*' ) !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        {!! Form::select('type', $types, $type , ['class' => 'form-control', 'id' => 'contact_type','placeholder' => __('messages.please_select'), 'required']); !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-15">
                <label class="radio-inline">
                    <input type="radio" name="contact_type_radio_guest" id="inlineRadio1" value="individual">
                    @lang('lang_v1.individual')
                </label>
                <label class="radio-inline">
                    <input type="radio" name="contact_type_radio_guest" id="inlineRadio2" value="business">
                    @lang('business.business')
                </label>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('contact_id', __('lang_v1.contact_id') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-id-badge"></i>
                        </span>
                        {!! Form::text('contact_id', null, ['class' => 'form-control','placeholder' => __('lang_v1.contact_id')]); !!}
                    </div>
                    <p class="help-block">
                        @lang('lang_v1.leave_empty_to_autogenerate')
                    </p>
                </div>
            </div>
            <div class="col-md-4 customer_fields">
                <div class="form-group">
                  {!! Form::label('customer_group_id', __('lang_v1.customer_group') . ':') !!}
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="fa fa-users"></i>
                      </span>
                      {!! Form::select('customer_group_id', $customer_groups, '', ['class' => 'form-control']); !!}
                  </div>
                </div>
            </div>
            <div class="clearfix customer_fields"></div>
            <div class="col-md-4 business" style="display: none;">
                <div class="form-group">
                    {!! Form::label('supplier_business_name', __('business.business_name') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        {!! Form::text('supplier_business_name', null, ['class' => 'form-control', 'placeholder' => __('business.business_name')]); !!}
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group">
                    {!! Form::label('prefix', __( 'business.prefix' ) . ':') !!}
                    {!! Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group">
                    {!! Form::label('first_name', __( 'business.first_name' ) . ':*') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group">
                    {!! Form::label('middle_name', __( 'lang_v1.middle_name' ) . ':') !!}
                    {!! Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.middle_name' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group">
                    {!! Form::label('last_name', __( 'business.last_name' ) . ':') !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); !!}
                </div>
            </div>
            <div class="clearfix"></div>
        
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('mobile', __('contact.mobile') . ':*') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </span>
                        {!! Form::text('mobile', null, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); !!}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('alternate_number', __('contact.alternate_contact_number') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </span>
                        {!! Form::text('alternate_number', null, ['class' => 'form-control', 'placeholder' => __('contact.alternate_contact_number')]); !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('landline', __('contact.landline') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </span>
                        {!! Form::text('landline', null, ['class' => 'form-control', 'placeholder' => __('contact.landline')]); !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('email', __('business.email') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        {!! Form::email('email', null, ['class' => 'form-control','placeholder' => __('business.email')]); !!}
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4 individual" style="display: none;">
                <div class="form-group">
                    {!! Form::label('dob', __('lang_v1.dob') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        
                        {!! Form::text('dob', null, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); !!}
                    </div>
                </div>
            </div>

            <!-- lead additional field -->
            <div class="col-md-4 lead_additional_div">
              <div class="form-group">
                  {!! Form::label('crm_source', __('lang_v1.source') . ':' ) !!}
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="fas fa fa-search"></i>
                      </span>
                      {!! Form::select('crm_source', $sources, null , ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]); !!}
                  </div>
              </div>
            </div>
            
            <div class="col-md-4 lead_additional_div">
              <div class="form-group">
                  {!! Form::label('crm_life_stage', __('lang_v1.life_stage') . ':' ) !!}
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="fas fa fa-life-ring"></i>
                      </span>
                      {!! Form::select('crm_life_stage', $life_stages, null , ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]); !!}
                  </div>
              </div>
            </div>

            <!-- User in create leads -->
            <div class="col-md-6 lead_additional_div">
                  <div class="form-group">
                      {!! Form::label('user_id', __('lang_v1.assigned_to') . ':*' ) !!}
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="fa fa-user"></i>
                          </span>
                          {!! Form::select('user_id[]', $users ?? [], null , ['class' => 'form-control select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 100%;']); !!}
                      </div>
                  </div>
            </div>

            <!-- User in create customer & supplier -->
            @if(config('constants.enable_contact_assign') && $type !== 'lead')
                <div class="col-md-6">
                      <div class="form-group">
                          {!! Form::label('assigned_to_users', __('lang_v1.assigned_to') . ':' ) !!}
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="fa fa-user"></i>
                              </span>
                              {!! Form::select('assigned_to_users[]', $users ?? [], null , ['class' => 'form-control select2', 'id' => 'assigned_to_users', 'multiple', 'style' => 'width: 100%;']); !!}
                          </div>
                      </div>
                </div>
            @endif

            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary center-block more_btn" data-target="#more_div">@lang('lang_v1.more_info') <i class="fa fa-chevron-down"></i></button>
            </div>

            <div id="more_div" class="hide">
                {!! Form::hidden('position', null, ['id' => 'position']); !!}
                <div class="col-md-12"><hr/></div>

                <div class="col-md-4">
                    <div class="form-group">
                      {!! Form::label('tax_number', __('contact.tax_no') . ':') !!}
                        <div class="input-group">
                          <span class="input-group-addon">
                              <i class="fa fa-info"></i>
                          </span>
                          {!! Form::text('tax_number', null, ['class' => 'form-control', 'placeholder' => __('contact.tax_no')]); !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 opening_balance">
                  <div class="form-group">
                      {!! Form::label('opening_balance', __('lang_v1.opening_balance') . ':') !!}
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="fas fa-money-bill-alt"></i>
                          </span>
                          {!! Form::text('opening_balance', 0, ['class' => 'form-control input_number']); !!}
                      </div>
                  </div>
                </div>

                <div class="col-md-4 pay_term">
                  <div class="form-group">
                    <div class="multi-input">
                      {!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!} @show_tooltip(__('tooltip.pay_term'))
                      <br/>
                      {!! Form::number('pay_term_number', null, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]); !!}

                      {!! Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], '', ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]); !!}
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                @php
                  $common_settings = session()->get('business.common_settings');
                  $default_credit_limit = !empty($common_settings['default_credit_limit']) ? $common_settings['default_credit_limit'] : null;
                @endphp
                <div class="col-md-4 customer_fields">
                  <div class="form-group">
                      {!! Form::label('credit_limit', __('lang_v1.credit_limit') . ':') !!}
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="fas fa-money-bill-alt"></i>
                          </span>
                          {!! Form::text('credit_limit', $default_credit_limit ?? null, ['class' => 'form-control input_number']); !!}
                      </div>
                      <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
                  </div>
                </div>
                

                <div class="col-md-12"><hr/></div>
                <div class="clearfix"></div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('address_line_1', __('lang_v1.address_line_1') . ':') !!}
                        {!! Form::text('address_line_1', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_1'), 'rows' => 3]); !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('address_line_2', __('lang_v1.address_line_2') . ':') !!}
                        {!! Form::text('address_line_2', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_2'), 'rows' => 3]); !!}
                    </div>
                </div>
                <div class="clearfix"></div>
              <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('city', __('business.city') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('business.city')]); !!}
                    </div>
                </div>
              </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('state', __('business.state') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('business.state')]); !!}
                </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('country', __('business.country') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </span>
                    {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('business.country')]); !!}
                </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('zip_code', __('business.zip_code') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    {!! Form::text('zip_code', null, ['class' => 'form-control', 
                    'placeholder' => __('business.zip_code_placeholder')]); !!}
                </div>
            </div>
          </div>

          <div class="clearfix"></div>
          <div class="col-md-12">
            <hr/>
          </div>
          @php
            $custom_labels = json_decode(session('business.custom_labels'), true);
            $contact_custom_field1 = !empty($custom_labels['contact']['custom_field_1']) ? $custom_labels['contact']['custom_field_1'] : __('lang_v1.contact_custom_field1');
            $contact_custom_field2 = !empty($custom_labels['contact']['custom_field_2']) ? $custom_labels['contact']['custom_field_2'] : __('lang_v1.contact_custom_field2');
            $contact_custom_field3 = !empty($custom_labels['contact']['custom_field_3']) ? $custom_labels['contact']['custom_field_3'] : __('lang_v1.contact_custom_field3');
            $contact_custom_field4 = !empty($custom_labels['contact']['custom_field_4']) ? $custom_labels['contact']['custom_field_4'] : __('lang_v1.contact_custom_field4');
            $contact_custom_field5 = !empty($custom_labels['contact']['custom_field_5']) ? $custom_labels['contact']['custom_field_5'] : __('lang_v1.custom_field', ['number' => 5]);
            $contact_custom_field6 = !empty($custom_labels['contact']['custom_field_6']) ? $custom_labels['contact']['custom_field_6'] : __('lang_v1.custom_field', ['number' => 6]);
            $contact_custom_field7 = !empty($custom_labels['contact']['custom_field_7']) ? $custom_labels['contact']['custom_field_7'] : __('lang_v1.custom_field', ['number' => 7]);
            $contact_custom_field8 = !empty($custom_labels['contact']['custom_field_8']) ? $custom_labels['contact']['custom_field_8'] : __('lang_v1.custom_field', ['number' => 8]);
            $contact_custom_field9 = !empty($custom_labels['contact']['custom_field_9']) ? $custom_labels['contact']['custom_field_9'] : __('lang_v1.custom_field', ['number' => 9]);
            $contact_custom_field10 = !empty($custom_labels['contact']['custom_field_10']) ? $custom_labels['contact']['custom_field_10'] : __('lang_v1.custom_field', ['number' => 10]);
          @endphp
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field1', $contact_custom_field1 . ':') !!}
                {!! Form::text('custom_field1', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field1]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field2', $contact_custom_field2 . ':') !!}
                {!! Form::text('custom_field2', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field2]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field3', $contact_custom_field3 . ':') !!}
                {!! Form::text('custom_field3', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field3]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field4', $contact_custom_field4 . ':') !!}
                {!! Form::text('custom_field4', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field4]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field5', $contact_custom_field5 . ':') !!}
                {!! Form::text('custom_field5', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field5]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field6', $contact_custom_field6 . ':') !!}
                {!! Form::text('custom_field6', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field6]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field7', $contact_custom_field7 . ':') !!}
                {!! Form::text('custom_field7', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field7]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field8', $contact_custom_field8 . ':') !!}
                {!! Form::text('custom_field8', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field8]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field9', $contact_custom_field9 . ':') !!}
                {!! Form::text('custom_field9', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field9]); !!}
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('custom_field10', $contact_custom_field10 . ':') !!}
                {!! Form::text('custom_field10', null, ['class' => 'form-control', 
                    'placeholder' => $contact_custom_field10]); !!}
            </div>
          </div>
          <div class="col-md-12 shipping_addr_div"><hr></div>
          <div class="col-md-8 col-md-offset-2 shipping_addr_div mb-10" >
              <strong>{{__('lang_v1.shipping_address')}}</strong><br>
              {!! Form::text('shipping_address', null, ['class' => 'form-control', 
                    'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); !!}
            <div class="mb-10" id="map"></div>
          </div>
          @php
                $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1']) ? $custom_labels['shipping']['custom_field_1'] : '';

                $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2']) ? $custom_labels['shipping']['custom_field_2'] : '';

                $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3']) ? $custom_labels['shipping']['custom_field_3'] : '';

                $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4']) ? $custom_labels['shipping']['custom_field_4'] : '';

                $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5']) ? $custom_labels['shipping']['custom_field_5'] : '';
            @endphp

            @if(!empty($custom_labels['shipping']['is_custom_field_1_contact_default']) && !empty($shipping_custom_label_1))
                @php
                    $label_1 = $shipping_custom_label_1 . ':';
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('shipping_custom_field_1', $label_1 ) !!}
                        {!! Form::text('shipping_custom_field_details[shipping_custom_field_1]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_1]); !!}
                    </div>
                </div>
            @endif
            @if(!empty($custom_labels['shipping']['is_custom_field_2_contact_default']) && !empty($shipping_custom_label_2))
                @php
                    $label_2 = $shipping_custom_label_2 . ':';
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('shipping_custom_field_2', $label_2 ) !!}
                        {!! Form::text('shipping_custom_field_details[shipping_custom_field_2]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_2]); !!}
                    </div>
                </div>
            @endif
            @if(!empty($custom_labels['shipping']['is_custom_field_3_contact_default']) && !empty($shipping_custom_label_3))
                @php
                    $label_3 = $shipping_custom_label_3 . ':';
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('shipping_custom_field_3', $label_3 ) !!}
                        {!! Form::text('shipping_custom_field_details[shipping_custom_field_3]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_3]); !!}
                    </div>
                </div>
            @endif
            @if(!empty($custom_labels['shipping']['is_custom_field_4_contact_default']) && !empty($shipping_custom_label_4))
                @php
                    $label_4 = $shipping_custom_label_4 . ':';
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('shipping_custom_field_4', $label_4 ) !!}
                        {!! Form::text('shipping_custom_field_details[shipping_custom_field_4]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_4]); !!}
                    </div>
                </div>
            @endif
            @if(!empty($custom_labels['shipping']['is_custom_field_5_contact_default']) && !empty($shipping_custom_label_5))
                @php
                    $label_5 = $shipping_custom_label_5 . ':';
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('shipping_custom_field_5', $label_5 ) !!}
                        {!! Form::text('shipping_custom_field_details[shipping_custom_field_5]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_5]); !!}
                    </div>
                </div>
            @endif
            @if(!empty($common_settings['is_enabled_export']))
                <div class="col-md-12 mb-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_export" class="form-check-input" id="is_customer_export">
                        <label class="form-check-label" for="is_customer_export">@lang('lang_v1.is_export')</label>
                    </div>
                </div>
                @php
                    $i = 1;
                @endphp
                @for($i; $i <= 6 ; $i++)
                    <div class="col-md-4 export_div" style="display: none;">
                        <div class="form-group">
                            {!! Form::label('export_custom_field_'.$i, __('lang_v1.export_custom_field'.$i).':' ) !!}
                            {!! Form::text('export_custom_field_'.$i, null, ['class' => 'form-control','placeholder' => __('lang_v1.export_custom_field'.$i)]); !!}
                        </div>
                    </div>
                @endfor
            @endif
            </div>
        </div>
        @include('layouts.partials.module_form_part')
    </div>
    
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}
  



        </div>
    </div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
    {{-- <script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script> --}}

 
    
    <script>
        $(document).ready(function() {
            var current_index = 0;
            var row = null;
            var coupon_id = null;
            var discount_type = null;

            $('.add-room').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('booking_room_add') }}",
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_room')
                            .html(result)
                            .modal('show');
                    },
                });
            });

            $(".view_modal_room").on("show.bs.modal", function() {
                $("#add_booking_room").submit(function(event) {
                    current_index++;
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('get_room_detail') }}",
                        dataType: 'html',
                        data: {
                            'current_index' : current_index, 
                            'type_id': $('#type').val(),
                            'room_id': $('#room_no').val(),
                            'no_of_child': $('#no_of_child').val(),
                            'no_of_adult': $('#no_of_adult').val(),
                            'arrival_date': $('#arrival_date').val(),
                            'departure_date': $('#departure_date').val(),
                        },
                        success: function(result) {
                            $('.booking_add_room table tbody').append(result);
                            calculateAllPrice();
                        },
                    });

                    $('.view_modal_room').modal('hide');
                    return false
                });


                $("#edit_booking_room").submit(function(event) {
                    current_index++;
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('get_room_detail') }}",
                        dataType: 'html',
                        data: {
                            'current_index' : current_index, 
                            'type_id': $('#type').val(),
                            'room_id': $('#room_no').val(),
                            'no_of_child': $('#no_of_child').val(),
                            'no_of_adult': $('#no_of_adult').val(),
                            'arrival_date': $('#arrival_date').val(),
                            'departure_date': $('#departure_date').val(),
                            'is_edit': true,
                        },
                        success: function(result) {
                            row.html(result);
                            calculateAllPrice();
                        },
                    });

                    $('.view_modal_room').modal('hide');
                    return false
                });

                $('#type').on('change', function(){
                    var roomIds = []; // Array to store the room_ids
                    $('.room-id-input').each(function () {
                        var roomId = $(this).val();
                        roomIds.push(roomId);
                    });
                    
                    $.ajax({
                        url: "{{ route('get_room_type_by') }}",
                        dataType: 'html',
                        data: {
                        'type_id': $(this).val(),
                        'arrival_date': $('#arrival_date').val(),
                        'departure_date': $('#departure_date').val(),
                        'arrival_time': $('#arrival_time').val(),
                        'departure_time': $('#departure_time').val(),
                        'room_ids': roomIds,
                        },
                        success: function(result) {
                            $('.modify_field').html(result);
                            // calculateAllPrice();
                        },
                    });
                    
                });
            });

            var currentDate = new Date();
            var currentDateTime = moment(currentDate);

            $('.date_picker').datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
                defaultDate: currentDateTime
            });

            var bookingDate = "{{ request()->input('booking_date') }}";

            if(!bookingDate){
                $('.departure_date').datetimepicker({
                    format: moment_date_format,
                    ignoreReadonly: true,
                    defaultDate: currentDateTime,
                    minDate:currentDateTime,
                });  
            }else{
                $('.departure_date').datetimepicker({
                    format: moment_date_format,
                    ignoreReadonly: true,
                    defaultDate: currentDateTime,
                });
            }

            var initialDate;
            var previousDate;
            var changeEventBound = true;
            
            $('.date_picker').on('dp.change', function (e) {
                if (!changeEventBound) {
                    return;
                }
                
                var selectedDate = e.date;
                previousDate = e.oldDate;

                if (!initialDate) {
                    initialDate = selectedDate;
                }

                // Update the minimum date of the departure datepicker
                var rowCount = $(".booking_add_room table tbody tr").length;

                if(rowCount > 0){
                    changeEventBound = false;
                    swal({
                        text: "{{ __('hms::lang.changing_date_will_reset_rooms_selection_do_you_want_to_continue') }} ",
                        title: "{{ __('hms::lang.are_you_sure') }}",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((confirmed) => {
                        if (confirmed) {
                            // Perform deletion logic here
                            $(".booking_add_room table tbody tr").remove();
                            $('#coupon_code').val('');
                            initialDate = selectedDate;
                            $('.departure_date').data('DateTimePicker').minDate(selectedDate);
                            calculateAllPrice();
                        } else {
                            initialDate = previousDate;
                            $('.date_picker').data("DateTimePicker").date(previousDate);
                        }
                        changeEventBound = true;
                    });
                }else{
                    $('.departure_date').data('DateTimePicker').minDate(selectedDate);
                    calculateAllPrice();
                }

            });

            var initialDate;
            var previousDate;
            var changeEventBound = true;

            var previousValue = $('#departure_date').val();

            $('#departure_date').on('dp.change', function (e) {

                if (!changeEventBound) {
                    return;
                }
                
                var selectedDate = e.date;
                previousDate = e.oldDate;

                if (!initialDate) {
                    initialDate = selectedDate;
                }

                // Update the minimum date of the departure datepicker
                var rowCount = $(".booking_add_room table tbody tr").length;

                var currentValue = $('#departure_date').val();

                if(rowCount > 0 && currentValue !== previousValue){
                    changeEventBound = false;
                    swal({
                        text: " {{ __('hms::lang.changing_date_will_reset_rooms_selection_do_you_want_to_continue') }} ",
                        title: "{{ __('hms::lang.are_you_sure') }}",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((confirmed) => {
                        if (confirmed) {
                            // Perform deletion logic here
                            $(".booking_add_room table tbody tr").remove();
                            initialDate = selectedDate;
                            $('#departure_date').data('DateTimePicker').minDate(selectedDate);
                            $('#coupon_code').val('');
                            calculateAllPrice();
                        } else {
                            initialDate = previousDate;
                            $('#departure_date').data("DateTimePicker").date(previousDate);
                        }
                        changeEventBound = true;
                    });
                }else{
                    calculateAllPrice();
                }
            });


            $('.time_picker').datetimepicker({
                format: moment_time_format,
                ignoreReadonly: true,
                defaultDate: moment(),
            });

            // Remove row functionality
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                swal({
                    title: "{{ __('hms::lang.delete_booking_room') }}",
                    text: "{{ __('hms::lang.are_you_sure_you_want_to_delete_selected_items') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((confirmed) => {
                    if (confirmed) {
                        $(this).closest('tr').remove();
                        calculateAllPrice();
                    }
                });
            });

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                current_index ++;
                row = $(this).closest('tr');
                var type_id = row.find('input[name^="rooms["][name$="][type_id]"]').val();
                var room_id = row.find('input[name^="rooms["][name$="][room_id]"]').val();
                var no_of_adult = row.find('input[name^="rooms["][name$="][no_of_adult]"]').val();
                var no_of_child = row.find('input[name^="rooms["][name$="][no_of_child]"]').val();
                var roomIds = []; // Array to store the room_ids
                $('.room-id-input').each(function () {
                    var roomId = $(this).val();
                    roomIds.push(roomId);
                });
                // console.log(roomIds); edit_booking_room
                $.ajax({
                    url: "{{ route('booking_room_edit') }}",
                    dataType: 'html',
                    data: {
                        'type_id': type_id,
                        'room_id': room_id,
                        'no_of_adult': no_of_adult,
                        'no_of_child': no_of_child,
                        'room_ids':roomIds,
                    },
                    success: function(result) {
                        $('.view_modal_room')
                            .html(result)
                            .modal('show');
                    },
                });
            });
            $(document).on('click', '.price_calculate, .extra', function(){
                calculateAllPrice();
            });

            $('.status').on('change', function(){
                if($(this).val() == 'cancelled'){
                    $('.status-heading').css('background-color', 'red');
                    $('.status_value').html("Cancelled");
                } else if($(this).val() == 'confirmed'){
                    $('.status_value').html("Confirmed");
                    $('.status-heading').css('background-color', 'green');
                } else if($(this).val() == 'pending'){
                    $('.status-heading').css('background-color', 'yellow');
                    $('.status_value').html("Pending")
                }else{
                    $('.status-heading').css('background-color', '#f5f5f5');
                    $('.status_value').html("Status")
                }
            })

            $('.apply_coupon').on('click', function(){
                calculateAllPrice();
            });

            $("form#create_booking").validate();

            async function getCouponDiscount(price, type_id) {
                var discount = 0;
                    const result = await $.ajax({
                        url: "{{ route('get_coupon_discount') }}",
                        dataType: 'json',
                        data: {
                            'coupon_code': $('#coupon_code').val(),
                            'booking_date': $('#arrival_date').val(),
                        },
                    });
                    if (result.status === 1) {
                        if (result.coupon.hms_room_type_id == type_id) {
                            if(result.coupon.discount_type == 'fixed'){
                                discount = result.coupon.discount;
                            }else{
                                discount = (result.coupon.discount * price) / 100;
                            }
                            coupon_id = result.coupon.id; 
                        }else{
                            discount = 0;
                        }
                    }
                return {
                    'discount':discount, 
                    'coupon_id': coupon_id,
                };
            }

       

            async function calculateAllPrice() {
                    calculateDays()
                    var extra_amount = 0;
                    var person = 0;
                    var room_price = 0;
                    var total = 0;
                    var total_discount = 0;
                    var type_id = null;

                    await Promise.all(
                        $('.booking_add_room table tbody tr').map(async function() {
                            
                            const tr = $(this);
                            const price = parseFloat(tr.find('input[name^="rooms["][name$="][price]"]').val());
                            const type_id = tr.find('input[name^="rooms["][name$="][type_id]"]').val();
                            if($('#coupon_code').val() != ''){
                                discount = await getCouponDiscount(price, type_id);
                                total_discount = total_discount + parseFloat(discount.discount);
                                coupon_id = discount.coupon_id;
                            }

                           

                            var total_price = calculateDays() * price;
                            // tr.find('.price-td').text(total_price.toFixed(0));
                            tr.find('.price-td').text(__currency_trans_from_en(total_price.toFixed(2) , true));
                            tr.find('input[name^="rooms["][name$="][total_price]"]').val(total_price);
                            room_price += total_price;
                            person += parseFloat(tr.find('input[name^="rooms["][name$="][no_of_adult]"]').val()) +
                                parseFloat(tr.find('input[name^="rooms["][name$="][no_of_child]"]').val());
                        })
                    );
                    
                    $('.extra').each(async function() {

                        if ($(this).prop('checked')) {
                            var per_type = $(this).data('value');
                            var price = parseFloat($(this).data('price'));
                            if (per_type == 'per_booking') {
                                extra_amount =  parseFloat(extra_amount) + price;
                                $('#' + $(this).val()).val(price);
                            }
                            if (per_type == 'per_person') {
                                extra_amount = parseFloat(extra_amount) + person * price;
                                $('#' + $(this).val()).val(person * price);
                            }
                            if (per_type == 'per_day') {
                                extra_amount = parseFloat(extra_amount) + calculateDays() * price;
                                $('#' + $(this).val()).val(calculateDays() * price);
                            }
                            if (per_type == 'per_day_per_person') {
                                extra_amount = parseFloat(extra_amount) +  calculateDays() * person * price;
                                $('#' + $(this).val()).val(calculateDays() * person * price);
                            }
                        } else {
                            $('#' + $(this).val()).val('');
                        }

                    });

                    var extra = parseFloat(extra_amount);
                    var room_price = parseFloat(room_price);

                    // input field discount logic

                    if($('#discount_percent').val() != '' && $('#discount_percent').val() > 0){
                       discount = ($('#discount_percent').val() * (extra + room_price) / 100)
                       total_discount = discount;
                       coupon_id = null;
                       $('#discount_type').val('Percentage');
                       $('#total_discount').val($('#discount_percent').val());
                       $('.total_discount_show').text(__currency_trans_from_en(total_discount.toFixed(2) , true));
                    }

                    total = extra + room_price - total_discount;
                    $('#final_total_input').val(total);
                    $('.payment-amount').val(total);
                   

                    if($('#coupon_code').val() != ''){
                        if(total_discount > 0){
                            $('#coupon_id').val(coupon_id);
                            $('#discount_type').val('Fixed');
                            $('#total_discount').val(total_discount);
                            $('.total_discount_show').text(__currency_trans_from_en(total_discount.toFixed(2) , true));
                            $('.coupon-box').show();
                            $('.coupon-box').html("{{ __('hms::lang.applied_successfully') }}").css({'font-weight': 'bold','font-size': '16px', 'color': 'green'});
                        }else{
                            $('#coupon_id').val(null);
                            $('#discount_type').val(null);
                            $('#total_discount').val(null);
                            $('.coupon-box').show();
                            $('.coupon-box').html("{{ __('hms::lang.something_went_wrong') }}").css({'font-weight': 'bold','font-size': '16px', 'color': 'red'});
                        }
                    }else{
                        $('#coupon_id').val(null);
                        $('.coupon-box').hide();

                        if($('#discount_percent').val() == ''){
                            $('#discount_type').val(null);
                            $('#total_discount').val(null);
                            $('.total_discount_show').text(__currency_trans_from_en(total_discount.toFixed(2) , true));
                        }
                    }


                    $('.total').text(__currency_trans_from_en(total.toFixed(2) , true));
                    $('.extra_price').text(__currency_trans_from_en(extra_amount.toFixed(2) , true));
                    $('.room_price').text(__currency_trans_from_en(room_price.toFixed(2) , true));

                    calculate_balance_due();
            }

           

            function calculateDays() {
    
                // Assuming you have the start and end date strings in 'D-MM-YYYY' format
                const startDateString = $('#arrival_date').val();
                const endDateString = $('#departure_date').val();

                // Convert the date strings to moment objects using the input format
                const startDate = moment(startDateString, moment_date_format, true);
                const endDate = moment(endDateString, moment_date_format, true);

                // Check if the date strings are valid
                if (startDate.isValid() && endDate.isValid()) {
                // Calculate the difference in days
                var daysDifference = endDate.diff(startDate, 'days'); // Adding 1 to include both start and end days
                    if(daysDifference <= 0){
                        ++daysDifference;
                    }

                    $('.days_count').text(daysDifference + ' Days')

                    return daysDifference;
                }
            }
            //get customer
            $('select#customer_id').select2({
                ajax: {
                    url: '/contacts/customers',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                },
                templateResult: function (data) { 
                    var template = '';
                    if (data.supplier_business_name) {
                        template += data.supplier_business_name + "<br>";
                    }
                    template += data.text + "<br>" + LANG.mobile + ": " + data.mobile;

                    if (typeof(data.total_rp) != "undefined") {
                        var rp = data.total_rp ? data.total_rp : 0;
                        template += "<br><i class='fa fa-gift text-success'></i> " + rp;
                    }

                    return  template;
                },
                minimumInputLength: 1,
                language: {
                    noResults: function() {
                        var name = $('#customer_id')
                            .data('select2')
                            .dropdown.$search.val();
                        return (
                            '<button type="button" data-name="' +
                            name +
                            '" class="btn btn-link add_new_customer"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>&nbsp; ' +
                            __translate('add_name_as_new_customer', { name: name }) +
                            '</button>'
                        );
                    },
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
            });
            $('#customer_id').on('select2:select', function(e) {
                var data = e.params.data;
                if (data.pay_term_number) {
                    $('input#pay_term_number').val(data.pay_term_number);
                } else {
                    $('input#pay_term_number').val('');
                }

                if (data.pay_term_type) {
                    $('#add_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                    $('#edit_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                } else {
                    $('#add_sell_form select[name="pay_term_type"]').val('');
                    $('#edit_sell_form select[name="pay_term_type"]').val('');
                }
                
                update_shipping_address(data);
                $('#advance_balance_text').text(__currency_trans_from_en(data.balance), true);
                $('#advance_balance').val(data.balance);

                if (data.price_calculation_type == 'selling_price_group') {
                    $('#price_group').val(data.selling_price_group_id);
                    $('#price_group').change();
                } else {
                    $('#price_group').val('');
                    $('#price_group').change();
                }
                if ($('.contact_due_text').length) {
                    get_contact_due(data.id);
                }
            });

            function update_shipping_address(data) {
               
                if ($('#billing_address_div').length) {
                    var address = [];
                    if (data.supplier_business_name) {
                        address.push(data.supplier_business_name);
                    }
                    if (data.name) {
                        address.push('<br>' + data.name);
                    }
                    if (data.text) {
                        address.push('<br>' + data.text);
                    }
                    if (data.address_line_1) {
                        address.push('<br>' + data.address_line_1);
                    }
                    if (data.address_line_2) {
                        address.push('<br>' + data.address_line_2);
                    }
                    if (data.city) {
                        address.push('<br>' + data.city);
                    }
                    if (data.state) {
                        address.push(data.state);
                    }
                    if (data.country) {
                        address.push(data.country);
                    }
                    if (data.zip_code) {
                        address.push('<br>' + data.zip_code);
                    }
                    var billing_address = address.join(', ');
                    $('#billing_address_div').html(billing_address);
                }

            }

            function get_contact_due(id) {
                $.ajax({
                    method: 'get',
                    url: /get-contact-due/ + id,
                    dataType: 'text',
                    success: function(result) {
                        if (result != '') {
                            $('.contact_due_text').find('span').text(result);
                            $('.contact_due_text').removeClass('hide');
                        } else {
                            $('.contact_due_text').find('span').text('');
                            $('.contact_due_text').addClass('hide');
                        }
                    },
                });
            }

            set_default_customer();

            function set_default_customer() {
                var default_customer_id = $('#default_customer_id').val();
                var default_customer_name = $('#default_customer_name').val();
                var default_customer_balance = $('#default_customer_balance').val();
                var default_customer_address = $('#default_customer_address').val();
                var exists = default_customer_id ? $('select#customer_id option[value=' + default_customer_id + ']').length : 0;
                if (exists == 0 && default_customer_id) {
                    $('select#customer_id').append(
                        $('<option>', { value: default_customer_id, text: default_customer_name })
                    );
                }
                $('#advance_balance_text').text(__currency_trans_from_en(default_customer_balance), true);
                $('#advance_balance').val(default_customer_balance);
           
                if (default_customer_address) {
                    $('#shipping_address').val(default_customer_address);
                }
                $('select#customer_id')
                    .val(default_customer_id)
                    .trigger('change');

                if ($('#default_selling_price_group').length) {
                    $('#price_group').val($('#default_selling_price_group').val());
                    $('#price_group').change();
                }

                //initialize tags input (tagify)
                if ($("textarea#repair_defects").length > 0 && !customer_set) {
                    let suggestions = [];
                    if ($("input#pos_repair_defects_suggestion").length > 0 && $("input#pos_repair_defects_suggestion").val().length > 2) {
                        suggestions = JSON.parse($("input#pos_repair_defects_suggestion").val());    
                    }
                    let repair_defects = document.querySelector('textarea#repair_defects');
                    tagify_repair_defects = new Tagify(repair_defects, {
                            whitelist: suggestions,
                            maxTags: 100,
                            dropdown: {
                                maxItems: 100,           // <- mixumum allowed rendered suggestions
                                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                                enabled: 0,             // <- show suggestions on focus
                                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                            }
                            });
                }

                customer_set = true;
            }

            $(document).on('click', '.add_new_customer', function() {
                $('#customer_id').select2('close');
                var name = $(this).data('name');
                $('.contact_modal')
                    .find('input#name')
                    .val(name);
                $('.contact_modal')
                    .find('select#contact_type')
                    .val('customer')
                    .closest('div.contact_type_div')
                    .addClass('hide');
                $('.contact_modal').modal('show');
            });
            $('form#quick_add_contact')
                .submit(function(e) {
                    e.preventDefault();
                })
                .validate({
                    rules: {
                        contact_id: {
                            remote: {
                                url: '/contacts/check-contacts-id',
                                type: 'post',
                                data: {
                                    contact_id: function() {
                                        return $('#contact_id').val();
                                    },
                                    hidden_id: function() {
                                        if ($('#hidden_id').length) {
                                            return $('#hidden_id').val();
                                        } else {
                                            return '';
                                        }
                                    },
                                },
                            },
                        },
                    },
                    messages: {
                        contact_id: {
                            remote: LANG.contact_id_already_exists,
                        },
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            method: 'POST',
                            url: base_path + '/check-mobile',
                            dataType: 'json',
                            data: {
                                contact_id: function() {
                                    return $('#hidden_id').val();
                                },
                                mobile_number: function() {
                                    return $('#mobile').val();
                                },
                            },
                            beforeSend: function(xhr) {
                                __disable_submit_button($(form).find('button[type="submit"]'));
                            },
                            success: function(result) {
                                if (result.is_mobile_exists == true) {
                                    swal({
                                        title: LANG.sure,
                                        text: result.msg,
                                        icon: 'warning',
                                        buttons: true,
                                        dangerMode: true,
                                    }).then(willContinue => {
                                        if (willContinue) {
                                            submitQuickContactForm(form);
                                        } else {
                                            $('#mobile').select();
                                        }
                                    });
                                    
                                } else {
                                    submitQuickContactForm(form);
                                }
                            },
                        });
                    },
                });
            $('.contact_modal').on('hidden.bs.modal', function() {
                $('form#quick_add_contact')
                    .find('button[type="submit"]')
                    .removeAttr('disabled');
                $('form#quick_add_contact')[0].reset();
            });
            function submitQuickContactForm(form) {
                var data = $(form).serialize();
                $.ajax({
                    method: 'POST',
                    url: $(form).attr('action'),
                    dataType: 'json',
                    data: data,
                    beforeSend: function(xhr) {
                        __disable_submit_button($(form).find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success == true) {
                            var name = result.data.name;

                            if (result.data.supplier_business_name) {
                                name += result.data.supplier_business_name;
                            }
                            
                            $('select#customer_id').append(
                                $('<option>', { value: result.data.id, text: name })
                            );
                            $('select#customer_id')
                                .val(result.data.id)
                                .trigger('change');
                            $('div.contact_modal').modal('hide');
                            update_shipping_address(result.data)
                            toastr.success(result.msg);
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                }); 
            }

            $("#discount_percent").keyup(function(){
                
                if($(this).val() > 0){
                    $('#coupon_code').prop('disabled', true);
                    calculateAllPrice();
                }else{
                    calculateAllPrice();
                    $('#coupon_code').prop('disabled', false);
                    
                }

            });

            $("#coupon_code").keyup(function(){
                
                if($(this).val() != ''){
                    $('#discount_percent').prop('disabled', true);
                }else{
                    $('#discount_percent').prop('disabled', false);
                    calculateAllPrice();
                }

            });
            
            // {{-- payment code  --}}

            $(document).on('change', '.payment_types_dropdown', function(e) {
                var default_accounts = $('select#select_location_id').length ? 
                            $('select#select_location_id')
                            .find(':selected')
                            .data('default_payment_accounts') : $('#location_id').data('default_payment_accounts');
                var payment_type = $(this).val();
                var payment_row = $(this).closest('.payment_row');
                if (payment_type && payment_type != 'advance') {
                    var default_account = default_accounts && default_accounts[payment_type]['account'] ? 
                        default_accounts[payment_type]['account'] : '';
                    var row_index = payment_row.find('.payment_row_index').val();

                    var account_dropdown = payment_row.find('select#account_' + row_index);
                    if (account_dropdown.length && default_accounts) {
                        account_dropdown.val(default_account);
                        account_dropdown.change();
                    }
                }

                //Validate max amount and disable account if advance 
                amount_element = payment_row.find('.payment-amount');
                account_dropdown = payment_row.find('.account-dropdown');
                if (payment_type == 'advance') {
                    max_value = $('#advance_balance').val();
                    msg = $('#advance_balance').data('error-msg');
                    amount_element.rules('add', {
                        'max-value': max_value,
                        messages: {
                            'max-value': msg,
                        },
                    });
                    if (account_dropdown) {
                        account_dropdown.prop('disabled', true);
                        account_dropdown.closest('.form-group').addClass('hide');
                    }
                } else {
                    amount_element.rules("remove", "max-value");
                    if (account_dropdown) {
                        account_dropdown.prop('disabled', false); 
                        account_dropdown.closest('.form-group').removeClass('hide');
                    }    
                }
            });


            $(document).on('change', '.payment-amount', function() {
                    calculate_balance_due();
            });

            function calculate_balance_due() {
                var total_payable = __read_number($('#final_total_input'));
                var total_paying = 0;
                    $('.payment-amount')
                    .each(function() {
                        if (parseFloat($(this).val())) {
                            total_paying += __read_number($(this));
                        }
                    });
                var bal_due = total_payable - total_paying;
                var change_return = 0;

                //change_return
                if (bal_due < 0 || Math.abs(bal_due) < 0.05) {
                    __write_number($('input#change_return'), bal_due * -1);
                    $('span.change_return_span').text(__currency_trans_from_en(bal_due * -1, true));
                    change_return = bal_due * -1;
                    bal_due = 0;
                } else {
                    __write_number($('input#change_return'), 0);
                    $('span.change_return_span').text(__currency_trans_from_en(0, true));
                    change_return = 0;
                    
                }

                if (change_return !== 0) {
                    $('#change_return_payment_data').removeClass('hide');
                } else {
                    $('#change_return_payment_data').addClass('hide');
                }

                __write_number($('input#total_paying_input'), total_paying);
                $('span.total_paying').text(__currency_trans_from_en(total_paying, true));

                __write_number($('input#in_balance_due'), bal_due);
                $('span.balance_due').text(__currency_trans_from_en(bal_due, true));

                __highlight(bal_due * -1, $('span.balance_due'));
                __highlight(change_return * -1, $('span.change_return_span'));
            }

            //  commom code end
        });

        $(document).on('click', 'button#submit_action', function(e){
    		if($('.booking_add_room table tbody tr').length == 0 && $('input[type="checkbox"][name^="extras["][name$="][id]"]:checked').length == 0){
                toastr.warning("{{ __('hms::lang.no_rooms_or_extras') }}");
                return false;
            }
    	});
    </script>
@endsection