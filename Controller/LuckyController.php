<?php


class LuckyController
{
    /**
     * @author Maks Voytenko <m.voytenko1991@gmail.com>
     * @Route(path="/Lucky1" , name="Lucky_Lucky1")
     * @return array[]
     */
    public function Lucky1()
    {
        $N1 = rand(1, 100000);
        return ['template' => 'Lucky/Lucky1','args' => ['Text' => 'Lucky1', 'N1' => $N1]];
    }

    /**
     * @author Maks Voytenko <m.voytenko1991@gmail.com>
     * @Route(path="/Lucky2" , name="Lucky_Lucky2")
     * @return array[]
     */
    public function Lucky2()
    {
        $s1 = 'Str1';
        $s2 = 'Str1';

        return ['template' => 'Lucky/Lucky2','args' => ['str1' => $s1, 'str2' => $s2]];
    }
}
