<div class="col-md-12">
    <form action="{{ action('\Modules\Superadmin\Http\Controllers\SubscriptionController@confirm', [$package->id]) }}"
        method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="gateway" value="{{ $k }}">
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ config('ms.payment_gateway.stripe_pub_key') }}" data-amount="{{ $package->price * 100 }}"
            data-name="{{ config('app.name') }}" data-description="{{ $package->name }}"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto"
            data-currency="{{ strtolower($system_currency->code) }}"></script>
    </form>
</div>
