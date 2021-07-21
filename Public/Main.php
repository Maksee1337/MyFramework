<?php

class main
{
    // контструктор
    public function __construct()
    {
        $fl = 0; // найдет ли нужный метод
        $files = scandir('../Controller'); // список файлов в контроллерами
        foreach ($files as $v)
        { // проходимся по всем файлам
            if(strpos($v,'Controller.php')) // если имя файла соответствует шаблону
            {
                include '../Controller/'.$v; // подключаем файлы с контроллерами
                $className = explode('.',$v)[0]; // получаем имя класса. оно должно называться как и имя файла
                $class  = new ReflectionClass($className); // получаем информацию о классе
                foreach ($class->getMethods() as $method){ // проходимся по методам
                    // ищем метод у которого в аннотациях наш путь
                    if(strpos(strtolower($method->getDocComment()), 'path="'.$this->GetMyPath().'"'))
                    {
                        $obj = new $className(); // создаем объект класса
                        $methodName = $method->getName(); // название метода который соответствуе пути
                        $res = $obj->$methodName(); // вызываем метод
                        $fl = 1;  // ставим флаг в 1. значит мы нашли необходимый метод
                        goto end; // переходим на метку. не знаю насколько это правильно.
                                  // иначе надо работать с флагами, чтоб выйти из двух циклом
                    }
                 }
            }
        }

        end: // пришли по метке
        if(!$fl)
        { // если флаг 0 . выводим сообщение что ссылка не найдена
            echo 'Page '.$this->GetMyPath().' not found.';
            die; // умираем
        }else
            { // если метод для пути сущестует
            include "../Public/MyTemplater.php"; // подключаем мой шаблонизатор

            // передаем основной слой, экшен , ургументы , которые вернул метод
            echo MyTemplater::GetHtml('../Template/Layout.MyTempl.html', '../Template/'.$res['template'].'.MyTempl.html', $res['args']);
        }
    }

    // получаем адрес страницы
    private function GetMyPath()
    {
        $url = strtolower(explode('?', $_SERVER['REQUEST_URI'])[0]);
        if(substr($url,strlen($url)-1,1) == '/' && strlen($url)>1){
            $url = substr($url,0, strlen($url)-1);
        }
        return $url;
    }


}