<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li><a href="<?php echo site_url('reports'); ?>">ระบบรายงาน</a> </li>
    <li class="active">ตรวจสอบประวัติ</li>
</ul>
<form action="#" class="form-inline form-actions">

    <div class="row">
        <div class="col-span-4">
            <div class="input-group">
                <input type="text" id="txt_query" class="col-span-4" placeholder="รหัสสินค้า หรือ Serial number.">
                <span class="input-group-btn">
                    <button class="btn" type="button" id="btn_search">
                        <i class="icon-search"></i>
                        ค้นหา
                    </button>
                </span>
            </div>
        </div>
        <div class="col-span-3">
            <button class="btn btn-success" type="button" id="btn_export">
                <i class="icon-download-alt"></i> ส่งออก (PDF Export)
            </button>
        </div>
    </div>




</form>
<table class="table table-striped" id="tbl_list">
    <thead>
    <tr>
        <th>#</th>
        <th>วันที่</th>
        <th>เลขที่ใบรับซ่อม</th>
        <th>อาการ</th>
        <th>ผู้แจ้งซ่อม</th>
        <th>หน่วยงานที่แจ้ง</th>
        <th>ช่างผู้ปฏิบัติงาน</th>
        <th>ผลการซ่อม</th>
        <th>สถานะปัจจุบัน</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="9">กรุณาค้นหารายการ</td>
    </tr>
    </tbody>
</table>
<div id="main_paging" class="pagination">
    <ul></ul>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/reports.history.js"></script>
