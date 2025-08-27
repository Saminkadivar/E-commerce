<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Disable FK checks before truncating
        Schema::disableForeignKeyConstraints();
        OrderItem::truncate();
        Order::truncate();
        Schema::enableForeignKeyConstraints();

        $user = User::where('role', 'user')->first();
        $products = Product::all();

        // Create 3 orders
        for ($i = 1; $i <= 3; $i++) {
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => 0,
                'status' => 'pending',
                'payment_ref' => 'PAY' . rand(1000, 9999),
                'paid_at' => now(),
                'shipping_address' => '123 Street, City',
            ]);
            

            $total = 0;
            $sampleProducts = $products->random(3);

            foreach ($sampleProducts as $product) {
                $quantity = rand(1, 3);
                $subtotal = $product->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendor_id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                    'status' => 'pending',
                ]);

                $total += $subtotal;
            }

            // Update total amount after adding all items
            $order->update(['total_amount' => $total]);
        }
    }
}
