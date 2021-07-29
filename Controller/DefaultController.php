<?php
class DefaultController
{
    /**
     * @author Maks Voytenko <m.voytenko1991@gmail.com>
     * @Route(path="/", name="Default_Index")
     * @return array[]
     */
    public function Index()
    {
        return ['template' => 'Default/Index', 'args' => ['Text' => 'Index']];
    }

    /**
     * @author Maks Voytenko <m.voytenko1991@gmail.com>
     * @Route(path="/About" , name="Default_About")
     * @return array[]
     */
    public function About()
    {
        return ['template' => 'Default/About', 'args' => ['Text' => 'About']];
    }
}
