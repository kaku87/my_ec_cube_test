<?php

/* __string_template__2c1a60bce6ee77065c30e27ce97cda3195de9f4f71fd5cc6be20416dd1972b4c */
class __TwigTemplate_4cba013015964272efa4636d93cbbf7ff76b51ac875ba589672c9074f57d8ac0 extends Twig_Template
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
        echo "<div class=\"drawer_block pc header_bottom_area\">
    <div id=\"search\" class=\"search\">
        <form method=\"get\" id=\"searchform\" action=\"";
        // line 24
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPath("product_list");
        echo "\">
            <div class=\"search_inner\">
                ";
        // line 26
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "category_id", array()), 'widget');
        echo "
                <div class=\"input_search clearfix\">
                    ";
        // line 28
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), 'widget', array("attr" => array("placeholder" => "キーワードを入力")));
        echo "
                    <button type=\"submit\" class=\"bt_search\"><svg class=\"cb cb-search\"><use xlink:href=\"#cb-search\" /></svg></button>
                </div>
            </div>
            <div class=\"extra-form\">
                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 34
            echo "                    ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 35
                echo "                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'label');
                echo "
                        ";
                // line 36
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                        ";
                // line 37
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                    ";
            }
            // line 39
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "            </div>
        </form>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "__string_template__2c1a60bce6ee77065c30e27ce97cda3195de9f4f71fd5cc6be20416dd1972b4c";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 40,  62 => 39,  57 => 37,  53 => 36,  48 => 35,  45 => 34,  41 => 33,  33 => 28,  28 => 26,  23 => 24,  19 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__2c1a60bce6ee77065c30e27ce97cda3195de9f4f71fd5cc6be20416dd1972b4c", "");
    }
}
