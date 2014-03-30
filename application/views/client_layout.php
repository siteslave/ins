<?php $c = get_company_detail(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$c->name?> : ระบบงานคอมพิวเตอร์และอุปกรณ์</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/font-awesome-ie7.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/typeahead.min.css" rel="stylesheet">

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

    <style>
        body {
            padding-top: 50px;
        }

        .jumbotron {
            margin-top: 20px;
        }

            /* Wrapper for page content to push down footer */
        #wrap {
            min-height: 100%;
            height: auto !important;
            height: 100%;
            /* Negative indent footer by its height */
            margin: 0 auto -60px;
        }

            /* Set the fixed height of the footer here */
        #push,
        #footer {
            height: 60px;
        }
        #footer {
            background-color: #f5f5f5;
        }

            /* Lastly, apply responsive CSS fixes as necessary */
        @media (max-width: 767px) {
            #footer {
                margin-left: -20px;
                margin-right: -20px;
                padding-left: 20px;
                padding-right: 20px;
            }
        }
        .container .credit {
            margin: 20px 0;
        }
    </style>

    <link href="<?php echo base_url(); ?>assets/apps/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/freeow/freeow.css" rel="stylesheet">

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

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/apps.js"></script>

    <script type="text/javascript">
        base_url = '<?php echo base_url(); ?>';
        site_url = '<?php echo site_url(); ?>';
    </script>
</head>

<body>
<div id="freeow" class="freeow freeow-bottom-right"></div>
<div class="navbar navbar-fixed-top">
    <div class="container">
        <a class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a class="navbar-brand" href="#">
            <i style="display: none;" id="spinner" class="icon-spinner icon-spin"></i>
            E-Service
        </a>

        <div class="nav-collapse collapse">
            <ul class="nav">
                <li>
                    <a href="<?php echo site_url('clients'); ?>">
                        <i class="icon-home"></i> หน้าหลัก
                    </a>
                </li>
            </ul>

            <?php
            if( get_current_name() ) {
                ?>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-folder-open"></i> <?php echo get_current_name(); ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-name="chk-pass"><i class="icon-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('users/logout'); ?>"><i class="icon-off"></i>  ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>

            <?php
            }
            ?>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <?php echo $content_for_layout; ?>
</div> <!-- /container -->

<div id="push"></div>
</div>

<div id="footer">
    <div class="container">
        <p class="text-muted credit">
            &copy;Copyright 2013 <?=$c->name?>, Powered by <a href="http://owlsoft.in.th">Owl Software Co., Ltd.</a></p>
    </div>
</div>

<div class="modal fade" id="mdl_change_password">
    <div class="modal-dialog" style="width: 640px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><i class="icon-key"></i> เปลี่ยนรหัสผ่าน</h3>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="txt_old_password">รหัสผ่านเก่า</label>
                        <div class="controls">
                            <input type="password" id="txt_old_password" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_new_password">รหัสผ่านใหม่</label>
                        <div class="controls">
                            <input type="password" id="txt_new_password" class="input-xlarge">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="btn_do_change_password"><i class="icon-plus-sign icon-white"></i> เปลี่ยนรหัสผ่าน</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
