<?php

/* Block/footer.twig */
class __TwigTemplate_65b3eb19a47f59fcf3243d14fa7ccdb9a506427eec303191c655b9553ce5ef5a extends Twig_Template
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
        // line 22
        echo "<div class=\"container-fluid inner\">
    <ul>
        <li><a href=\"";
        // line 24
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("help_about");
        echo "\">当サイトについて</a></li>
        <li><a href=\"";
        // line 25
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("help_privacy");
        echo "\">プライバシーポリシー</a></li>
        <li><a href=\"";
        // line 26
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("help_tradelaw");
        echo "\">特定商取引法に基づく表記</a></li>
        <li><a href=\"";
        // line 27
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("contact");
        echo "\">お問い合わせ</a></li>
    </ul>
    <div class=\"footer_logo_area\">
        <p class=\"logo\"><a href=\"";
        // line 30
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("homepage");
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "shop_name", array()), "html", null, true);
        echo "</a></p>
        <p class=\"copyright\">
            <small>copyright (c) ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "shop_name", array()), "html", null, true);
        echo " all rights reserved.</small>
        </p>
    </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "Block/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 32,  41 => 30,  35 => 27,  31 => 26,  27 => 25,  23 => 24,  19 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/footer.twig", "/home/ubuntu/workspace/src/Eccube/Resource/template/default/Block/footer.twig");
    }
}
