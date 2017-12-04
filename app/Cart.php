<?php

namespace App;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0.0;

    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalPrice = $oldCart->totalPrice;
        }
        $this->totalQty = 0;
    }

    public function add($item, $id, $product_quantity)
    {
        $description = json_decode($item->description, true);
        $item_price = floatval(str_replace(',', '.', $description['price']));

        if (isset($description['main_picture_url']))
        {
            $product_img = $description['main_picture_url'];
        }
        elseif(isset($description['upload_main_picture']))
        {
            $product_img = '/storage/upload_pictures/'.$id.'/'.$description['upload_main_picture'];
        }
        else
        {
            $product_img = '/storage/common_pictures/noimage.jpg';
        }

        $storedItem = [
            'qty' => 0,
            'total_item_price' => $item_price,
            'item' => $item,
            'item_price' => $item_price,
            'item_title' => $description['title_product'],
            'item_pic' =>  $product_img
        ];

        if($this->items)
        {
            if (array_key_exists($id, $this->items))
            {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty'] = $product_quantity;
        $storedItem['total_item_price'] = $item_price * $storedItem['qty'];
        $this->items[$id] = $storedItem;

        $this->recalculate_items($this->items);
    }

    public function recalculate_items()
    {
        $this->totalPrice = 0.0;

        foreach($this->items as $allItems)
        {
            $this->totalQty += $allItems['qty'];
            $this->totalPrice += $allItems['total_item_price'];
        }

    }

    public function removeItem($id)
    {
        //$this->totalQty -= $this->items[$id]['qty'];
        //$this->totalPrice -= $this->items[$id]['total_item_price'];
        unset($this->items[$id]);
        $this->recalculate_items($this->items);
    }
}