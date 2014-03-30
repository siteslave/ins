<?php $c = get_company_detail(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$c->name?> : ระบบงานคอมพิวเตอร์และอุปกรณ์</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=base_url()?>assets/bootstrap/js/html5shiv.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?=base_url()?>assets/bootstrap/ico/favicon.png">

</head>
<body>

<script src="<?=base_url()?>assets/libs/jquery.min.js"></script>

<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-popover.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-button.js"></script>

<!-- Libraries -->
<script src="<?=base_url()?>assets/libs/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/libs/bootstrap-datepicker.th.js"></script>
<script src="<?=base_url()?>assets/libs/highcharts.js"></script>
<script src="<?=base_url()?>assets/libs/jquery.blockUI.min.js"></script>
<script src="<?=base_url()?>assets/libs/jquery.cookie.min.js"></script>
<script src="<?=base_url()?>assets/libs/jquery.freeow.min.js"></script>
<script src="<?=base_url()?>assets/libs/jquery.maskedinput.min.js"></script>
<script src="<?=base_url()?>assets/libs/jquery.numeric.min.js"></script>
<script src="<?=base_url()?>assets/libs/jquery.paging.min.js"></script>
<script src="<?=base_url()?>assets/libs/numeral.min.js"></script>
<script src="<?=base_url()?>assets/libs/taffy.min.js"></script>
<script src="<?=base_url()?>assets/libs/typeahead.js"></script>
<script src="<?=base_url()?>assets/libs/underscore.min.js"></script>

<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/holder/holder.js"></script>

<script src="<?=base_url()?>assets/apps/apps.js"></script>
<script src="<?=base_url()?>assets/apps/users.js"></script>

<style>

    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .form-signin input[type="text"]:focus,
    .form-signin input[type="password"]:focus {
        z-index: 2;
    }
    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

</style>

    <div class="container">
        <?=$content_for_layout?>
    </div>
</body>
</html>