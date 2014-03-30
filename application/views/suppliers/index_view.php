<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active">ข้อมูลบริษัท/ร้านค้า</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_main" data-toggle="tab"><i class="icon-th-list"></i> บริษัท/ร้านค้า</a></li>

    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <br>
            <blockquote>
                <p>จัดการข้อมูล บริษัท/ร้านค้า ในฐานข้อมูล</p>
            </blockquote>
            <form action="#" class="well well-small">
                <div class="row">
                    <div class="col-span-4">
                        <div class="input-group col-span-12">
                            <input type="text" id="txt_query" placeholder="ชื่อ หรือ ปล่อยว่างเพื่อแสดงทั้งหมด...">
                            <span class="input-group-btn">
                                <button class="btn" type="button" id="btn_search">
                                    <i class="icon-search"></i> ค้นหา
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <button class="btn btn-success" type="button" id="btn_new">
                            <i class="icon-plus-sign"></i> เพิ่มรายการ
                        </button>
                    </div>
                    <div class="col-offset-6">
                        <button class="btn pull-right" type="button" id="btn_print">
                            <i class="icon-download"></i> ส่งออก (PDF Export)
                        </button>
                    </div>
                </div>
            </form>
            <table class="table table-striped" id="tbl_list">
                <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อบริษัท/ร้านค้า</th>
                    <th>ชื่อผู้ติดต่อ</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>#</th>
                </tr>
                </thead>

                <tbody>
                </tbody>
            </table>

            <ul id="main_paging" class="pagination"></ul>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl_new">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-file-alt"></i> เพิ่ม/แก้ไข รายการ</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal">
                    <input type="hidden" id="txt_isupdate" value="0">
                    <div class="control-group">
                        <label class="control-label" for="txt_code">รหัส</label>
                        <div class="controls">
                            <input type="text" id="txt_code" class="col-span-6" placeholder="ปล่อยว่างเพื่อสร้างอัตโนมัติ" title="ปล่อยว่างเพื่อสร้างอัตโนมัติ">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_name">ชื่อหน่วยงาน</label>
                        <div class="controls">
                            <input type="text" id="txt_name" class="col-span-12" placeholder="...">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_address">ที่อยู่</label>
                        <div class="controls">
                            <input type="text" id="txt_address" class="col-span-12">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_contact_name">ชื่อผู้ติดต่อ</label>
                        <div class="controls">
                            <input type="text" id="txt_contact_name" class="col-span-6" placeholder="...">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_telephone">โทรศัพท์</label>
                        <div class="controls">
                            <input type="text" id="txt_telephone" class="col-span-6" placeholder="...">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_fax">แฟกซ์</label>
                        <div class="controls">
                            <input type="text" id="txt_fax" class="col-span-6" placeholder="...">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_email">อีเมล์</label>
                        <div class="controls">
                            <input type="text" id="txt_email" class="col-span-6" placeholder="...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="btn_save"><i class="icon-save"></i> บันทึกรายการ</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/suppliers.js"></script>
