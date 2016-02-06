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
<body>
<div class=\"container\">
\t
\t";
        // line 6
        $this->loadTemplate("common/base/head.html.twig", "home/home.php.twig", 6)->display($context);
        // line 7
        echo "
\t";
        // line 8
        $this->loadTemplate("common/base/navbar.html.twig", "home/home.php.twig", 8)->display($context);
        // line 9
        echo "\t
\t<div class=\"col-md-12 jumbotron\">
\t</div>

</div>
</body>

<script type=\"text/javascript\" src=\"";
        // line 16
        echo "vendor/twbs/bootstrap/assets/js/jquery.js";
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 17
        echo "vendor/twbs/bootstrap/dist/js/bootstrap.min.js";
        echo "\"></script>";
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
        return array (  47 => 17,  43 => 16,  34 => 9,  32 => 8,  29 => 7,  27 => 6,  21 => 2,  19 => 1,);
    }
}
/* {% include 'common/base/header.html.twig' %}*/
/* */
/* <body>*/
/* <div class="container">*/
/* 	*/
/* 	{% include 'common/base/head.html.twig' %}*/
/* */
/* 	{% include 'common/base/navbar.html.twig' %}*/
/* 	*/
/* 	<div class="col-md-12 jumbotron">*/
/* 	</div>*/
/* */
/* </div>*/
/* </body>*/
/* */
/* <script type="text/javascript" src="{{ 'vendor/twbs/bootstrap/assets/js/jquery.js' }}"></script>*/
/* <script type="text/javascript" src="{{ 'vendor/twbs/bootstrap/dist/js/bootstrap.min.js' }}"></script>*/
