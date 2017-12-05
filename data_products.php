<?php

    public class Product {
        public $id;
        public $name;
        public $price;

        public function __construct($id, $name, $price) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
        }
    }

    $products = collect([
        1234 => new Product(1234, 'Playstation 4', 2500),
        2345 => new Product(1234, 'TV Plasma Samsung', 4999),
        3456 => new Product(1234, 'DVD Senhor dos Aneis', 29),
    ]);



    $collection = collect([1, 2, 3]);
    $collection = new \Illuminate\Support\Collection([1, 2, 3]);

