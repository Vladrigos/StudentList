<?php

set_include_path( get_include_path()
. PATH_SEPARATOR . ROOT . '/app/controllers/'
. PATH_SEPARATOR . ROOT . '/app/models/'
. PATH_SEPARATOR . ROOT . '/app/components/');
spl_autoload_register( function( $class ) {
    include $class . '.php';
});
