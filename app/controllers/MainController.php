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
        $search = $_GET['search'] ?? NULL;
        $order = $_GET['order'] ?? NULL;
        $as = $_GET['as'] ?? NULL;

        $students = StudentGateway::getStudents($this->limit, $this->getOffsetStudents(), $order, $as, $search);
        if($search)
        {
            $this->totalpages = ceil(StudentGateway::getCountSearchStudents($_GET['search']) / $this->limit);
        }
        else
        {
            $this->totalpages = ceil(StudentGateway::getCountStudents() / $this->limit);
        }
        
        include_once(ROOT . "/app/views/main.phtml");
        
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