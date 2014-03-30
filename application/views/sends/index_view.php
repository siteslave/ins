<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li><a href="<?php echo site_url('services'); ?>">การให้บริการ</a> </li>
    <li class="active">ส่งซ่อมสินค้า</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_main" data-toggle="tab"><i class="icon-th-list"></i> รายการส่งซ่อม</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <br>
            <blockquote>
                <p>บันทึกรายการส่งซ่อมสินค้า (กรณีส่งซ่อมที่อื่น)</p>
            </blockquote>
            <form action="#" class="well well-small">
                <input type="hidden" id="txt_status" value="-1" />
                <div class="row">
                    <div class="col-span-4">
                        <div class="input-group col-span-12">
                            <input type="text" id="txt_query" placeholder="เลขที่ส่งซ่อม หรือเลขที่รับซ่อม">
                            <span class="input-group-btn">
                                <button class="btn" type="button" id="btn_search">
                                    <i class="icon-search icon-white"></i> ค้นหา
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
                        <div class="btn-group pull-right">
                            <a href="javascript:void(0);" class="btn" data-name="btn_set_status" data-status="-1"><i class="icon-th-list"></i> ทั้งหมด</a>
                            <a href="javascript:void(0);" class="btn btn-primary" data-name="btn_set_status" data-status="1"><i class="icon-download-alt"></i> รับคืนแล้ว</a>
                            <a href="javascript:void(0);" class="btn" data-name="btn_set_status" data-status="0"><i class="icon-upload-alt"></i> ยังไม่รับคืน</a>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-striped" id="tbl_list">
                <thead>
                <tr>
                	<th>วันที่</th>
                    <th>เลขที่ส่งซ่อม</th>
                    <th>บริษัท/ร้านค้า</th>
                    <th>เลขที่รับซ่อม</th>
                    <th>รหัสสินค้า</th>
                    <th>ประเภท</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>วันที่รับคืน</th>
                    <th>สถานะ</th>
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
                <h3 class="modal-title"><i class="icon-file-alt"></i> เพิ่ม/แก้ไข รายการ</h3>
            </div>
            <div class="modal-body">
                <blockquote>
                    <i class="icon-comments-alt icon-2x pull-left icon-border"></i> <h3>คำแนะนำ</h3>
                    พิมพ์เลขที่ใบรับซ่อม และ สถานที่ส่งซ่อม เพื่อค้นหารายการ หากต้องการเปลี่ยนสถานะเป็นส่งซ่อม ให้คลิกถูกที่ช่องเปลี่ยนสถานะ
                </blockquote>
                <form action="#" class="form-horizontal">
                    <input type="hidden" id="txt_isupdate" value="1">
                    <input type="hidden" id="txt_id" value="">
                    <div class="control-group">
                        <label class="control-label" for="txt_send_date">วันที่ส่งซ่อม</label>
                        <div class="controls">
                            <input class='col-span-2' id='txt_send_date' type='text'
                                   rel="tooltip" title="วันที่เป็น พ.ศ. เช่น 28/02/2556" data-type="date">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="txt_new_service_code">เลขที่ใบรับซ่อม</label>
                        <div class="controls">
                            <input class="input-xlarge" id="txt_new_service_code"
                                   type="text" placeholder="เลขที่ใบรับซ่อม">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_new_service_company_name">สถานที่ส่งซ่อม</label>
                        <div class="controls">
                            <input type="hidden" id="txt_new_service_company_code" />
                            <input class="input-xlarge"
                                   id="txt_new_service_company_name" type="text" placeholder="สถานที่ส่งซ่อม">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="chk_new_send_change_status">เปลี่ยนสถานะ (ส่งซ่อม)</label>
                        <div class="controls">
                            <input type="checkbox" id="chk_new_send_change_status">
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
<!-- get -->
<div class="modal fade" id="mdl_get">
   <div class="modal-dialog" style="width: 960px; left: 35%">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 class="modal-title"><i class="icon-download-alt"></i> บันทึกรับกลับสินค้า</h3>
           </div>
           <div class="modal-body">
               <form action="#" class="form-horizontal">
                   <input type="hidden" id="txt_send_id">
                   <div class="control-group">
                       <label class="control-label" for="txt_get_date">วันที่รับ</label>
                       <div class="controls">
                           <input class='col-span-2' id='txt_get_date' type='text' data-type="date"
                               rel="tooltip" title="วันที่ พ.ศ. เช่น 28/02/2556">
                       </div>
                   </div>
                   <div class="control-group">
                       <label class="control-label" for="txt_get_send_code">เลขที่ใบส่งซ่อม</label>
                       <div class="controls">
                           <div class="input-append">
                               <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_get_send_code" type="text" placeholder="...">
                           </div>
                       </div>
                   </div>
                   <div class="control-group">
                       <label class="control-label" for="txt_get_service_code">เลขที่ใบรับซ่อม</label>
                       <div class="controls">
                           <div class="input-append">
                               <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_get_service_code" type="text" placeholder="...">
                           </div>
                       </div>
                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <a href="#" class="btn btn-success" id="btn_get_save"><i class="icon-save"></i> บันทึกรายการ</a>
               <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off"></i> ปิดหน้าต่าง</a>
           </div>
       </div>
   </div>
</div>

<!-- end get -->

<!-- cancel get -->
<div class="modal fade" id="mdl_regemove_get">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3><i class="icon-refresh"></i> ยกเลิกรับกลับสินค้า</h3>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal">
                    <input type="hidden" id="txt_remove_send_id">
                    <div class="control-group">
                        <label class="control-label" for="txt_get_send_code">เลขที่ใบส่งซ่อม</label>
                        <div class="controls">
                            <input class="col-span-12" disabled="disabled" id="txt_remove_send_code" type="text" placeholder="...">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="txt_get_service_code">เลขที่ใบรับซ่อม</label>
                        <div class="controls">
                            <input class="col-span-12" disabled="disabled" id="txt_remove_service_code" type="text" placeholder="...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="btn_do_remove_get"><i class="icon-save"></i> บันทึกรายการ</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off"></i> ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
<!-- end cancle get -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/sends.js"></script>