<?php

/* home/home.php.twig */
class __TwigTemplate_d35f5c3f354f2d7803098f5000dbe9c81806ff0328671cb0c789652ac7d6a766 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("common/base/header.html.twig", "home/home.php.twig", 1)->display($context);
        // line 2
        echo "
Hello putos...!";
    }

    public function getTemplateName()
    {
        return "home/home.php.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }
}
/* {% include 'common/base/header.html.twig' %}*/
/* */
/* Hello putos...!*/
