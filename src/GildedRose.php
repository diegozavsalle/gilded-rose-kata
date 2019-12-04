<?php

namespace GildedRose;

class GildedRose {

	private const MINIMUM_QUALITY = 0;
	private const MAXIMUM_QUALITY = 50;

	public static function updateQuality($items) {

		foreach ($items as $current_item){
			$current_quality = $current_item->getQuality();

//			La calidad de un item no es nunca negativa.
			if ($current_quality <= self::MINIMUM_QUALITY) {
				break;
			}

//			La calidad de un item nunca es mayor de 50.
			if ($current_quality >= self::MAXIMUM_QUALITY) {
				break;
			}

//			El item "Sulfuras", nuestro articulo más legendario!, nunca debe venderse ni disminuye su calidad.
			if ($current_item->getName() == "Sulfuras, Hand of Ragnaros") {
				break;
			}

			if ($current_item->getName() == "Aged Brie") {
				self::incrementQuality($current_item, 1);
				break;
			}

			//Los "backstage passes" incrementan su calidad conforme se aproxima la fecha de venta.
			// La calidad se incrementa por dos cuando quedan 10 días o menos para el concierto,
			// por 3 cuando quedan 5 días o menos. Sin embargo la calidad disminuye a 0 después del concierto.
			if ($current_item->getName() == "Backstage passes to a TAFKAL80ETC concert") {
				$sellIn_date = $current_item->getSellIn();
				if ($sellIn_date > 10) {
					self::incrementQuality($current_item, 1);
					break;
				}
				if ($sellIn_date > 5) {
					self::incrementQuality($current_item, 2);
					break;
				}
				if ($sellIn_date > 0) {
					self::incrementQuality($current_item, 3);
					break;
				}
				if ($sellIn_date <= 0) {
					$current_item->setQuality(0);
					break;
				}
			}

			//Cuando la fecha de venta a pasado, la calidad degrada al doble de velocidad.
			if ($current_item->getSellIn() < 0) {
				$current_item->setQuality($current_quality - 2);
				break;
			}
			//Los items degradan la calidad en una unidad por cada actualización.
			$current_item->setQuality($current_quality - 1);
			$current_item->setSellIn($current_item->getSellIn() - 1);
		}
	}

	/**
	 * @param $current_item
	 * @param $increment
	 */
	private static function incrementQuality($current_item, $increment)
	{
		$current_item->setQuality($current_item->getQuality() + $increment);
	}
}

?>
