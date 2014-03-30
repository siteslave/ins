<ul class="breadcrumb">
    <li class="active">หน้าหลัก</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-th-list"></i> ค้นหารายการแจ้งซ่อม</a></li>
        <li><a href="#tab2" data-toggle="tab" title="ร้องขอรับบริการจากผู้ให้บริการ" rel="tooltip">
                <i class="icon-comments-alt"></i> ขอรับบริการ (Request)
            </a>
        </li>
    </ul>
    <div class="tab-content active">
        <div class="tab-pane active" id="tab1">
            <br>
            <blockquote>
               <p> ค้นหาข้อมูลสถานะซ่อม และ รายละเอียดต่างๆ ในการให้บริการ</p>
            </blockquote>

            <form action="#" class="well well-small">
                <div class="row">
                    <div class="col-span-4">
                        <div class="input-group col-span-12">
                            <input type="text" id="txt_query" placeholder="หมายเลขรับซ่อม หรือ รหัสสินค้า...">
                            <span class="input-group-btn">
                                <button class="btn" type="button" id="btn_search">
                                    <i class="icon-search"></i> ค้นหา
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-hover" id="tbl_list">
                <thead>
                <tr>
                    <th>วันที่</th>
                    <th>เลขที่รับซ่อม</th>
                    <th>รหัสสินค้า</th>
                    <th>ประเภท</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
<!--                    <th>อาการ</th>
                    <th>ผลการให้บริการ</th>-->
                    <th>วันจำหน่าย</th>
                    <th>สถานะ</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
<!--                    <td>...</td>
                    <td>...</td>-->
                    <td>...</td>
                    <td>...</td>
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
        </div>
        <div class="tab-pane" id="tab2">
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
                    <div class="col-span-8">
                        <button class="btn btn-success" rel="tooltip"
                                title="สร้างรายการร้องขอ (Request)" type="button" id="btn_new_request">
                            <i class="icon-plus-sign-alt"></i> ร้องขอรับบริการ
                        </button>
                        <div class="btn-group pull-right">
                            <a href="javascript:void(0);" class="btn" data-name="btn_get_status" data-status="-2"><i class="icon-refresh"></i> ทั้งหมด</a>
                            <a href="javascript:void(0);" class="btn btn-primary" data-name="btn_get_status" data-status="1"><i class="icon-ok"></i> ยืนยัน</a>
                            <a href="javascript:void(0);" class="btn" data-name="btn_get_status" data-status="0"><i class="icon-time"></i> รอตรวจสอบ</a>
                            <a href="javascript:void(0);" class="btn btn-primary" data-name="btn_get_status" data-status="-1"><i class="icon-trash"></i> ยกเลิก</a>
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

<div class="modal fade" id="mdl_new_request">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><i class="icon-file-alt"></i> เพิ่มรายการ</h3>
            </div>
            <div class="modal-body">
                <blockquote>
                  <p>บันทึกข้อมูลขอรับบริการ</p>
                </blockquote>
                <form action="#" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="txt_new_customer">หน่วยงาน</label>
                        <div class="controls">
                            <input class="col-span-6" id="txt_new_customer" type="text">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_new_contact">ชื่อผู้ติดต่อ</label>
                        <div class="controls">
                            <input class="col-span-6" id="txt_new_contact" type="text">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_new_telephone">เบอร์โทรศัพท์</label>
                        <div class="controls">
                            <input class="col-span-6" id="txt_new_telephone" type="text">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_new_detail">รายละเอียด</label>
                        <div class="controls">
                            <textarea name="" id="txt_new_detail" rows="5"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="btn_save_request"><i class="icon-save"></i> บันทึกรายการ</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/clients.js"></script>
