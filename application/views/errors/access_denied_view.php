<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ระบบงานซ่อมบำรุง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <style>
        body {
            padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>


    <script type="text/javascript">
        base_url = '<?php echo base_url(); ?>';
    </script>
</head>

<body>
    <div class="offset3 span4">
      <div class="alert alert-block alert-error fade in" style="width: 680px;">
                <h4 class="alert-heading">Oh! Access denied!</h4>
                <p>คุณไม่มีสิทธิ์เข้าใช้งานเมนูนี้ กรุณาตรวจสอบสิทธิการเข้าถึงจากผู้ดูแลระบบ</p>
                <p>
                  <a class="btn btn-danger" href="<?php echo site_url();?>">หน้าหลัก</a>
                </p>
          </div>
    </div>
        
</body>
</html>