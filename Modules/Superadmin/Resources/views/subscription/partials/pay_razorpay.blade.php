<div class="col-md-12">

    <form action="{{ action('\Modules\Superadmin\Http\Controllers\SubscriptionController@confirm', [$package->id]) }}"
        method="POST">
        <!-- Note that the amount is in paise -->
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ config('ms.payment_gateway.razorpay_key_id') }}"
            data-amount="{{ $package->price * 100 }}" data-buttontext="Pay with Razorpay" data-name="{{ config('app.name') }}"
            data-description="{{ $package->name }}" data-theme.color="#3c8dbc"></script>
        {{ csrf_field() }}
        <input type="hidden" name="gateway" value="{{ $k }}">
    </form>
</div>
