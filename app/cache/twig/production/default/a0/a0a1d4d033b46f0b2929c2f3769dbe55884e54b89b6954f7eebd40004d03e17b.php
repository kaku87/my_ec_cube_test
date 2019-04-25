<?php

/* Amazonpay/Resource/template/amazonpaybutton.twig */
class __TwigTemplate_d20c29f6337280029a30acdbd8ce5b87f1a723f8173adf36f311f6b61bc67d6c extends Twig_Template
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
        echo "<script type='text/javascript'>
\twindow.onAmazonLoginReady = function() {
\t\tamazon.Login.setClientId('amzn1.application-oa2-client.322fd99d151c4e6cbea1889e5d8aef62');
\t};
</script>
<!-- テスト環境JS -->
<script type=\"text/javascript\" src=\"https://static-fe.payments-amazon.com/OffAmazonPayments/jp/sandbox/lpa/js/Widgets.js\"></script>
<!-- amazonでお支払いボタン -->
<div id=\"AmazonPayButton\"></div>
<!-- amazonでお支払いボタンJS -->
<script type='text/javascript'>
\tvar authRequest;
\tOffAmazonPayments.Button(\"AmazonPayButton\", \"A37V6UCLTXYT8M\", {
\t\ttype:  \"PwA\",
\t\tcolor: \"Gold\",
\t\tsize:  \"medium\",
\t\tauthorization: function() {
\t\t\tloginOptions = {scope: \"profile payments:widget payments:shipping_address\", popup: true};
\t\t\tauthRequest = amazon.Login.authorize (loginOptions, \"";
        // line 19
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPath("cart_buystep");
        echo "\");
\t\t},
\t\tonError: function(error) {
\t\t\t// your error handling code.
\t\t\t// alert(\"The following error occurred: \"
\t\t\t//  + error.getErrorCode()
\t\t\t//  + ' - ' + error.getErrorMessage());
\t\t}
\t});
</script>";
    }

    public function getTemplateName()
    {
        return "Amazonpay/Resource/template/amazonpaybutton.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 19,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Amazonpay/Resource/template/amazonpaybutton.twig", "/home/ubuntu/workspace/app/Plugin/Amazonpay/Resource/template/amazonpaybutton.twig");
    }
}
