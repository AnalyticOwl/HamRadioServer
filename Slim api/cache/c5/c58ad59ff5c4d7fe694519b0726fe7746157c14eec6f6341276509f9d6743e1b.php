<?php

/* resetPassword.twig */
class __TwigTemplate_30f8608d252b8e2f21e462dfea42b7747078ec289ee79e89765dfcbc7a6d798d extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!-- <link href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4\" crossorigin=\"anonymous\">
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js\" integrity=\"sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm\" crossorigin=\"anonymous\"></script> -->
<script
              src=\"http://code.jquery.com/jquery-3.3.1.min.js\"
              integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\"
              crossorigin=\"anonymous\"></script>

<div class=\"container\">
\t<div class=\"row\">
\t\t<div class=\"col-md-10 col-md-offset-1\">
\t\t\t<div class=\"panel panel-default\">
\t\t\t\t<div class=\"panel-heading\"></div>
\t\t\t\t <div class=\"alert alert-success\" id=\"message\" style=\"display:none;\">
                            
                        </div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<form class=\"form-horizontal\" method=\"POST\" id=\"changePasswordForm\" >
\t\t\t\t\t\t <form  role=\"form\" method=\"POST\" action=\"apiController@resetPassword\" onsubmit=\"return validate();\">
                       <!--   {!! csrf_field() !!} -->
\t\t\t\t\t\t 
\t\t\t\t\t\t <div class=\"form-group\">
                            <label for=\"email\" class=\"col-md-4 control-label\">Password:</label>

                            <div class=\"col-md-6\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><i class=\"fa fa-lock fa-lg\" aria-hidden=\"true\"></i></span>
\t\t\t\t\t\t\t\t    <input type=\"password\" name=\"password\" id=\"password\" value=\"\" class=\"form-control\" />
\t\t\t\t\t\t\t\t</div>

                                 </div>
                        </div>
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"form-group\">
                            <label for=\"email\" class=\"col-md-4 control-label\">Confirm Password:</label>

                            <div class=\"col-md-6\">
\t\t\t                <div class=\"input-group\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><i class=\"fa fa-lock fa-lg\" aria-hidden=\"true\"></i></span>
\t\t\t\t\t\t\t\t    <input type=\"password\" class=\"form-control\" name=\"con_password\" id=\"con_password\" />
\t\t\t\t\t\t\t</div>

                                 </div>
                        </div>
\t\t\t\t\t\t 
\t\t\t\t\t\t <div class=\"form-group\">
                            <div class=\"col-md-8 col-md-offset-4\">
                            <input type=\"hidden\" class=\"input\" name=\"email\" value=\"<?=\$email?>\" />
                           
                            <button type=\"button\"  value=\"\" name=\"form\" class=\"btn btn-primary\" onclick=\"co_password();\">Submit</button>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
                      </form>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>
\t<script src=\"//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js\"></script>
    <link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">
<script>
function validate()
{
\tconf_password = co_password();
\tif(conf_password == false)
\t{
\t\treturn false;
\t}
}

function co_password()
{
\t
\tpswd = \$('#password').val();
\tc_pswd = \$('#con_password').val();
\t
\tif(pswd != c_pswd)
\t{
\t\talert(\"Password does not match\");
\t\treturn false;
\t}
\telse
\t{
\t\t
\t\t\$.ajax ({
\t\t\turl: \"../changePassword\",
\t\t\tdataType: 'json',
\t\t\tasync: false,
\t\t\tmethod: 'POST',
\t\t\tdata : \$('#changePasswordForm').serialize(),
\t\t\tsuccess: function (response) {
\t\t\t\tif(response.status == 1){
\t\t\t\t\t\$('#message').show();
\t\t\t\t\t\$('#message').html('Password has been update.');
\t\t\t\t\t
\t\t\t\t  }
\t\t\t\t 
\t\t\t\t }
\t\t\t\t});
\t}
}
</script>

";
    }

    public function getTemplateName()
    {
        return "resetPassword.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "resetPassword.twig", "/opt/lampp/htdocs/api/templates/resetPassword.twig");
    }
}
