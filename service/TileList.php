<?php

/**
 * Class TileList
 */
class TileList
{

    /**
     * @var Tile[]
     */
    private $tiles;

    /**
     * TileList constructor.
     * @param $tiles[]
     */
    public function __construct($tiles)
    {
        $this->tiles = [];

        foreach ($tiles as $tile) {
            $this->tiles[] = new Tile($tile["name"], $tile["color"], $tile["link"], $tile["icon"]);
        }
    }

    /**
     * @return string
     */
    public function getTileList() {
        $tiles = "<div class=\"tiles\">";

        foreach ($this->tiles as $tile) {
            $tiles .= $tile->getTile();
        }

        $tiles .= "</div>";

        return $tiles;
    }
}