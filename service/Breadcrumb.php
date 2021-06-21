<?php

/**
 * Class Breadcrumb
 */
class Breadcrumb
{
    /**
     * @var array
     */
    private $elements;

    /**
     * @var string
     */
    private $breadcrumbs;

    /**
     * Breadcrumb constructor.
     * @param $elements
     */
    public function __construct($elements)
    {
        $this->elements = $elements;
        $this->breadcrumbs .= '<ul class="breadcrumb">';
        $this->breadcrumbs .= '
            <li>
                <i class="icon-home"></i>
                <a href="dashboard.php">Accueil</a>
            </li>
        ';
    }

    /**
     * @return string
     */
    public function getBreadcrumb()
    {
        for ($i = 0; $i < count($this->elements); $i++) {
            $this->breadcrumbs .= '
                <li>
                    <i class="icon-angle-right"></i>
                    <i class="'.$this->elements[$i]['class'].'"></i>
                    <a href="'.$this->elements[$i]['link'].'">'.$this->elements[$i]['title'].'</a>
                </li>
            ';
        }

        $this->breadcrumbs .= '</ul>';

        return $this->breadcrumbs;
    }
}