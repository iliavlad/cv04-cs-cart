<?php

declare(strict_types=1);

namespace Shop;

final class Shop
{
    /**
     * @var Item[]
     */
    private $items;

    /**
     * Items can have special methods to change its state
     *
     * A key => a name of an item, avalue => a function with 'updateItem' prefix
     *
     * @var array
     */
    private $specialItems = [
        'Blue cheese'       => 'BlueCheese',
        'Mjolnir'           => 'Mjolnir',
        'Concert tickets'   => 'ConcertTickets',
        'Magic cake'        => 'Magic',
    ];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Do items update
     *
     * @return void
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }

    /**
     * Update a single item
     *
     * @param Item $item
     * @return void
     */
    private function updateItem(Item $item): void
    {
        // Option 1
        $method = 'updateCommonItem';
        if (isset($this->specialItems[$item->name])) {
            $method = 'updateItem' . $this->specialItems[$item->name];
        }
        $this->$method($item);

        // Option 2
//        switch ($item->name) {
//            case 'Blue cheese':
//                $this->updateItemBlueCheese($item);
//                break;
//            case 'Mjolnir':
//                $this->updateItemMjolnir($item);
//                break;
//            case 'Concert tickets':
//                $this->updateItemConcertTickets($item);
//                break;
//            case 'Magic cake':
//                $this->updateItemMagic($item);
//                break;
//            default :
//                $this->updateCommonItem($item);
//                break;
//        }
    }

    /**
     * Update an item without special condition
     *
     * @param Item $item
     * @return void
     */
    private function updateCommonItem(Item $item): void
    {
        $item->sell_in--;

        if ($item->quality > 0) {
            $qualityDecrement = 1;
            if ($item->sell_in < 0) {
                $qualityDecrement = 2;
            }
            $item->quality -= $qualityDecrement;
            if ($item->quality < 0) {
                $item->quality = 0;
            }
        }
    }

    /**
     * Update an item with special condition 'Blue Cheese'
     *
     * @param Item $item
     * @return void
     */
    private function updateItemBlueCheese(Item $item): void
    {
        $item->sell_in--;

        if ($item->quality < 50) {
            $qualityIncrement = 1;
            if ($item->sell_in < 0) {
                $qualityIncrement = 2;
            }
            $item->quality += $qualityIncrement;
            if ($item->quality > 50) {
                $item->quality = 50;
            }
        }
    }

    /**
     * Update an item with special condition 'Mjolnir'
     *
     * @param Item $item
     * @return void
     */
    private function updateItemMjolnir(Item $item): void
    {
    }

    /**
     * Update an item with special condition 'Concert Tickets'
     *
     * @param Item $item
     * @return void
     */
    private function updateItemConcertTickets(Item $item): void
    {
        $item->sell_in--;

        if ($item->sell_in < 0) {
            $item->quality = 0;
        } elseif ($item->quality < 50) {
            $qualityIncrement = 1;
            if ($item->sell_in < 5) {
                $qualityIncrement = 3;
            } elseif ($item->sell_in < 10) {
                $qualityIncrement = 2;
            }
            $item->quality += $qualityIncrement;
            if ($item->quality > 50) {
                $item->quality = 50;
            }
        }
    }

    /**
     * Update an item with special condition 'Magic'
     *
     * @param Item $item
     * @return void
     */
    private function updateItemMagic(Item $item): void
    {
        $item->sell_in--;

        if ($item->quality > 0) {
            $qualityDecrement = 2;
            if ($item->sell_in < 0) {
                $qualityDecrement = 4;
            }
            $item->quality -= $qualityDecrement;
            if ($item->quality < 0) {
                $item->quality = 0;
            }
        }
    }
}
