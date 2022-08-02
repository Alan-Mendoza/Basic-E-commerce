<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(50)->create();

        //RELACIONES NORMALES 1:1 1:N
        $users = User::factory(20)->create();

        $orders = Order::factory(10)
                ->make()
                ->each(function($order) use ($users) {
                    $order->customer_id = $users->random()->id;
                    $order->save();

                    $payment = Payment::factory()->make();
                    // $payment->order_id = $order->id;
                    // $payment->save();
                    $order->payment()->save($payment);
                });
    }
}
