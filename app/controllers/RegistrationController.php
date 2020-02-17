<?php

Class RegistrationController
{
    private $successMessage;
    private $errorMessage;
    
    public function actionIndex()
    {
        $cookie = isset($_COOKIE['student']) ? $_COOKIE['student'] : 0;
        
        //Если пользователь отправил данные
        if(isset($_POST['submitInput']))
        {
            if($cookie)
            {
                //заполняем с post поля
                $student = new Student($_POST['name'], $_POST['surName'], $_POST['group'], 
                        $_POST['points'], $_POST['email'], $_POST['local'], $_POST['gender'], $cookie);
                Validator::formatStudent($student);    //trim, firstToUpper имя/фамилию

                $errors = Validator::checkStudent($student);
               
                if(!$errors)
                {
                    if(StudentGateway::updateStudentByCookie($student))
                    {
                        $this->successMessage = 'Данные успешно изменены';
                    }
                    else
                    {
                        $this->errorMessage = 'Ошибка: пользователь с таким email уже существует';
                    }
                }
                else
                {
                    $this->errorMessage = "Ошибка при валидации данных";
                }
            }
            else
            {
                //генерируем куки
                $cookie = md5(rand(0, 10000)) . md5(rand(0, 10000));
                
                //валидация
                $student = new Student($_POST['name'], $_POST['surName'], $_POST['group'], 
                        $_POST['points'], $_POST['email'], $_POST['local'], $_POST['gender'], $cookie);
                
                Validator::formatStudent($student);    //trim, firstToUpper имя/фамилию
                
                $errors = Validator::checkStudent($student);
                
                if(!$errors)
                {
                    if(StudentGateway::addStudent($student))
                    {
                        setCookie('student', $cookie, time() + 7200);
                        $this->successMessage = 'Регистрация прошла успешно';
                    }
                }
                else
                {
                    $this->errorMessage = 'Не удалось добавить студента, ошибка валидации данных';
                }
            }

        }
        
        $currentStudent = StudentGateway::getStudentByCookie($cookie);
        
        include_once(ROOT . "/app/views/registration.phtml");
        
        return 1;

    }
}