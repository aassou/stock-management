<?php

/**
 * Class Tile\
 */
class Tile
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $icon;

    /**
     * Tile constructor.
     * @param $name
     * @param $color
     * @param $link
     * @param $icon
     */
    public function __construct($name, $color, $link, $icon)
    {
        $this->name = $name;
        $this->color = $color;
        $this->link = $link;
        $this->icon = $icon;
    }



    /**
     * @return string
     */
    public function getTile() {
        return sprintf("
            <a href=\"%s\">
                <div class=\"tile %s\">
                    <div class=\"tile-body\">
                        <i class=\"%s\"></i>
                    </div>
                    <div class=\"tile-object\">
                        <div class=\"name\">
                            %s
                        </div>
                        <div class=\"number\">
                        </div>
                    </div>
                </div>
            </a>
            ", $this->link, $this->color, $this->icon, $this->name
        );
    }
}