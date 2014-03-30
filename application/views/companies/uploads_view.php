<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li><a href="<?php echo site_url('companies'); ?>">ข้อมูลกิจการ</a></li>
    <li class="active">อัปโหลดโลโก้</li>
</ul>

<legend>อัปโหลดไฟล์โลโก้</legend>
<?php
    if(isset($success))
    {
        if($success == FALSE)
        {
            echo '
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>เกิดข้อผิดพลาด</strong> ' . $error . ' </div>';
        }
        else
        {
            echo '
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>สำเร็จ</strong> อัปโหลดไฟล์เสร็จเรียบร้อยแล้ว </div>';
        }

    }
?>
<?php echo form_open_multipart(site_url('companies/do_upload'), array('class'=> 'form-horizontal')); ?>
    <div class="control-group">
        <label class="control-label" for="txt_name">เลือกไฟล์</label>
        <div class="controls">
            <input type="file" name="userfile" class="col-span-12" placeholder="...">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="txt_name"></label>
        <div class="controls">
            <button class="btn btn-success" type="submit">
                <i class="icon-upload-alt"></i> อัปโหลดไฟล์
            </button>
        </div>
    </div>
</form>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/companies.js"></script>
