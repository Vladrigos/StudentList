<?php

Class MainController
{
    //лимит студентов на страницу
    private $limit = 50;
    //всего страниц
    private $totalpages;
    
    public function actionIndex()
    {
        $isRegister = isset($_COOKIE['student']);
        //если что то ищем
        if(isset($_GET['search']) && $_GET['search'] != '')
        {
            $students = StudentGateway::getSearchStudents($_GET['search']); 
            $this->totalpages = ceil(StudentGateway::getCountSearchStudents($_GET['search']) / $this->limit);
        }
        else
        {
            //если нужно с сортировкой
            if(isset($_GET['order']))
            {
                $students = StudentGateway::getStudents($this->limit, $this->getOffsetStudents(), $_GET['order'], $_GET['as']);
            }
            else
            {
                $students = StudentGateway::getStudents($this->limit, $this->getOffsetStudents());
            }
            $this->totalpages = ceil(StudentGateway::getCountStudents() / $this->limit);
        }
        
        include_once("views/main.phtml");
        
        return 1;
    }
      
    public function getOffsetStudents()
    {
        if (isset($_GET['page']) && $_GET['page'] > 0) 
        {
            return $_GET['page'] * $this->limit - $this->limit;
        }
        else
        {
            return 0;
        }
    }
}