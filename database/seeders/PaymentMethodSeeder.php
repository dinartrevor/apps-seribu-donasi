<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::truncate();
        $paymentMethods = [
            [
                'name' => 'BCA',
            ],
            [
                'name' => 'BRI',
            ],
            [
                'name' => 'MANDIRI',
            ],
            [
                'name' => 'BNI',
            ],
            [
                'name' => 'PERMATA BANK',
            ],
            [
                'name' => 'NIAGA',
            ],
            [
                'name' => 'MAYBANK',
            ],
            [
                'name' => 'OCBC',
            ],
            [
                'name' => 'GoPay',
            ],
            [
                'name' => 'OVO',
            ],
            [
                'name' => 'DANA',
            ],
            [
                'name' => 'LinkAja',
            ],
            [
                'name' => 'Shopee Pay',
            ],
            [
                'name' => 'DOKU',
            ],
            [
                'name' => 'I-SAKU',
            ],
        ];

        PaymentMethod::insert($paymentMethods);
    
    }
}
