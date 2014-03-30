<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active"></li>บริการ
</ul>
<div class="navbar">
    <form action="#" class="navbar-form pull-left">
        <label for="txt_reg_query">ค้นหา</label>
        <input style="width: 200px;" id="txt_query" type="text" placeholder="พิมพ์เลขที่ใบรับซ่อม"
               rel="tooltip" title="พิมพ์เลขที่ใบรับซ่อม">
        <button class="btn btn-primary" type="button" id="btn_do_search">
            <i class="icon-search"></i>
        </button>
    </form>
    <ul class="nav">
        <li class="divider"></li>
    </ul>
    <form action="#" class="navbar-form pull-left">
        <select name="" id="sl_order_customers" style="width: 230px;">
            <option value="">ระบุหน่วยงาน/ลูกค้า</option>
            <option value="">ทั้งหมด</option>
            <?php
            foreach($customers as $r)
                echo '<option value="'.$r->code.'">' . $r->name .'</option>';
            ?>
        </select>
        <button class="btn btn-primary" type="button" data-id="btn_do_refresh"
                rel="tooltip" title="แสดงรายการ">
            <i class="icon-refresh"></i>
        </button>
    </form>
    <ul class="nav">
        <li class="divider"></li>
    </ul>
    <form action="#" class="navbar-form pull-left">
        <select name="" id="sl_order_technician" style="width: 230px;">
            <option value="">ระบุช่างผู้รับผิดชอบ</option>
            <option value="">ทั้งหมด</option>
            <?php
            $technicians = get_technician_list();
            foreach($technicians as $r2)
                echo '<option value="'.$r2->user_code.'">' . $r2->fullname .'</option>';
            ?>
        </select>
        <button class="btn btn-primary" type="button" data-id="btn_do_refresh"
            rel="tooltip" title="แสดงรายการ">
            <i class="icon-refresh"></i>
        </button>
    </form>
    <ul class="nav">
        <li class="divider"></li>
    </ul>
    <form action="#" class="navbar-form pull-left">
        <button type="button" class="btn btn-success" id="bnt_show_register"
                rel="tooltip" title="ลงทะเบียนรับซ่อมรายการใหม่">
            <i class="icon-file"></i> ลงทะเบียน
        </button>
    </form>
