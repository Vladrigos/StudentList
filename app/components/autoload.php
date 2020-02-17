<?php

spl_autoload_register(function ($class)
{
   $path = ROOT . "/app/" . $class . '.php'; 
   //echo $path;
   if(file_exists($path))
   {
       require_once $path;
   }
});

spl_autoload_register(function ($class)
{
   $path = ROOT . "/app/controllers/" . $class . '.php'; 

   if(file_exists($path))
   {
       require_once $path;
   }
});

spl_autoload_register(function ($class)
{
   $path = ROOT . "/app/models/" . $class . '.php'; 

   if(file_exists($path))
   {
       require_once $path;
   }
});

spl_autoload_register(function ($class)
{
   $path = ROOT . "/app/components/" . $class . '.php'; 
   
   if(file_exists($path))
   {
       require_once $path;
   }
});