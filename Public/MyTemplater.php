<?php


class MyTemplater
{
    // список переменных (название, открытие, закрытие )
    static protected $vars = ['BODY' => ['{%BODY%}','{%ENDBODY%}']];

    // накладываем данные на слой
    static public function GetHtml($layout, $action, $args)
    {
        $layout = file_get_contents($layout); // читаем слой
        $action = file_get_contents($action); // и данные

        // заменяем переменные в слое на их описание из экшена
        foreach (self::$vars as $key => $v)
        {
            $layout = str_replace(self::$vars[$key][0], self::getBlock($action,$key), $layout);
        }

        // меняем переменные, так же как и в твиге {{ var }} (пробелы обязательны)
        foreach ($args as $key => $v)
        {
            $s = '{{ '.$key.' }}';
            $layout = str_replace($s, $v, $layout);
        }

        return $layout;
    }

    // заменяем блоки на их описание
    static protected function getBlock($data, $block)
    {
        $Block = self::$vars[$block][0];
        $endBlock = self::$vars[$block][1];
        $res = substr($data, strpos($data, $Block)+strlen($Block),strpos($data, $endBlock)-strpos($data, $Block)-strlen($Block));
        return $res;
    }
}