</div>
<br />
<input type="hidden" id="txt_service_status" value="1">
<input type="hidden" id="txt_service_code" value="">
<input type="hidden" id="txt_product_code" value="">

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-name="tab_service" data-id="1" data-toggle="tab"><i class="icon-time"></i> รอซ่อม</a></li>
        <li><a href="#tab1" data-name="tab_service" data-id="2" data-toggle="tab"><i class="icon-play"></i> กำลังซ่อม</a></li>
        <li><a href="#tab1" data-name="tab_service" data-id="3" data-toggle="tab"><i class="icon-pause"></i> พักการซ่อม</a></li>
        <li><a href="#tab1" data-name="tab_service" data-id="4" data-toggle="tab"><i class="icon-off"></i> ยกเลิกการซ่อม</a></li>
        <li><a href="#tab1" data-name="tab_service" data-id="5" data-toggle="tab"><i class="icon-share"></i> ส่งซ่อม</a></li>
        <li><a href="#tab1" data-name="tab_service" data-id="6" data-toggle="tab"><i class="icon-share-alt"></i> ส่งเคลม</a></li>
        <li><a href="#tab1" data-name="tab_service" data-id="7" data-toggle="tab"><i class="icon-ok-sign"></i> ซ่อมเสร็จ</a></li>
        <li><a href="#tab1" data-name="tab_service" data-id="8" data-toggle="tab"><i class="icon-home"></i> รับเครื่องกลับ</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <table class="table table-striped table-hover" id="tbl_service_list">
                <thead>
                <tr>
                    <th>เลขที่ใบรับซ่อม</th>
                    <th>วันที่แจ้ง</th>
                    <th>รหัสสินค้า</th>
                    <th>ประเภท</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>หน่วยงาน/ร้านค้า</th>
                    <th>ช่างผู้รับผิดชอบ</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
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

            <ul id="main_paging" class="pagination"></ul>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="mdl_action">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="list-group">
                    <a href="#" class="list-group-item active" data-dismiss="modal"><i class="icon-home"></i> กรุณาเลือกกิจกรรม
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal" data-name="btn_edit_register"><i class="icon-edit"></i> แก้ไขข้อมูลรับซ่อม
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal" data-name="btn_assign_technician"><i class="icon-user"></i> กำหนดช่างผู้รับผิดชอบ
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal" data-name="btn_change_status"><i class="icon-refresh"></i> เปลี่ยนสถานะซ่อม
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal" data-name="btn_charge_items"><i class="icon-cogs"></i> รายการอะไหล่/ค่าใช้จ่าย
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal" data-name="btn_activities"><i class="icon-edit"></i> บันทึกกิจกรรม/ประวัติ
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal" data-name="btn_result"><i class="icon-shopping-cart"></i> จำหน่ายรายการ/สรุปผลการซ่อม
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal" data-name="btn_print"><i class="icon-print"></i> พิมพ์ใบรับซ่อม
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <a href="#" class="list-group-item" data-dismiss="modal"><i class="icon-trash"></i> ลบรายการ
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- register -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="mdl_register">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-file-alt"></i> ลงทะเบียนรับซ่อม</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txt_reg_isupdate" value="0" />
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_service1" data-toggle="tab">
                                <i class="icon-book"></i> ค้นหาข้อมูลสินค้า
                            </a>
                        </li>
                        <li>
                            <a href="#tab_service2" data-toggle="tab">
                                <i class="icon-comments-alt"></i> ข้อมูลการแจ้งซ่อม
                            </a>
                        <li>
                            <a href="#tab_service3" data-toggle="tab">
                                <i class="icon-shopping-cart"></i> อุปกรณ์เพิ่มเติม
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_service1">
                            <legend>ระบุรายละเอียดการค้นหา</legend>
                            <div class="row">
                                <div class="col-span-11">
                                    <div class="control-group info">
                                        <label class="control-label" for="txt_reg_query">ค้นหา</label>
                                        <div class="controls">
                                            <input class="col-span-11 focus" id="txt_reg_query" placeholder="พิมพ์ รหัส/serial/ประเภทสินค้า เพื่อค้นหา" type="text">
                                            <input id="txt_reg_product_code" type="hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-span-6">
                                    <div class="control-group">
                                        <label class="control-label" for="txt_reg_serial">Serial No.</label>
                                        <div class="controls">
                                            <input type="text" id="txt_reg_serial" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="control-group">
                                        <label class="control-label" for="txt_reg_product_type">ประเภท</label>
                                        <div class="controls">
                                            <input type="text" id="txt_reg_product_type" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-span-6">
                                    <div class="control-group">
                                        <label class="control-label" for="txt_reg_product_brand">ยี่ห้อ</label>
                                        <div class="controls">
                                            <input type="text" id="txt_reg_product_brand" class="input-xlarge uneditable-input" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="control-group">
                                        <label class="control-label" for="txt_reg_product_model">รุ่น</label>
                                        <div class="controls">
                                            <input type="text" id="txt_reg_product_model" class="input-xlarge uneditable-input" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-span-6">
                                    <div class="control-group">
                                        <label class="control-label" for="txt_reg_department">หน่วยงาน</label>
                                        <div class="controls">
                                            <input type="text" id="txt_reg_department" class="input-xlarge uneditable-input" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="control-group">
                                        <label class="control-label" for="txt_reg_supplier">ซื้อจาก</label>
                                        <div class="controls">
                                            <input type="text" id="txt_reg_supplier" class="input-xlarge uneditable-input" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_service2">
                            <form action="#">
                                <legend>ข้อมูลการแจ้งซ่อมและรายละเอียดเพิ่มเติม</legend>

                                <div class="row">
                                    <div class="col-span-2">
                                        <div class="control-group">
                                            <label class="control-label" for="txt_reg_date">วันที่แจ้ง</label>
                                            <div class="controls">
                                                <input class='col-span-12' rel="tooltip" title="ระบุวันที่เป็น พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556"
                                                       value="<?=get_current_thai_date()?>" id='txt_reg_date' data-type="date" type='text'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-span-12">
                                        <div class="control-group">
                                            <label class="control-label" for="txt_reg_cause">อาการแจ้ง</label>
                                            <div class="controls">
                                                <textarea class="" rows="2" id="txt_reg_cause"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-span-6">
                                        <div class="control-group">
                                            <label class="control-label" for="txt_reg_contact">ผู้แจ้ง</label>
                                            <div class="controls">
                                                <input type="text" class="col-span-12" id="txt_reg_contact">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6">
                                        <div class="control-group">
                                            <label class="control-label" for="txt_reg_contact_telephone">โทรศัพท์ผู้ติดต่อ</label>
                                            <div class="controls">
                                                <input type="text" class="col-span-12" id="txt_reg_contact_telephone">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-span-6">
                                        <div class="control-group">
                                            <label class="control-label" for="sl_reg_customers">ลูกค้า/หน่วยงาน</label>
                                            <div class="controls">
                                                <select id="sl_reg_customers" class="col-span-12">
                                                    <option value="">---</option>
                                                    <?php
                                                    $customers = get_customer_list();
                                                    foreach($customers as $r)
                                                    {
                                                        echo '<option value="'.$r->code.'">'. $r->name . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6">
                                        <div class="control-group">
                                            <label class="control-label" for="sl_reg_priority">ความสำคัญ</label>
                                            <div class="controls">
                                                <select id="sl_reg_priority" class="col-span-12">
                                                    <?php
                                                    $pri = get_priority_list();
                                                    foreach($pri as $r)
                                                    {
                                                        echo '<option value="'.$r->id.'">'.$r->name.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab_service3">
                            <legend>เพิ่มรายการอุปกรณ์ที่ติดมากับสินค้า</legend>
                            <table class="table table-striped" id="tbl_reg_item_list">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>รายการ</th>
                                    <th>จำนวน</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">ไม่พบรายการ</td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>รายการ</th>
                                    <th>จำนวน</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="info">
                                    <td></td>
                                    <td>
                                        <select id="sl_reg_items" class="col-span-12">
                                            <option value="">---</option>
                                            <?php
                                            $items = get_other_device_list();
                                            foreach($items as $r)
                                            {
                                                echo '<option value="'.$r->code.'">'. $r->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="col-span-2" id="txt_reg_item_qty" data-type="number" />
                                    </td>
                                    <td>
                                        <a href="#" class="btn" id="btn_reg_add_item">
                                            <i class="icon-ok"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <form action="#" class="form-inline">
                        ผู้ใช้งาน <select id="sl_reg_user" class="col-span-4">
                            <option value="">---</option>
                            <?php
                            $users = get_admin_list();
                            foreach($users as $u){
                                echo '<option value="'.$u->user_code.'">'.$u->fullname.'</option>';
                            }
                            ?>
                        </select>
                        รหัสผ่าน <input type="password" id="txt_reg_password" class="col-span-2">
                        <a href="#" class="btn btn-primary" id="btn_reg_save"><i class="icon-save"></i> บันทึก</a>
                        <a href="#" class="btn" data-dismiss="modal"><i class="icon-home"></i> ปิด</a>
                    </form>
            </div>
        </div>
    </div>
</div>
<!-- assign technician -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="mdl_assign_technician">
    <div class="modal-dialog" style="width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-group"></i> กำหนดช่างผู้รับผิดชอบ</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="txt_at_service_code">เลขที่ใบรับซ่อม</label>
                        <div class="controls">
                            <input type="text" id="txt_at_service_code" class="uneditable-input" disabled="disabled">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="sl_at_user">ช่างผู้รับผิดชอบ</label>
                        <div class="controls">
                            <select id="sl_at_user">
                                <option value="">---</option>
                                <?php
                                $users = get_technician_list();
                                foreach($users as $u){
                                    echo '<option value="'.$u->user_code.'">'.$u->fullname.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
                <legend>
                    Administrator
                </legend>
                <form action="#" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="sl_at_admin">Admin</label>
                        <div class="controls">
                            <select id="sl_at_admin" class="col-span-12">
                                <option value="">---</option>
                                <?php
                                $users = get_admin_list();
                                foreach($users as $u){
                                    echo '<option value="'.$u->user_code.'">'.$u->fullname.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_at_password">รหัสผ่าน</label>
                        <div class="controls">
                            <input type="password" id="txt_at_password" class="col-span-12">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="btn_at_save"><i class="icon-save"></i> บันทึกข้อมูล</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
<!-- end assign technician -->
<!-- change status -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="mdl_change_status">
    <div class="modal-dialog" style="width: 680px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modla-title"><i class="icon-share-alt"></i> เปลี่ยนสถานะซ่อม</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="txt_cs_service_code">เลขที่ใบรับซ่อม</label>
                        <div class="controls">
                            <input type="text" id="txt_cs_service_code" class="uneditable-input" disabled="disabled">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="sl_cs_status">สถานะซ่อม</label>
                        <div class="controls">
                            <select id="sl_cs_status">
                                <option value="">---</option>
                                <?php
                                $status = get_status_list();
                                foreach($status as $k=>$v){
                                    echo '<option value="'.$k.'">'.$v.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <legend>ยืนยันการเปลี่ยนสถานะ</legend>
                    <div class="control-group">
                        <label class="control-label" for="sl_cs_user">ช่างผู้รับผิดชอบ</label>
                        <div class="controls">
                            <select id="sl_cs_user">
                                <option value="">---</option>
                                <?php
                                $users = get_technician_list();
                                foreach($users as $u){
                                    echo '<option value="'.$u->user_code.'">'.$u->fullname.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_cs_password">รหัสผ่าน</label>
                        <div class="controls">
                            <input type="password" id="txt_cs_password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="btn_cs_save"><i class="icon-save"></i> บันทึกข้อมูล</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-home"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
<!-- end change status -->
<!-- add charege items -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="mdl_charge_items">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paste"></i> รายการอุปกรณ์</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                    พิมพ์ชื่อรายการอะไหล่ที่ต้อ้งการเพิ่มในช่องรายการ จากนั้นเลือกรายการที่ต้องการ แล้วระบุจำนวน และราคา จากนั้นคลิกปุ่ม บันทึกข้อมูล
                </blockquote>
                <table class="table table-striped" id="tbl_ci_item_list">
                    <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>รายการ</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>รวม</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="5">...</td>
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success pull-right" id="btn_ci_new_item">
                    <i class="icon-plus-sign"></i>
                </button>

                <input type="hidden" id="txt_ci_item_code" class="input-xlarge" />

                <table class="table" id="tbl_ci_new" style="display: none;">
                    <thead>
                    <tr>
                        <th>รายการ</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>รวม</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="info">
                        <td><input type="text" id="txt_ci_item_query" class="input-xlarge" placeholder="พิมพ์ชื่อ เพื่อค้นหา ..." /></td>
                        <td><input type="text" id="txt_ci_item_price" class="input-mini" data-type="number" /></td>
                        <td><input type="text" id="txt_ci_item_qty" class="input-mini" data-type="number" /></td>
                        <td><input type="text" id="txt_ci_item_total" class="input-mini uneditable-input" data-type="number" disabled="disabled" /></td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary" id="btn_ci_save_item" title="เพิ่มรายการ"><i class="icon-save"></i></a>
                                <a href="#" class="btn btn" id="btn_ci_save_item_cancel" title="ยกเลิก"><i class="icon-refresh"></i></a>
                            </div>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <form action="#" class="form-inline">
                    ผู้ใช้งาน <select id="sl_ci_user" class="col-span-4">
                        <option value="">---</option>
                        <?php
                        $users = get_technician_list();
                        foreach($users as $u){
                            echo '<option value="'.$u->user_code.'">'.$u->fullname.'</option>';
                        }
                        ?>
                    </select>
                    รหัสผ่าน <input type="password" id="txt_ci_password" class="col-span-3">
                    <a href="#" class="btn btn-primary" id="btn_ci_save"><i class="icon-save"></i> บันทึกข้อมูล</a>
                    <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off"></i> ปิดหน้าต่าง</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end change status -->
<!-- save activities-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="mdl_activities">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-calendar"></i> บันทึกกิจกรรมการให้บริการ</h4>
            </div>
            <div class="modal-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_act_main" data-toggle="tab"><i class="icon-edit"></i> บันทึกรายละเอียด</a></li>
                        <li><a href="#tab_act_history" data-toggle="tab"><i class="icon-time"></i> ประวัติการบันทึก</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_act_main">
                            <br />
                            <div class="panel panel-info">
                                <div class="panel-heading"><i class="icon-edit"></i> กิจกรรม</div>
                                <form class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label" for="txt_act_result">กิจกรรมที่ให้บริการ</label>
                                        <div class="controls">
                                            <textarea class="" rows="3" id="txt_act_result"></textarea>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div class="panel panel-success">
                                <div class="panel-heading"><i class="icon-group"></i> ข้อมูลผู้ใช้งาน</div>
                                <label for="sl_act_user">ช่างผู้รับผิดชอบ</label>
                                <select id="sl_act_user" class="col-span-4">
                                    <option value="">---</option>
                                    <?php
                                    $users = get_technician_list();
                                    foreach($users as $u){
                                        echo '<option value="'.$u->user_code.'">'.$u->fullname.'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="txt_act_password">รหัสผ่าน</label>
                                <input type="password" id="txt_act_password" class="col-span-3">
                                <a href="#" class="btn btn-primary" id="btn_act_save"><i class="icon-save"></i> บันทึกข้อมูล</a>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab_act_history">
                            <br>
                            <blockquote>
                                <i class="icon-comments-alt"></i> ข้อมูลประวัติการบันทึกกิจกรรมของช่างและเจ้าหน้าที่
                            </blockquote>
                            <table class="table table-striped" id="tbl_act_list">
                                <thead>
                                <tr>
                                    <th>วันที่</th>
                                    <th>เวลา</th>
                                    <th>ช่างผู้ปฏิบัติงาน</th>
                                    <th>รายละเอียด</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="4">...</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="mdl_result">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-calendar"></i> บันทึกสรุปผลการให้บริการ</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-info">
                    <div class="panel-heading"><i class="icon-edit"></i> สรุปผลการให้บริการ</div>
                    <form class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="txt_rs_result">สรุปผลการให้บริการ</label>
                            <div class="controls">
                                <textarea class="input-xxlarge" rows="3" id="txt_rs_result"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="txt_rs_result">วันที่จำหน่าย</label>
                            <div class="controls">
                                <input class='col-span-2' data-type="date" rel="tooltip" title="ระบุวันที่เป็น พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556"
                                       value="<?=get_current_thai_date()?>" id='txt_rs_discharge_date' type='text'>
                                <span class="help-inline">พ.ศ เช่น 28/02/2556</span>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading"><i class="icon-group"></i> ข้อมูลผู้ใช้งาน</div>

                    <form class="form-horizontal">
                        <label for="sl_rs_user">ช่างผู้รับผิดชอบ</label>
                        <select id="sl_rs_user" class="col-span-4">
                            <option value="">---</option>
                            <?php
                            $users = get_technician_list();
                            foreach($users as $u){
                                echo '<option value="'.$u->user_code.'">'.$u->fullname.'</option>';
                            }
                            ?>
                        </select>
                        <label for="txt_rs_password">รหัสผ่าน</label>
                        <input type="password" id="txt_rs_password" class="col-span-4">

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="btn_rs_save"><i class="icon-save"></i> บันทึกข้อมูล</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/services.js"></script>
