<?php

spl_autoload_register(function ($class)
{
   $path = ROOT . "/" . $class . '.php'; 
   //echo $path;
   if(file_exists($path))
   {
       require_once $path;
   }
});

spl_autoload_register(function ($class)
{
   $path = ROOT . "/controllers/" . $class . '.php'; 

   if(file_exists($path))
   {
       require_once $path;
   }
});

spl_autoload_register(function ($class)
{
   $path = ROOT . "/models/" . $class . '.php'; 

   if(file_exists($path))
   {
       require_once $path;
   }
});

spl_autoload_register(function ($class)
{
   $path = ROOT . "/components/" . $class . '.php'; 
   
   if(file_exists($path))
   {
       require_once $path;
   }
});