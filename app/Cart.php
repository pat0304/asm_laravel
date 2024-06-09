<?php
namespace App;

class Cart
{
    public $products;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart)
    {
        if ($cart) {
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }
    public function addCart($id, $product, $quantity)
    {
        $oldQuantity = 0;
        $oldPrice = 0;
        $newPro = ['quantity' => $quantity, 'product' => $product, 'total' => 0];
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $newPro = $this->products[$id];
                $oldQuantity = $newPro['quantity'];
                $oldPrice = $newPro['total'];
                $newPro['quantity'] += $quantity;
            }
        }
        if ($product->sale == null) {
            $newPro['total'] = $product->price * $newPro['quantity'];
        } else {
            $newPro['total'] = $product->sale * $newPro['quantity'];
        }
        $this->products[$id] = $newPro;
        $this->totalQuantity = $this->totalQuantity + $newPro['quantity'] - $oldQuantity;
        $this->totalPrice = $this->totalPrice + $newPro['total'] - $oldPrice;
    }
    public function del($id)
    {
        $delPro = $this->products[$id];
        unset($this->products[$id]);
        $this->totalPrice -= $delPro['total'];
        $this->totalQuantity -= $delPro['quantity'];
    }
}