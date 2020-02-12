<?php

//класс для работы с URI
class Uri
{
    public static function setPageUri($i)       //мб перенести в другой класс
    {
        $params = Uri::getParams();
        $params['page'] = $i;
        $uri = http_build_query($params);
        echo "?$uri";
    }
    
    public static function setColUri($col)
    {
        $params = Uri::getParams();
        $params['order'] = $col;
        if(isset($params['as']))
        {
            $params['as'] = ($params['as'] == 'desc') ? 'asc' : 'desc';
        }
        else
        {
            $params['as'] = "asc";
        }
        $uri = http_build_query($params);
        echo "?$uri";
    }
    
    public static function getParams()
    {
        $params = array();
        if(isset($_GET['search']))
        {
            $params['search'] = $_GET['search']; 
        }
        
        if(isset($_GET['page']))
        {
            $params['page'] = $_GET['page']; 
        }
        
        if(isset($_GET['order']))
        {
            $params['order'] = $_GET['order']; 
        }
        
        if(isset($_GET['as']))
        {
            $params['as'] = $_GET['as']; 
        }
        
        return $params;
    }
    
    public static function getCurrentPage()
    {
        if(isset($_GET['page']))
        {
            return $_GET['page'];
        }
        else
        {
            return 1;
        }
    }
    //я не придумал как это назвать...
    public static function checkGetHave($key, $value)
    {
        if(isset($_GET[$key]))
        {
            if($_GET[$key] == $value)
            {
                return 1;
            }
        }
        return 0;
    }
}
