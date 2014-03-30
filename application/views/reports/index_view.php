<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active">ระบบรายงาน</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-th-list"></i> ระบบรายงานหลัก</a></li>
        <li><a href="#tab2" data-toggle="tab"><i class="icon-bar-chart"></i> สถิติการให้บริการ</a></li>
        <li><a href="#tab3" data-toggle="tab"><i class="icon-group"></i> สถิติแยกตามช่าง</a></li>
        <li><a href="#tab4" data-toggle="tab"><i class="icon-sitemap"></i> สถิติแยกตามหน่วยงาน</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <br>
            <form action="#" class="well well-small">
                <label for="txt_mrpt_date_s"> ตั้งแต่ </label>
                <input class="col-span-1" id="txt_mrpt_date_s" value="<?=get_current_thai_date()?>"
                       type="text" data-type="date" rel="tooltip" title="วันที่ พ.ศ. เช่น 28/02/25">
                <label for="txt_mrpt_date_e"> ถึง </label>
                <input class="col-span-1" id="txt_mrpt_date_e" value="<?=get_current_thai_date()?>"
                       type="text" data-type="date" rel="tooltip" title="วันที่ พ.ศ. เช่น 28/02/2556">
                <a href="javascript:void(0);" class="btn" id="btn_mrpt_do_get">
                    <i class="icon-search"></i> แสดง</a>
            </form>

            <div class="row">
                <div class="col-span-6" id="div_rpt_total" style="height: 460px;"></div>
                <div class="col-span-6" id="div_rpt_total_status" style="height: 460px;"></div>
            </div>
            <div class="row">
                <div class="col-span-6">
                    <legend><i class="icon-group"></i> สถิติการให้บริการแยกตามช่าง</legend>
                    <table class="table" id="tbl_mrpt_total">
                        <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อ - สกุล</th>
                            <th>จำหน่าย</th>
                            <th>ยังไม่จำหน่าย</th>
                            <th>รวม</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="col-span-6">
                    <legend><i class="icon-th-list"></i> สถิติการให้บริการแยกตามสถานะ</legend>
                    <table class="table" id="tbl_mrpt_total_status">
                        <thead>
                        <tr>
                            <th>สถานะ</th>
                            <th>รวม</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <br>
            <form action="#" class="well well-small">
                <label for="txt_service_list_s"> ตั้งแต่ </label>
                <input class="col-span-1" id="txt_service_list_s" value="<?=get_current_thai_date()?>"
                       rel="tooltip" title="วันที่ พ.ศ. เช่น 28/02/2556" data-type="date" type="text">
                <label for="txt_service_list_e"> ถึง </label>
                <input class="col-span-1" id="txt_service_list_e" value="<?=get_current_thai_date()?>"
                       rel="tooltip" title="วันที่ พ.ศ. เช่น 28/02/2556" data-type="date" type="text">
                <a href="javascript:void(0);" class="btn" id="btn_get_service">
                    <i class="icon-search"></i> แสดง</a>
                <a href="javascript:void(0);" class="btn btn-success" id="btn_print_service_list">
                    <i class="icon-download-alt"></i> พิมพ์รายงาน (PDF)</a>
            </form>

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
                    <th>จำหน่าย</th>
                    <th>สถานะ</th>
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
                    <td>...</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>

            <ul id="main_paging" class="pagination"></ul>

        </div>
        <div class="tab-pane" id="tab3">
            <br>
            <form action="#" class="well well-small">
                <select id="sl_technician_list" class="col-span-3">
                    <option value="">- ระบุช่าง -</option>
                    <?php
                    $tech = get_technician_list();

                    foreach($tech as $r)
                    {
                        echo '<option value="'.$r->user_code.'">' . $r->fullname;
                    }
                    ?>
                </select>
                <label for="txt_service_list_by_tech_s">ตั้งแต่</label>
                <input class="col-span-1" id="txt_service_list_by_tech_s" data-type="date"
                       value="<?=get_current_thai_date()?>" type="text" rel="tooltip" title="ระบุวันที่ เช่น 28/02/2556">
                <label for="txt_service_list_by_tech_e">ถึง</label>
                <input class="col-span-1" id="txt_service_list_by_tech_e" data-type="date"
                       value="<?=get_current_thai_date()?>" type="text" rel="tooltip" title="ระบุวันที่ เช่น 28/02/2556">

                <a href="javascript:void(0);" class="btn" id="btn_get_service_by_technician">
                    <i class="icon-search"></i> แสดง</a>
                <a href="javascript:void(0);" class="btn btn-success" id="btn_print_service_by_technician">
                    <i class="icon-download-alt"></i> พิมพ์รายงาน (PDF)</a>
            </form>

            <table class="table table-striped table-hover" id="tbl_service_list_by_technician">
                <thead>
                <tr>
                    <th>เลขที่ใบรับซ่อม</th>
                    <th>วันที่แจ้ง</th>
                    <th>รหัสสินค้า</th>
                    <th>ประเภท</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>หน่วยงาน/ร้านค้า</th>
                    <th>จำหน่าย</th>
                    <th>สถานะ</th>
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
                    <td>...</td>
                </tr>
                </tbody>
            </table>

            <ul id="main_paging2" class="pagination"></ul>

        </div>
        <div class="tab-pane" id="tab4">
            <br>
            <form action="#" class="well well-small">
                <label for="txt_service_list_s">ลูกค้า</label>
                <select id="sl_customers_list" class="col-span-3">
                    <option value="">---</option>
                    <?php
                    $customers = get_customer_list();
                    foreach($customers as $r)
                    {
                        echo '<option value="'.$r->code.'">'. $r->name . '</option>';
                    }
                    ?>
                </select>
                <label for="txt_service_list_by_customer_s">ตั้งแต่</label>
                <input class="col-span-1" id="txt_service_list_by_customer_s" data-type="date"
                       value="<?=get_current_thai_date()?>" type="text" title="ระบุวันที่ พ.ศ. เช่น 28/02/2556" rel="tooltip">
                <label for="txt_service_list_by_customer_e">ถึง</label>
                <input class="col-span-1" id="txt_service_list_by_customer_e" value="<?=get_current_thai_date()?>"
                       data-type="date" type="text" title="ระบุวันที่ พ.ศ. เช่น 28/02/2556" rel="tooltip">

                <a href="javascript:void(0);" class="btn" id="btn_get_service_by_customer">
                    <i class="icon-search"></i> แสดง</a>
                <a href="javascript:void(0);" class="btn btn-success" id="btn_print_service_by_customer">
                    <i class="icon-download-alt"></i> พิมพ์รายงาน (PDF)</a>
            </form>

            <table class="table table-striped table-hover" id="tbl_service_list_by_customer">
                <thead>
                <tr>
                    <th>เลขที่ใบรับซ่อม</th>
                    <th>วันที่แจ้ง</th>
                    <th>รหัสสินค้า</th>
                    <th>ประเภท</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>หน่วยงาน/ร้านค้า</th>
                    <th>จำหน่าย</th>
                    <th>สถานะ</th>
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
                    <td>...</td>
                </tr>
                </tbody>
            </table>

            <ul id="main_paging3" class="pagination"></ul>

        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/reports.index.js"></script>
