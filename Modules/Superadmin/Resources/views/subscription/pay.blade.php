@extends($layout)

@section('title', __('superadmin::lang.subscription'))

@section('content')

    <!-- Main content -->
    <section class="content">

        @include('superadmin::layouts.partials.currency')

        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">@lang('superadmin::lang.pay_and_subscribe')</h3>
            </div>

            <div class="box-body">
                <div class="col-md-8">
                    <h3>
                        {{ $package->name }}

                        (<span class="display_currency" data-currency_symbol="true">{{ $package->price }}</span>

                        <small>
                            / {{ $package->interval_count }} {{ ucfirst($package->interval) }}
                        </small>)
                    </h3>
                    <ul>
                        <li>
                            @if ($package->location_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->location_count }}
                            @endif

                            @lang('business.business_locations')
                        </li>

                        <li>
                            @if ($package->user_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->user_count }}
                            @endif

                            @lang('superadmin::lang.users')
                        </li>

                        <li>
                            @if ($package->product_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->product_count }}
                            @endif

                            @lang('superadmin::lang.products')
                        </li>

                        <li>
                            @if ($package->invoice_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->invoice_count }}
                            @endif

                            @lang('superadmin::lang.invoices')
                        </li>

                        @if ($package->trial_days != 0)
                            <li>
                                {{ $package->trial_days }} @lang('superadmin::lang.trial_days')
                            </li>
                        @endif
                    </ul>
                    <ul class="list-group">
                        <div class="list-group-item">
                            <div class="form-group">
                                <label for="sub_time"> Pilih Langganan Berapa lama?</label>
                                <select name="time" id="sub_time" class="form-control" placeholder="Pilih salah satu">
                                    <option value="1_bulan">1 Bulan</option>
                                    <option value="2_bulan">2 Bulan</option>
                                    <option value="3_bulan">3 Bulan</option>
                                    <option value="4_bulan">4 Bulan</option>
                                    <option value="5_bulan">5 Bulan</option>
                                    <option value="6_bulan">6 Bulan</option>
                                    <option value="7_bulan">7 Bulan</option>
                                    <option value="8_bulan">8 Bulan</option>
                                    <option value="9_bulan">9 Bulan</option>
                                    <option value="10_bulan">10 Bulan</option>
                                    <option value="11_bulan">11 Bulan</option>
                                    <option value="12_bulan">12 Bulan</option>
                                    <option value="2_tahun">2 Tahun</option>
                                    <option value="3_tahun">3 Tahun</option>
                                </select>
                            </div>
                        </div>
                    </ul>
                    <ul class="list-group">
                        @foreach ($gateways as $k => $v)
                            <div class="list-group-item">
                                <b>@lang('superadmin::lang.pay_via', ['method' => $v])</b>

                                <div class="row" id="paymentdiv_{{ $k }}">
                                    @php
                                        $view = 'superadmin::subscription.partials.pay_' . $k;
                                    @endphp
                                    @includeIf($view)
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).on('change', '#sub_time', function() {
            let value = $(this).val()
            let time_langganan = $('#time_langganan');
            time_langganan.val(value).trigger('change');
        });
    </script>
@endpush
