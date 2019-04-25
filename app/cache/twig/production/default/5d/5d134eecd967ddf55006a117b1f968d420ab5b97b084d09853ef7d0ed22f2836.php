<?php

/* __string_template__910ca48608baff17e28c4ba72f2fb7f8cf58f50c302ae66e5c8fb23ab73f1b0b */
class __TwigTemplate_76128f664d5692bc106b766d6a03dac451f3ac2b0316e76c21dbe17e7e0f0fd3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__910ca48608baff17e28c4ba72f2fb7f8cf58f50c302ae66e5c8fb23ab73f1b0b", 22);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default_frame.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 24
        $context["body_class"] = "cart_page";
        // line 22
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 26
    public function block_main($context, array $blocks = array())
    {
        // line 27
        echo "<!-- Place this code in your HTML where you would like the
    Wallet widget to appear. -->
<div id=\"walletWidgetDiv\">
</div>

    <script>
        new OffAmazonPayments.Widgets.Wallet({
            sellerId: 'A37V6UCLTXYT8M',
            onPaymentSelect: function(orderReference) {
                // Replace this code with the action that you want to perform
                // after the payment method is selected.
    
                // Ideally this would enable the next action for the buyer
                // including either a \"Continue\" or \"Place Order\" button.
            },
            design: {
            designMode: 'responsive'
            },
    
            onError: function(error) {
                // Your error handling code.
                // During development you can use the following
                // code to view error messages:
                // console.log(error.getErrorCode() + ': ' + error.getErrorMessage());
                // See \"Handling Errors\" for more information.
            }
        }).bind(\"walletWidgetDiv\");
    </script>
    <h1 class=\"page-heading\">ログイン</h1>
    <div id=\"login_wrap\" class=\"container-fluid\">
        <form method=\"post\" action=\"";
        // line 57
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("login_check");
        echo "\">
            <input type=\"hidden\" name=\"_target_path\" value=\"shopping\" />
            <input type=\"hidden\" name=\"_failure_path\" value=\"shopping_login\" />
            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\">

            <div id=\"login_box\" class=\"login_cart row\">
                ";
        // line 63
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 64
            echo "                <div id=\"customer_box\" class=\"col-sm-8 col-sm-offset-2\" style=\"height: 330px;\">
                ";
        } else {
            // line 66
            echo "                <div id=\"customer_box\" class=\"col-sm-8\" style=\"height: 330px;\">
                ";
        }
        // line 68
        echo "                    <div id=\"customer_box__body\" class=\"column\">
                        <div id=\"customer_box__body_inner\" class=\"column_inner clearfix\">
                            <div class=\"icon\"><svg class=\"cb cb-user-circle\"><use xlink:href=\"#cb-user-circle\"></use></svg></div>
                            <div id=\"customer_box__login_email\" class=\"form-group\">
                                ";
        // line 72
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_email", array()), 'widget', array("attr" => array("style" => "ime-mode: disabled;", "placeholder" => "メールアドレス", "autofocus" => true)));
        echo " <br class=\"sp\">
                            </div>
                            <div id=\"customer_box__login_pass\" class=\"form-group\">
                                ";
        // line 75
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_pass", array()), 'widget', array("attr" => array("placeholder" => "パスワード")));
        echo "
                                ";
        // line 76
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_remember_me", array())) {
            // line 77
            echo "                                    ";
            if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
                // line 78
                echo "                                        <input type=\"hidden\" name=\"login_memory\" value=\"1\">
                                    ";
            } else {
                // line 80
                echo "                                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_memory", array()), 'widget');
                echo "
                                    ";
            }
            // line 82
            echo "                                ";
        }
        // line 83
        echo "                            </div>
                            <div class=\"extra-form form-group\">
                                ";
        // line 85
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 86
            echo "                                    ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 87
                echo "                                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'row');
                echo "
                                        ";
                // line 88
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                                        ";
                // line 89
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                                    ";
            }
            // line 91
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "                            </div>
                            ";
        // line 93
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 94
            echo "                                <div id=\"customer_box__error_message\" class=\"form-group\">
                                    <span class=\"text-danger\">";
            // line 95
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["error"]) ? $context["error"] : null));
            echo "</span>
                                </div>
                            ";
        }
        // line 98
        echo "                            <div id=\"customer_box__login_button\" class=\"btn_area\">
                                <p><button type=\"submit\" class=\"btn btn-info btn-block btn-lg\">ログイン</button></p>
                                <ul id=\"customer_box__login_menu\">
                                <li><a href=\"";
        // line 101
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("forgot");
        echo "\">ログイン情報をお忘れですか？</a></li>
                                <li><a href=\"";
        // line 102
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("entry");
        echo "\">新規会員登録</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->

                ";
        // line 109
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 110
            echo "                ";
        } else {
            // line 111
            echo "                <div id=\"guest_box\" class=\"col-sm-4\" style=\"height: 330px;\">
                    <div id=\"guest_box__body\" class=\"column\">
                        <div id=\"guest_box__body_inner\" class=\"column_inner\">
                            <p id=\"guest_box__message\" class=\"message\">会員登録をせずに購入手続きをされたい方は、下記よりお進みください。
                            <p id=\"guest_box__confirm_button\" class=\"btn_area\">
                                <a href=\"";
            // line 116
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_nonmember");
            echo "\" class=\"btn btn-info btn-block btn-lg\">ゲスト購入</a></p>
                        </div>
                    </div>
                </div><!-- /.col -->
                ";
        }
        // line 121
        echo "            </div><!-- /.row -->
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__910ca48608baff17e28c4ba72f2fb7f8cf58f50c302ae66e5c8fb23ab73f1b0b";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 121,  198 => 116,  191 => 111,  188 => 110,  186 => 109,  176 => 102,  172 => 101,  167 => 98,  161 => 95,  158 => 94,  156 => 93,  153 => 92,  147 => 91,  142 => 89,  138 => 88,  133 => 87,  130 => 86,  126 => 85,  122 => 83,  119 => 82,  113 => 80,  109 => 78,  106 => 77,  104 => 76,  100 => 75,  94 => 72,  88 => 68,  84 => 66,  80 => 64,  78 => 63,  72 => 60,  66 => 57,  34 => 27,  31 => 26,  27 => 22,  25 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__910ca48608baff17e28c4ba72f2fb7f8cf58f50c302ae66e5c8fb23ab73f1b0b", "");
    }
}
