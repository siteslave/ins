<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active">นำข้อมูลกลับมาใช้</li>
</ul>

<legend>อัปโหลดไฟล์เพื่อนำข้อมูลกลับมาใช้</legend>
<?php
if(isset($success))
{
    if($success == FALSE)
    {
        echo '
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>เกิดข้อผิดพลาด</strong> ' . $error . ' </div>';

        ?>
<?php echo form_open_multipart(site_url('admins/do_restore'), array('class'=> 'form-horizontal')); ?>
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
<?php
    }
    else
    {
        echo '
                <div class="alert alert-success">
                    <strong>สำเร็จ</strong> นำข้อมูลเข้าเสร็จเรียบร้อยแล้ว </div>';
    }

}
else
{
    ?>

    <?php echo form_open_multipart(site_url('admins/do_restore'), array('class'=> 'form-horizontal')); ?>
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
<?php
}
?>

