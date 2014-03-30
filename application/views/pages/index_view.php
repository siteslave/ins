<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active">Dashboard</li>
</ul>

<div class="row">
    <div class="col-span-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="icon-group"></i> สถิติการใช้บริการของหน่วยงาน/ร้านค้า</div>
            <form action="#" class="form-inline">
                <label for="txt_send_date">ตั้งแต่</label>
                <input type="text" rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" class="col-span-3" id="txt_rpt_customer_sdate" data-type="date">
                <label for="txt_send_date">ถึงวันที่</label>
                <input class='col-span-3' rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" id='txt_rpt_customer_edate' type='text' data-type="date">
                <a href="javascript:void(0);" class="btn btn-primary" id="btn_rpt_customer_get"><i class="icon-search"></i> แสดงข้อมูล</a>
            </form>
            <table class="table table-striped table-hover" id="tbl_customer_service_count">
                <thead>
                <tr>
                    <th>รหัส</th>
                    <th>หน่วยงาน/ลูกค้า</th>
                    <th>รวม</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="col-span-6" id="graph_customer"></div>
</div>

<div class="row">
    <div class="col-span-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="icon-shopping-cart"></i> รายการสินค้าที่มีการซ่อมบ่อยที่สุด</div>
            <form action="#" class="form-inline">
                <label for="txt_rpt_product_sdate">ตั้งแต่</label>
                <input type="text" rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" class="col-span-3" id="txt_rpt_product_sdate" data-type="date">
                <label for="txt_rpt_product_edate">ถึงวันที่</label>
                <input class='col-span-3' rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" id='txt_rpt_product_edate' type='text' data-type="date">
                <a href="javascript:void(0);" class="btn btn-primary" id="btn_rpt_product_get"><i class="icon-search"></i> แสดงข้อมูล</a>
            </form>
            <table class="table table-striped table-hover" id="tbl_product_service_count">
                <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ประเภท</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>รวม</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="col-span-6" id="graph_product"></div>
</div>

<legend>สถิติและรายงานเกี่ยวกับการให้บริการ</legend>
<div class="row">
    <div class="col-span-6" id="graph_tech">

    </div>
    <div class="col-span-6" id="graph_status">

    </div>
</div>
<div class="row">
  <div class="col-span-6">

      <div class="panel panel-primary">
          <div class="panel-heading"><i class="icon-group"></i> สถิติการให้บริการของช่าง</div>
          <form action="#" class="form-inline">
              <label for="txt_send_date">ตั้งแต่</label>
              <input type="text" rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" class="col-span-3" id="txt_rpt_tech_sdate" data-type="date">
              <label for="txt_send_date">ถึงวันที่</label>
              <input class='col-span-3' rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" id='txt_rpt_tech_edate' type='text' data-type="date">
              <a href="javascript:void(0);" class="btn btn-primary" id="btn_rpt_tech_get"><i class="icon-search"></i> แสดงข้อมูล</a>
          </form>
          <table class="table table-striped table-hover" id="tbl_tech_service_count">
              <thead>
              <tr>
                  <th>รหัส</th>
                  <th>ชื่อ - สกุล</th>
                  <th>รวม</th>
              </tr>
              </thead>
              <tbody></tbody>
          </table>
      </div>
  </div>
  
  <div class="col-span-6">
      <div class="panel panel-primary">
          <div class="panel-heading"><i class="icon-bar-chart"></i> สถานะรับซ่อม</div>
          <form action="#" class="form-actions form-inline">
              <label for="txt_rpt_status_sdate">ตั้งแต่</label>
              <input class="col-span-3" rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" id='txt_rpt_status_sdate' type='text' data-type="date">
              <label for="txt_rpt_status_edate">ถึงวันที่</label>
              <input class="col-span-3" rel="tooltip" title="วันที่ พ.ศ. (dd/mm/yyyy) เช่น 28/02/2556" id='txt_rpt_status_edate' type='text' data-type="date">
              <a href="javascript:void(0);" class="btn btn-primary" id="btn_rpt_status_get"><i class="icon-search icon-white"></i> แสดงข้อมูล</a>
          </form>
          <table class="table table-striped table-hover" id="tbl_status_count">
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/reports.js"></script>