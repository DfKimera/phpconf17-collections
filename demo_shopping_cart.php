<?php
include("vendor/autoload.php");
include("data_products.php");

$cart = json_decode(file_get_contents('shopping_cart.json'));

    $order = [
        'items' => [],
        'total' => 0,
    ];

    foreach($cart as $cartItem) {

        $product = $products[$cartItem->id] ?? null;

        if(!$product) {
            continue;
        }

        $orderItem = [
            'id' => $cartItem->id,
            'quantity' => intval($cartItem->quantity),
            'paid_price' => $product->price,
            'subtotal' => intval($cartItem->quantity) * $product->price
        ];

        $order['total'] += $orderItem['subtotal'];

    }

    echo json_encode($order);



    $items = collect($cart)
        ->filter(function ($item) use ($products) {
            return $products->has($item->id);
        })
        ->map(function ($item) use ($products) {
            $item->quantity = intval($item->quantity);
            $item->paid_price = $products->get($item->id)->price;
            $item->subtotal = $item->quantity * $item->paid_price;

            return $item;
        });

    $order = collect([
        'items' => $items,
        'total' => $items->sum('subtotal')
    ]);

    echo $order->toJson();


