<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li><a href="<?php echo site_url('services'); ?>">การให้บริการ</a> </li>
    <li class="active">ร้องขอรับบริการ (Request)</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_main" data-toggle="tab"><i class="icon-th-list"></i> รายการร้องขอ (Request)</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <br>
            <blockquote>
                <p>
                    ขอรับบริการจากผู้ให้บริการ
                </p>
            </blockquote>
            <form action="#" class="well well-small">
                <div class="row">
                    <div class="col-span-4">
                        <div class="input-group col-span-12">
                            <input type="text" id="txt_request_query" rel="tooltip"
                                   title="พิมพ์รหัสร้องขอ (Request number)" placeholder="รหัสร้องขอ (Request number)..">
                            <span class="input-group-btn">
                                <button class="btn" type="button" id="btn_request_search">
                                    <i class="icon-search"></i> ค้นหา
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-offset-2 col-span-6">
                        <div class="btn-group pull-right">
                            <a href="javascript:void(0);" class="btn btn-primary" data-name="btn_get_status" data-status="-2"><i class="icon-refresh"></i> ทั้งหมด</a>
                            <a href="javascript:void(0);" class="btn btn-success" data-name="btn_get_status" data-status="1"><i class="icon-ok"></i> ยืนยัน</a>
                            <a href="javascript:void(0);" class="btn" data-name="btn_get_status" data-status="0"><i class="icon-time"></i> รอตรวจสอบ</a>
                            <a href="javascript:void(0);" class="btn btn-danger" data-name="btn_get_status" data-status="-1"><i class="icon-trash"></i> ยกเลิก</a>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-hover" id="tbl_request_list">
                <thead>
                <tr>
                    <th></th>
                    <th>รหัส</th>
                    <th>วันที่</th>
                    <!--                    <th>หน่วยงาน</th>-->
                    <th>ผู้ติดต่อ</th>
                    <th>โทรศัพท์</th>
                    <th>รายละเอียด</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <!--                    <td>...</td>-->
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>
            <ul id="main_paging" class="pagination"></ul>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/request.js"></script>