<?php

use Registry as Reg;
use Template as Temp;

Class Controller_Index Extends Controller_Base
{
    function index()
    {

        $template = new Temp(new Reg);

        $template->show('templates/index.html');
    }
}