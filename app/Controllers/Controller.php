<?php
/**
 * Created by PhpStorm.
 * User: ALFAFA
 * Date: 12/13/2017
 * Time: 10:46 AM
 */

namespace App\Controllers;


class Controller
{

    protected $DI;

    /**
     * Controller constructor.
     * @param $container
     */

    public function __construct($DI)
    {
        $this->DI = $DI;
    }
    public function __get($property)
    {
        if ($this->DI->{$property})
        {
            return $this->DI->{$property};
        }
    }

}