<?php

return [
  'payment_gateway' => [
    'stripe_pub_key' => env('STRIPE_PUB_KEY', ''),
    'stripe_secret_key' => env('STRIPE_SECRET_KEY', ''),
    'razorpay_key_id' => env('RAZORPAY_KEY_ID', ''),
    'razorpay_key_secret' => env('RAZORPAY_KEY_SECRET', ''),
    'paystack_key_id' => env('PAYSTACK_PUBLIC_KEY', ''),
    'paystack_key_secret' => env('PAYSTACK_SECRET_KEY', ''),

    // 'stripe_pub_key' => env('STRIPE_PUB_KEY', ''),
    // 'stripe_secret_key' => env('STRIPE_SECRET_KEY', ''),
  ],
  'settings' => [
    'google_map_api' => env('GOOGLE_MAP_API_KEY', ''),
    'flutterwave_public_key' => env('FLUTTERWAVE_PUBLIC_KEY', ''),
    'flutterwave_secret_key' => env('FLUTTERWAVE_SECRET_KEY', ''),
    'flutterwave_encryption_key' => env('FLUTTERWAVE_ENCRYPTION_KEY', ''),
  ]
];
