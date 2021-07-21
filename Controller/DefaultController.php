<?php
class DefaultController
{
    /**
     * @Route(path="/", name="Default_Index")
     */
    public function Index()
    {
        return ['template' => 'Default/Index','args' => ['Text'=>'Index']];
    }

    /**
     * @Route(path="/About" , name="Default_About")
     */
    public function About()
    {
        return ['template' => 'Default/About','args' => ['Text'=>'About']];
    }
}