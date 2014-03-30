<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active">รายการสินค้า</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_main" data-toggle="tab"><i class="icon-th-list"></i> รายการสินค้า</a></li>
        <li><a href="#tab2" id="tab_new_edit_product" data-toggle="tab"><i class="icon-plus-sign"></i> เพิ่ม/แก้ไข สินค้า</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <br />
            <blockquote>
                <p>จัดการข้อมูลสินค้าทั้งหมดที่มีในฐานข้อมูล</p>
            </blockquote>
            <form action="#" class="well well-small">
                <div class="row">
                    <div class="col-span-2">
                        <input type="hidden" id="txt_customer_search_by" value="0">
                        <div class="input-group col-span-12">
                            <input id="txt_query_product" class="col-span-12" type="text" placeholder="รหัสสินค้า...">
                            <span class="input-group-btn">
                                <button class="btn" type="button" id="btn_search_product">
                                    <i class="icon-search icon-white"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <select name="sl_filter_by_type" id="sl_filter_type" class="col-span-12">
                            <option value="">-- ทั้งหมด --</option>
                            <?php
                            foreach($types as $t)
                                echo '<option value="'.$t->code.'">' . $t->name . '</option>';
                            ?>
                        </select>
                    </div>
                    <div class="col-span-3">
                        <input type="hidden" id="txt_filter_customer_code">
                        <div class="input-group col-span-12">
                            <input id="txt_filter_customer_name" class="col-span-12" type="text" placeholder="หน่วยงาน/ลูกค้า...">
                            <span class="input-group-btn">
                                <button class="btn" type="button" id="btn_search_filter_customer">
                                    <i class="icon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="btn-group">
                            <button class="btn" type="button" id="btn_do_filter"><i class="icon-search"></i> แสดง/พิมพ์</button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);" data-name="btn_print_filter"><i class="icon-print"></i> ตามเงื่อนไข</a></li>
                                <li><a href="javascript:void(0);" data-name="btn_print_all"><i class="icon-print"></i> ทั้งหมด</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <button type="button" class="btn btn-primary" id="btn_get_all">
                            <i class="icon-th-list icon-white"></i> ทั้งหมด
                        </button>
                    </div>
                </div>


            </form>
            <table class="table table-striped" id="table_product_list">
                <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ประเภท</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>หน่วยงาน/ลูกค้า</th>
                    <th>วันที่ซื้อ</th>
                    <th>การใช้งาน (ปี)</th>
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
            <ul id="main_paging" class="pagination pagination-centered">

            </ul>

        </div>
        <div class="tab-pane" id="tab2">
            <br />
            <blockquote>
                <p>จัดการข้อมูลสินค้าทั้งหมดที่มีในฐานข้อมูล</p>
            </blockquote>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>หมายเหตุ!</strong> กรุณากรอกข้อมูลของสินค้าให้ถูกต้อง และสมบูรณ์ที่สุด
            </div>
            <form class="form-horizontal">
                <input type="hidden" id="txt_isupdate" value="0">
                <div class="control-group">
                    <label class="control-label" for="txt_product_code">รหัสสินค้า</label>
                    <div class="controls">
                        <input type="text" id="txt_product_code" class="col-span-4" placeholder="ปล่อยว่างเพื่อสร้างอัตโนมัติ">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_owners">หน่วยงาน/ลูกค้า</label>
                    <div class="controls">
                        <input type="hidden" id="txt_customer_code">
                        <div class="input-group col-span-6">
                            <input class="input-xlarge" disabled="disabled"
                                   id="txt_customer_name" type="text" placeholder="คลิกปุ่มค้นหา...">
                          <span class="input-group-btn">
                            <button class="btn" type="button" id="btn_search_customer">
                                <i class="icon-search"></i>
                            </button>
                          </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_type">ประเภท</label>
                    <div class="controls">
                        <select id="sl_type" class="col-span-4">
                            <option value="">-</option>
                            <?php
                            foreach($types as $t)
                                echo '<option value="'.$t->code.'">' . $t->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_brand">ยี่ห้อ</label>
                    <div class="controls">
                        <select id="sl_brand" class="col-span-4">
                            <option value="">-</option>
                            <?php
                            foreach($brands as $b)
                                echo '<option value="'.$b->code.'">' . $b->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_model">รุ่น</label>
                    <div class="controls">
                        <select id="sl_model" class="col-span-4"></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_color">สี</label>
                    <div class="controls">
                        <select id="sl_color" class="col-span-4">
                            <option value="">-</option>
                            <?php
                            foreach($colors as $c)
                                echo '<option value="'.$c->code.'">' . $c->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_serial">Serial no.</label>
                    <div class="controls">
                        <input type="text" class="col-span-4" id="txt_product_serial" placeholder="Serial no.">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_name">ปีที่จัดซื้อ</label>
                    <div class="controls">
                        <input rel="tooltip" title="ระบุวันที่เป็น พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" class='col-span-2' data-type="date" id='txt_purchase_date' type='text'>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_purchase_price">ราคาซื้อ</label>
                    <div class="controls">
                        <input type="text" class="col-span-2" id="txt_purchase_price" data-type="number">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="sl_supplier">ซื้อจาก</label>
                    <div class="controls">
                        <input type="hidden" id="txt_supplier_code">
                            <div class="input-group col-span-6">
                                <input class="input-xlarge" disabled="disabled" id="txt_supplier_name" type="text" placeholder="คลิกปุ่มค้นหา...">
                                  <span class="input-group-btn">
                                    <button class="btn" type="button" id="btn_search_supplier">
                                        <i class="icon-search"></i>
                                    </button>
                                  </span>
                            </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_spec">รายละเอียด เช่น RAM, CPU, HDD ฯลฯ</label>
                    <div class="controls">
                        <textarea rows="3" class="input-xxlarge" id="txt_spec"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_spec">&nbsp;</label>
                    <div class="controls">
                        <button class="btn btn-primary" type="button" id="btn_do_register">
                            <i class="icon-save"></i> บันทึกข้อมูล
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" id="mdl_service_history">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ประวัติการแจ้งซ่อม</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover" id="tbl_service_history">
                    <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>เลขที่แจ้งซ่อม</th>
                        <th>อาการแจ้งซ่อม</th>
                        <th>ช่างผู้รับผิดชอบ</th>
                        <th>สถานะปัจจุบัน</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" id="mdl_search_customer">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ค้นหาหน่วยงาน/ลูกค้า</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                    ค้นหาข้อมูลหน่วยงาน/ลูกค้า
                </blockquote>
                <form class="form-inline form-actions">
                    <div class="input-group">
                        <input type="text" id="txt_query_customer" class="col-span-4" placeholder="ชื่อ หรือ รหัส...">
                        <span class="input-group-btn">
                            <button class="btn" type="button" id="btn_do_search_customer">
                                <i class="icon-search"></i>
                                ค้นหา
                            </button>
                        </span>
                    </div>
                </form>
                <table class="table table-striped table-hover" id="tbl_customer_result_list">
                    <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อหน่วยงาน/ลูกค้า</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" id="mdl_search_supplier">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ค้นหาร้านค้า</h4>
            </div>
            <div class="modal-body">
                <div class="navbar">
                    <form class="navbar-form">
                        <div class="input-group col-span-8">
                            <input id="txt_query_supplier" type="text" placeholder="ชื่อ หรือ รหัส...">
              <span class="input-group-btn">
                <button class="btn" type="button" id="btn_do_search_supplier">
                    <i class="icon-search"></i>
                </button>
              </span>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover" id="tbl_supplier_result_list">
                    <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อร้านค้า</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/products.js"></script>
