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
\t<div class=\"page-header\">
\t\t<img src=\"";
        // line 7
        echo "web/images/unlp.jpg";
        echo "\" class=\"logotipo col-md-2\" />
  \t\t<h1 class=\"col-md-8\"> <small></small></h1>

  \t\t<div class=\"profile col-md-2\" id=\"profilePanel\">
  \t\t\t<div class=\"image_profile\">
  \t\t\t\t<img src=\"https://scontent-mia1-1.xx.fbcdn.net/hphotos-xpt1/v/t1.0-9/12417619_10153355266454103_4237973287739828278_n.jpg?oh=4c367141678cfe52bdb704e1fff55adc&oe=57431064\"
  \t\t\t\t/>
\t\t\t</div>
\t\t\t<div class=\"actionbuttons\">
\t\t\t\t<h6>
\t\t\t\t\t<a href=\"\">Mr Poronga</a>
\t\t\t\t</h6>
\t\t\t\t<a class=\"glyphicon glyphicon-off\">Logout</a>\t\t\t\t
\t\t\t</div>
  \t\t</div>
\t</div>
\t<div class=\"row col-md-12\">
\t\t";
        // line 24
        $this->loadTemplate("common/base/navbar.html.twig", "home/home.php.twig", 24)->display($context);
        // line 25
        echo "\t</div>
\t<div class=\"col-md-12 jumbotron\">
\t</div>
</div>
</body>

<script type=\"text/javascript\" src=\"";
        // line 31
        echo "vendor/twbs/bootstrap/assets/js/jquery.js";
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 32
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
        return array (  62 => 32,  58 => 31,  50 => 25,  48 => 24,  28 => 7,  21 => 2,  19 => 1,);
    }
}
/* {% include 'common/base/header.html.twig' %}*/
/* */
/* */
/* <body>*/
/* <div class="container">*/
/* 	<div class="page-header">*/
/* 		<img src="{{ 'web/images/unlp.jpg' }}" class="logotipo col-md-2" />*/
/*   		<h1 class="col-md-8"> <small></small></h1>*/
/* */
/*   		<div class="profile col-md-2" id="profilePanel">*/
/*   			<div class="image_profile">*/
/*   				<img src="https://scontent-mia1-1.xx.fbcdn.net/hphotos-xpt1/v/t1.0-9/12417619_10153355266454103_4237973287739828278_n.jpg?oh=4c367141678cfe52bdb704e1fff55adc&oe=57431064"*/
/*   				/>*/
/* 			</div>*/
/* 			<div class="actionbuttons">*/
/* 				<h6>*/
/* 					<a href="">Mr Poronga</a>*/
/* 				</h6>*/
/* 				<a class="glyphicon glyphicon-off">Logout</a>				*/
/* 			</div>*/
/*   		</div>*/
/* 	</div>*/
/* 	<div class="row col-md-12">*/
/* 		{% include 'common/base/navbar.html.twig' %}*/
/* 	</div>*/
/* 	<div class="col-md-12 jumbotron">*/
/* 	</div>*/
/* </div>*/
/* </body>*/
/* */
/* <script type="text/javascript" src="{{ 'vendor/twbs/bootstrap/assets/js/jquery.js' }}"></script>*/
/* <script type="text/javascript" src="{{ 'vendor/twbs/bootstrap/dist/js/bootstrap.min.js' }}"></script>*/
