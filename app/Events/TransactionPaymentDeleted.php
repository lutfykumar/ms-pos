<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class TransactionPaymentDeleted
{
    use SerializesModels;

    public $transactionPaymentId;

    public $accountId;
    protected $transactionPayment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($transactionPayment)
    {
        $this->transactionPayment = $transactionPayment;
    }
}
