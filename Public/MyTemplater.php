<?php

class MyTemplater
{
    /**
     * Cписок переменных (название, открытие, закрытие )
     * @var string[][]
     */
    protected static $vars = ['BODY' => ['{%BODY%}', '{%ENDBODY%}']];

    /**
     * Метод GetHtml накладывается переменные args и файл action на слой layout и вовзвращает код страницы
     *
     * @author Maks Voytenko <m.voytenko1991@gmail.com>
     *
     * @param string $layout
     * @param string $action
     * @param array  $args
     * @return string
     */
    public static function GetHtml($layout, $action, $args)
    {
        $layout = file_get_contents($layout); // читаем слой
        $action = file_get_contents($action); // и данные

        // заменяем переменные в слое на их описание из экшена
        foreach (self::$vars as $key => $v) {
            $layout = str_replace(self::$vars[$key][0], self::getBlock($action, $key), $layout);
        }

        // меняем переменные, так же как и в твиге {{ var }} (пробелы обязательны)
        foreach ($args as $key => $v) {
            $s = '{{ '.$key.' }}';
            $layout = str_replace($s, $v, $layout);
        }

        return $layout;
    }

    // заменяем блоки на их описание

    /**
     * Метод getBlock ищет в строке $data блок из массива vars и возвращает его.
     *
     * @author Maks Voytenko <m.voytenko1991@gmail.com>
     *
     * @param string $data
     * @param string $block
     * @return string
     */
    protected static function getBlock($data, $block)
    {
        $Block = self::$vars[$block][0];
        $endBlock = self::$vars[$block][1];
        $res = substr($data, strpos($data, $Block) + strlen($Block), strpos($data, $endBlock) - strpos($data, $Block) - strlen($Block));
        return $res;
    }
}
