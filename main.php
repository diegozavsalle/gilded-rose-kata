<?php
use GildedRose\GildedRose;
use GildedRose\Item;

require __DIR__.'/vendor/autoload.php';

$items = array();

$items [] = new Item("+5 Dexterity Vest", 10, 20);
$items [] = new Item("Aged Brie", 2, 0);
$items [] = new Item("Elixir of the Mongoose", 5, 7);
$items [] = new Item("Sulfuras, Hand of Ragnaros", 0, 80);
$items [] = new Item("Backstage passes to a TAFKAL80ETC concert", 15, 20);
$items [] = new Item("Conjured Mana Cake", 3, 6);

GildedRose::updateQuality($items);

//print_r($items);exit;

foreach ($items as $item) {
    echo "Item: {$item->name}, Quality: {$item->quality}, SellIn: {$item->sellIn}\n";
}

?>
