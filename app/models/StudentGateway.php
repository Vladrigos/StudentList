<?php

Class StudentGateway
{
    //разрешенные значения для order
    private static $columns = ["studentName", "studentSurname", "studentGroup", "studentPoints"];
    public function __construct()
    {
        
    }
    
    public static function getStudents(int $limit, int $offset, string $order = NULL, string $as = NULL, string $search = NULL) : array
    {
        $db = Db::getConnection();
        $query = "SELECT studentName,studentSurname,studentGroup,studentPoints FROM student ";
        if($search)
        {
            $search = "%$search%";
            $query = $query ."WHERE studentName LIKE :search OR "
                            ."studentSurname LIKE :search OR "
                            ."studentGroup LIKE :search OR "
                            ."studentPoints LIKE :search ";
        }
        if($order)
        {
            //проверяем по списку разрешенных значений
            if(in_array($order, self::$columns))
            {
                $query = $query . "ORDER BY $order ";
            }
            if($as == "desc")
            {
                $query = $query . 'DESC ';
            }
            else
            {
                $query = $query . 'ASC ';
            }
        }
        $query = $query . "LIMIT $limit OFFSET $offset";
        $stmt = $db->prepare($query);
        //связали параметры 
        $stmt->bindValue(':search', $search);
        //выполнили запрос
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addStudent(Student $student) : PDOStatement
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('INSERT INTO student VALUES(DEFAULT,:name, :surname, :group, :points, :gender, :local, :email, :cookie)');
        $stmt->bindValue(':name', $student->getName());
        $stmt->bindValue(':surname', $student->getSurname());
        $stmt->bindValue(':group', $student->getGroup());
        $stmt->bindValue(':points', $student->getPoints());
        $stmt->bindValue(':gender', $student->getGender());
        $stmt->bindValue(':local', $student->getLocal());
        $stmt->bindValue(':email', $student->getEmail());
        $stmt->bindValue(':cookie', $student->getCookie());
        
        $stmt->execute();

        return $stmt;
    }
 
    public static function getStudentByCookie($cookie)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM student WHERE studentCookie LIKE :cookie');
        //связали параметры
        $stmt->bindValue(':cookie', $cookie);
        //выполнили запрос
        $stmt->execute();
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($stmt){
            return new Student($stmt['studentName'], $stmt['studentSurname'], 
                    $stmt['studentGroup'], $stmt['studentPoints'], $stmt['studentEmail'],
                    $stmt['studentLocal'], $stmt['studentGender'], $stmt['studentCookie']);
        }
        else
        {
            return NULL;
        }
    }
    
    public static function getCountStudents() : int
    {
        $db = Db::getConnection();
        $stmt = $db->query("SELECT COUNT(*) FROM student");
        $countStudents = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
        return $countStudents;
    }
    
    public static function getCountSearchStudents($search) : int
    {
        $search = "%$search%";
        $db = Db::getConnection(); 
        $stmt = $db->prepare("SELECT COUNT(*) "
                                            ."FROM student "
                                            ."WHERE studentName LIKE :search OR "
                                            ."studentSurname LIKE :search OR "
                                            ."studentGroup LIKE :search OR "
                                            ."studentPoints LIKE :search");
        //связали параметры
        $stmt->bindValue(':search', $search);
        //выполнили запрос
        $stmt->execute();
        $countStudents = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
        return $countStudents;
    }
    
    public static function updateStudentByCookie(Student $student) : PDOStatement
    {
        $db = Db::getConnection();

         $stmt = $db->prepare("UPDATE student SET studentName = :studentName, "
         . "studentSurname = :studentSurname, studentGroup = :studentGroup, "
         . "studentPoints = :studentPoints, studentLocal = :studentLocal, "
         . "studentGender = :studentGender, studentEmail = :studentEmail "
         . "WHERE studentCookie = :studentCookie");
        //связали параметры

        $stmt->execute(array(':studentName' => $student->getName(), ':studentSurname' => $student->getSurname(),
            ':studentGroup' => $student->getGroup(), ':studentPoints' => $student->getPoints(), ':studentLocal' => $student->getLocal(), 
            ':studentGender' => $student->getGender(), ':studentEmail' => $student->getEmail(), ':studentCookie' => $student->getCookie()));
        
        return $stmt;
    }
}