<?php

    function myAutoloader($class) {
        include INC_DIR .'classes/'.$class.'.php';
    }

    spl_autoload_register('myAutoloader');

//Shit ain't working, I'm going to bed.