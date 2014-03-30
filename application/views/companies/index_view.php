<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active">ข้อมูลหน่วยงาน</li>
</ul>

<legend>ข้อมูลทั่วไปของสถานประกอบการ</legend>

<form action="#" class="form-horizontal">
    <div class="control-group">
        <label class="control-label" for="txt_name">ชื่อกิจการ</label>
        <div class="controls">
            <input type="text" id="txt_name" value="<?php echo $companies->name; ?>" class="col-span-12" placeholder="...">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="txt_address">ที่อยู่</label>
        <div class="controls">
            <input type="text" id="txt_address" class="col-span-12" value="<?php echo $companies->address; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="txt_tax_code">เลขประจำตัวผู้เสียภาษี</label>
        <div class="controls">
            <input type="text" id="txt_tax_code" class="col-span-6" placeholder="..." value="<?php echo $companies->tax_code; ?>">

        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_telephone">โทรศัพท์</label>
        <div class="controls">
            <input type="text" id="txt_telephone" class="col-span-6" placeholder="..." value="<?php echo $companies->telephone; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="txt_fax">แฟกซ์</label>
        <div class="controls">
            <input type="text" id="txt_fax" class="col-span-6" placeholder="..." value="<?php echo $companies->fax; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="txt_email">อีเมล์</label>
        <div class="controls">
            <input type="text" id="txt_email" class="col-span-6" placeholder="..." value="<?php echo $companies->email; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="txt_url">เว็บไซต์</label>
        <div class="controls">
            <input type="text" id="txt_url" class="col-span-6" placeholder="..."value="<?php echo $companies->url; ?>">
        </div>
    </div>

</form>

<form class="form-actions">
    <button class="btn btn-success" type="button" id="btn_save">
        <i class="icon-plus-sign"></i> ปรับปรุงข้อมูล
    </button>
    <a class="btn" href="<?=site_url('companies/uploads')?>">
        <i class="icon-upload-alt"></i> อัปโหลดโลโก้
    </a>
</form>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/companies.js"></script>
