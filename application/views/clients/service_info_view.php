<ul class="breadcrumb">
    <li><a href="<?php echo site_url('clients'); ?>">หน้าหลัก</a></li>
    <li class="active"></li>  ข้อมูลการให้บริการ
</ul>

<input type="hidden" id="service_code" value="<?php echo $service_code; ?>">
<blockquote>
    <p>บันทึกข้อมูลกิจกรรมการให้บริการ และ ค่าใช้จ่ายในการซ่อมบำรุง</p>
</blockquote>
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-info-sign"></i> ข้อมูลการรับซ่อม</a></li>
        <li><a href="#tab2" data-toggle="tab"><i class="icon-th-list"></i> ข้อมูลการให้บริการ</a></li>
        <li><a href="#tab3" data-toggle="tab"><i class="icon-shopping-cart"></i> ข้อมูลค่าใช้จ่าย</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <form class="form-horizontal" action="#">
                <legend>ข้อมูลการแจ้งซ่อม</legend>
                <div class="control-group">
                    <label class="control-label" for="txt_service_code">วันที่ลงทะเบียน</label>
                    <div class="controls">
                        <input type="text" id="txt_service_code" disabled="disabled"
                               class="uneditable-input" value="<?php echo $date_serv;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_service_code">เลขที่ใบรับซ่อม</label>
                    <div class="controls">
                        <input type="text" id="txt_service_code" disabled="disabled"
                               class="uneditable-input" value="<?php echo $service_code;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_code">รหัสสินค้า</label>
                    <div class="controls">
                        <input type="text" id="txt_product_code" class="uneditable-input"
                               disabled="disabled" value="<?php echo $product_code;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_name">ชนิด</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input"
                               disabled="disabled" id="txt_product_name" value="<?php echo $type_name;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_name">ยี่ห้อ</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input"
                               disabled="disabled" id="txt_product_name" value="<?php echo $brand_name;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_name">รุ่น</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input"
                               disabled="disabled" id="txt_product_name" value="<?php echo $model_name;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_owner_name">หน่วยงาน/ลูกค้า</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input"
                               disabled="disabled" id="txt_owner_name" value="<?php echo $customer_name;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_owner_name">ชื่อผู้แจ้ง</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input"
                               disabled="disabled" id="txt_owner_name" value="<?php echo $contact_name;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_service_cause">อาการแจ้งซ่อม</label>
                    <div class="controls">
                        <textarea id="txt_service_cause" rows="3" class="input-xxlarge uneditable-textarea" disabled="disabled">
                            <?php echo $cause;?>
                        </textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="tab2">
            <legend>ข้อมูลการให้บริการ</legend>
            <div class="control-group">
                <label class="control-label" for="txt_service_code">วันที่จำหน่าย</label>
                <div class="controls">
                    <input type="text" id="txt_service_code" disabled="disabled"
                           class="uneditable-input" value="<?php echo $discharge_date;?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_service_cause">สรุปการให้บริการ</label>
                <div class="controls">
                    <textarea rows="3" class="input-xxlarge uneditable-textarea" disabled="disabled">
                        <?php echo $service_result;?>
                    </textarea>
                </div>
            </div>
            <table class="table table-striped table-hover" id="tbl_act_list">
                <thead>
                <tr>
                    <th>วันที่</th>
                    <th>เวลา</th>
                    <th>เจ้าหน้าที่</th>
                    <th>กิจกรรมที่ทำ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($activities as $r)
                {
                    echo '
                    <tr>
                        <td>'.to_thai_date($r->act_date).'</td>
                        <td>'.$r->act_time.'</td>
                        <td>'.$r->fullname.'</td>
                        <td>'.$r->result.'</td>
                    </tr>
                    ';
                }
                ?>

                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="tab3">
            <legend>บันทึกค่าใช้จ่าย/อุปกรณ์</legend>
            <table class="table table-striped table-hover" id="tbl_item_list">
                <thead>
                <tr>
                    <th>ค่าใช้จ่าย/อุปกรณ์</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รวม (บาท)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                foreach($charge_items as $r)
                {
                    echo '
                    <tr>
                        <td>'.$r->name.'</td>
                        <td>'.$r->price.'</td>
                        <td>'.$r->qty.'</td>
                        <td>'.number_format((int) $r->qty * (float) $r->price, 2).'</td>
                    </tr>
                    ';

                    $total += (int) $r->qty * (float) $r->price;
                }
                ?>
                </tbody>
            </table>
            <blockquote class="pull-right">
                <p>รวมค่าใช้จ่าย <strong><span id="sv_total"><?=number_format($total, 2)?></span></strong> บาท</p>
            </blockquote>
        </div>
    </div>

</div>
<!---->
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--assets/apps/clients.getinfo.js"></script>-->
