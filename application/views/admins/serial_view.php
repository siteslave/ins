<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a></li>
    <li class="active">กำหนดข้อมูลรหัส</li>
</ul>

<legend><i class="icon-cogs"></i> กำหนดข้อมูลรหัส (Serials)</legend>
<table class="table table-striped" style="width: 780px;">
    <thead>
        <tr>
            <th>รายการ</th>
            <th>รูปแบบ</th>
            <th>ใส่วันที่</th>
            <th>เริ่มต้น</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($serials as $s): ?>
        <tr>
            <td><?php echo $s->th_name; ?></td>
            <td><input data-name="prefix" type="text" class="col-span-4" maxlength="3" value="<?php echo $s->prefix; ?>"></td>
            <td><input data-name="adddate" type="checkbox" <?php echo $s->chk_date == '1' ? 'checked="checked"' : ''; ?> ></td>
            <td><input data-name="serial" type="text" class="col-span-4" data-type="number" value="<?php echo $s->sr_no; ?>"></td>
            <td><a data-id="<?php echo $s->id; ?>" data-name="btn_set_data" href="javascript:void(0);" class="btn"
                   title="ปรับปรุงรายการ"><i class="icon-save"></i></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/serials.js"></script>
