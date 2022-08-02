<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

use function GuzzleHttp\Promise\each;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //RELACIONES NORMALES 1:1 1:N
        $users = User::factory(20)
            ->create()
            ->each(function ($user) {
                $image = Image::factory()
                    ->user()
                    ->make();
                });

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

                $cards = Card::factory(20)->create();

                $products = Product::factory(50)
                    ->create()
                    ->each(function ($product) use ($orders, $cards) {
                        $order = $orders->random();

                        $order->products()->attach([
                            $product->id => ['quantity' => mt_rand(1, 3)]
                        ]);

                        $card = $cards->random();

                        $card->products()->attach([
                            $product->id => ['quantity' => mt_rand(1, 3)],
                        ]);

                        $images = Image::factory(mt_rand(2, 4))->make();
                        $product->images()->saveMany($images);
                });
    }
}
