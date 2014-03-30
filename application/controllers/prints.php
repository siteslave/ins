<?php
class Prints extends CI_Controller {

    private $logo_path;

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Service_model', 'service');
		$this->load->model('Report_model', 'report');
		$this->load->model('Product_model', 'product');
		$this->load->model('Customer_model', 'customer');
		$this->load->model('Device_model', 'device');
		$this->load->model('Item_model', 'item');
		$this->load->model('Admin_model', 'admin');
		$this->load->model('Supplier_model', 'supplier');

        $this->logo_path = '/ins/assets/img/logo.gif';
	}
	
	    
    public function service($sv=''){
    	if(!isset($sv) || empty($sv)){
    		show_error('Service not found.', 404);
    	}else{
            $rs = $this->service->get_print_detail($sv);
            $company = get_company_detail();
            if($rs){
            	$this->load->library('pdf');
	            $this->pdf->setPrintHeader(false);
	            $this->pdf->setPrintFooter(false);
	            $this->pdf->setTopMargin(15);
	            
	            // set document information
	            $this->pdf->SetSubject('AA Service');
	            $this->pdf->SetKeywords('AA Service');
	            
	            // add a page
	            $this->pdf->AddPage();
	            $this->pdf->SetFont('freeserif', '', 11);
	            $html = '
	            <style>
	            u { border-bottom: 1px blue dotted; }
	            </style>
	            <div align="center">
	            <img src="'.$this->logo_path.'" border="0" width="40" height="40">
	            <br />
	            <i style="font-size: 25px">'.$company->name.' <br /> '. $company->address .' โทร. '. $company->telephone . ' แฟกซ์. ' . $company->fax . ' </i>
	            <br />
	            <br />
	            <strong><u>ใบแจ้งซ่อมเครื่องคอมพิวเตอร์และอุปกรณ์ IT <br /> IT SERVICE REQUEST FORM</strong></u>
	            </div>
	            <br />
	            <br />
	            วันที่แจ้ง (INF. DATE) <u>'.to_thai_date($rs->date_serv).'</u>
	            <font color="white">..............................</font>
	            เลขที่ใบรับซ่อม (SERVICE CODE) : <u>'.$rs->service_code.'</u>

	            <br /> ถึง: (TO:) <u>ส่วนงานไอที (IT SECTION)</u> <font color="white">.........................</font> จาก: แผนก/ส่วนงาน (FRM:) <u>'.$rs->customer_name.'</u>
                <br />
                <br />
	            <table border="0" style="background-color: white; border: solid #000 0.5px;border-spacing:5px 5px;">
	                <tr>
	                <td>
	                <br /> อุปกรณ์ที่แจ้งซ่อม: (EQUIP. NAME) : <u>'.$rs->type_name . ' ' . $rs->brand_name . ' ' . $rs->model_name . '</u>
	                <br /> หมายเลขประจำอุปกรณ์ (EQUIP. ID) : <u>' . $rs->product_code . '</u>
	                <br /> อาการหรือเหตุขัดข้อง (CONDITION) : <u>' . $rs->cause . '</u>

	                <br />
	                <br />
	                <div align="center">...................................... <br /> ผู้แจ้งซ่อม (INFORMER)</div>
	                </td>
	                </tr>
	            </table>
	            <br />
	            <br />
	            <span style="background-color: gray;"><b>สำหรับส่วนงานไอที (IT SECTION)</b></span>
                <br />
                <br />
	            <table border="0" style="background-color: white; border: solid #000 0.5px;border-spacing:5px 5px;">
	                <tr>
	                <td>
	                <br /> วันที่เข้าตรวจเช็ค: (CHECK DATE) : ............../....................../................
	                <br /> การตรวจเช็ค/อาการ (CONDITION AFTER CHECK) ......................................................................................................... <br />
	                ............................................................................................................................................................................................
	                <br /> การแก้ไข/ซ่อมแซม (IMPROVEMENT/REPAIR) : .............................................................................................................. <br />
	                ............................................................................................................................................................................................
	                </td>
	                </tr>
	            </table>
	            <br />
	            <br />
	            <span style="background-color: gray;"><b>สรุปผลการแก้ไข/ซ่อมแซม (CONCLUSION)</b></span>
                <br />
                <br />
	            <table border="0" style="background-color: white; border: solid #000 0px;border-spacing:5px 5px;">
	                <tr>
	                <td>
	                <br /> [ &nbsp; &nbsp; ]  ใช้งานได้ (CAN USE REGULARLY)
	                <br /> [ &nbsp; &nbsp; ]  ซ่อมไม่ได้/ต้องเปลี่ยนอะไหล่ (CANNOT REPAIR NEEDS TO CHANGE/REPLACE PART(S))
	                <br /> &nbsp; &nbsp; &nbsp; ระบุเหตุผลหรือรายการอะไหล่เปลี่ยน (REASON OR CHANGE PART(S) SPECIFY)
	                <br />
	                &nbsp; &nbsp; &nbsp;
	                1)...................................................................................... 4).........................................................................................
	                <br />
	                &nbsp; &nbsp; &nbsp;
	                2)...................................................................................... 5).........................................................................................
	                <br />
	                &nbsp; &nbsp; &nbsp;
	                3)...................................................................................... 6).........................................................................................
                    <br />
                    <br /> [ &nbsp; &nbsp; ]  ส่งซ่อมหน่วยงานภายนอก (SEND TO OUTSOURCE SERVICE) ระบุ (VENDER SPECIFY).....................................
	                </td>
	                </tr>
	            </table>

	            <br />
	            <br />
	            <br />
	            <br />
	            <div align="right">
	            วันที่ซ่อมเสร็จ (FINISHED DATE) ............../.............../...................
	            <br />
	            <br />
	            <br />
	            <br />
	            ................................................ &nbsp; &nbsp; &nbsp; ................................................
	            <br /> เจ้าหน้าที่ไอที <font color="white">.................................</font> ผู้จัดการไอที <font color="white">...............</font>
	            </div>
	            ';
	            
	            $this->pdf->WriteHTML($html, true, false, true, false,'');

                ob_end_clean();
	            //Close and output PDF document
	            $this->pdf->Output($sv.'.pdf', 'I'); 
            }else{
            	show_error('Service not found.', 404);
            }
            
    	}

    }

    public function technician_history($user_code='', $s='', $e=''){
    	if(!isset($user_code) || empty($user_code)){
    		show_error('User not found.', 404);
    	}else{

            $s = empty($s) ? date('d/m/Y') : string_to_js_date($s);
            $e = empty($e) ? date('d/m/Y') : string_to_js_date($e);

            $s = to_mysql_date($s);
            $e = to_mysql_date($e);

            $rs = $this->report->get_service_by_technician_all($user_code, $s, $e);

            if($rs){
            	$this->load->library('pdf');
	            $this->pdf->setPrintHeader(false);
	            $this->pdf->setPrintFooter(false);
	            $this->pdf->setTopMargin(15);

	            // set document information
	            $this->pdf->SetSubject('AA Service');
	            $this->pdf->SetKeywords('AA Service');

	            // add a page
	            $this->pdf->AddPage('L');
	            $this->pdf->SetFont('freeserif', '', 11);

                $user_fullname = get_user_fullname($user_code);
	            $html = '
	            <div align="center"><h1>สถิติการให้บริการแยกตามช่างผู้รับผิดชอบ</h1></div>
                USER: <b>['.$user_code.'] ' . $user_fullname . '</b> ตั้งแต่วันที่ '.to_thai_date($s).'
                 ถึง '.to_thai_date($e).'<br> <br>
	                                    <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="30">#</th>
                    <th width="60">วันที่</th>
                    <th width="100">เลขที่ใบรับซ่อม</th>
                    <th width="180">อาการ</th>
                    <th width="100">ผู้แจ้งซ่อม</th>
                    <th width="120">หน่วยงานที่แจ้ง</th>
                    <th width="150">ผลการซ่อม</th>
                    <th width="60">สถานะปัจจุบัน</th>
                </tr>
                </thead>
                <tbody>
                ';
                $i = 1;
                foreach($rs as $r)
                {
                    $html .= '
                    <tr>
                        <td width="30">'.$i.'</td>
                        <td width="60">'.to_thai_date($r->date_serv).'</td>
                        <td width="100">'.$r->service_code.'</td>
                        <td width="180">'.$r->cause.'</td>
                        <td width="100">'.$r->contact_name.'</td>
                        <td width="120">'.$r->customer_name.'</td>
                        <td width="150">'.$r->service_result.'</td>
                        <td width="60">'.get_status_name($r->service_status).'</td>
                    </tr>
                    ';

                    $i++;
                }

                $html .=  '</tbody></table>';

	            $this->pdf->WriteHTML($html, true, false, true, false,'');

                ob_end_clean();
	            //Close and output PDF document
	            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
            }else{
            	show_error('User not found.', 404);
            }

    	}

    }

    public function customer_history($customer_code='', $s='', $e=''){
    	if(empty($customer_code)){
    		show_error('Customer not found.', 404);
    	}else{

            $s = empty($s) ? date('d/m/Y') : string_to_js_date($s);
            $e = empty($e) ? date('d/m/Y') : string_to_js_date($e);

            $s = to_mysql_date($s);
            $e = to_mysql_date($e);

            $rs = $this->report->get_service_by_customer_all($customer_code, $s, $e);

            if($rs){
            	$this->load->library('pdf');
	            $this->pdf->setPrintHeader(false);
	            $this->pdf->setPrintFooter(false);
	            $this->pdf->setTopMargin(15);

	            // set document information
	            $this->pdf->SetSubject('AA Service');
	            $this->pdf->SetKeywords('AA Service');

	            // add a page
	            $this->pdf->AddPage('L');
	            $this->pdf->SetFont('freeserif', '', 11);

                $customer_name = get_customer_name($customer_code);
	            $html = '
	            <div align="center"><h1>สถิติการใช้ริการของหน่วยงาน</h1></div>
                หน่วยงาน: <b>['.$customer_code.'] ' . $customer_name . '</b> ตั้งแต่วันที่ '.to_thai_date($s).'
                 ถึง '.to_thai_date($e).' <br> <br>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="100">เลขที่ใบรับซ่อม</th>
                    <th width="70">วันที่แจ้ง</th>
                    <th width="70">รหัสสินค้า</th>
                    <th width="100">Serial No.</th>
                    <th width="150">ประเภท</th>
                    <th width="100">ยี่ห้อ</th>
                    <th width="100">รุ่น</th>
                    <th width="100">สถานะ</th>
                </tr>
                </thead>
                <tbody>
                ';

                foreach($rs as $r)
                {
                    $html .= '
                    <tr>
                    <td width="100">'.$r->service_code.'</td>
                    <td width="70">'.to_thai_date($r->date_serv).'</td>
                    <td width="70">'.$r->product_code.'</td>
                    <td width="100">'.$r->product_serial.'</td>
                    <td width="150">'.$r->type_name.'</td>
                    <td width="100">'.$r->brand_name.'</td>
                    <td width="100">'.$r->model_name.'</td>
                    <td width="100">'.get_status_name($r->service_status).'</td>
                </tr>
                    ';
                }


                $html .=  '</tbody></table>';

	            $this->pdf->WriteHTML($html, true, false, true, false,'');

                ob_end_clean();
	            //Close and output PDF document
	            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
            }else{
            	show_error('User not found.', 404);
            }

    	}

    }

    public function service_list($s='', $e=''){
    	if(empty($s)){
    		show_error('Start date not found.', 404);
    	}else{

            $s = empty($s) ? date('d/m/Y') : string_to_js_date($s);
            $e = empty($e) ? date('d/m/Y') : string_to_js_date($e);

            $s = to_mysql_date($s);
            $e = to_mysql_date($e);

            $rs = $this->report->get_service_list_all($s, $e);

            if($rs){
            	$this->load->library('pdf');
	            $this->pdf->setPrintHeader(false);
	            $this->pdf->setPrintFooter(false);
	            $this->pdf->setTopMargin(15);

	            // set document information
	            $this->pdf->SetSubject('AA Service');
	            $this->pdf->SetKeywords('AA Service');

	            // add a page
	            $this->pdf->AddPage('L');
	            $this->pdf->SetFont('freeserif', '', 11);

	            $html = '
	            <div align="center"><h1>สถิติการให้บริการ</h1></div>
                ระหว่างวันที่ <b> '.to_thai_date($s).' ถึง '.to_thai_date($e).'</b> <br> <br>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="30">#</th>
                    <th width="60">วันที่</th>
                    <th width="100">เลขที่ใบรับซ่อม</th>
                    <th width="100">อาการ</th>
                    <th width="100">ผู้แจ้งซ่อม</th>
                    <th width="100">หน่วยงานที่แจ้ง</th>
                    <th width="100">ช่างผู้ปฏิบัติงาน</th>
                    <th width="150">ผลการซ่อม</th>
                    <th width="60">สถานะปัจจุบัน</th>
                </tr>
                </thead>
                <tbody>
                ';
                $i = 1;
                foreach($rs as $r)
                {
                    $html .= '
                    <tr>
                        <td width="30">'.$i.'</td>
                        <td width="60">'.to_thai_date($r->date_serv).'</td>
                        <td width="100">'.$r->service_code.'</td>
                        <td width="100">'.$r->cause.'</td>
                        <td width="100">'.$r->contact_name.'</td>
                        <td width="100">'.$r->customer_name.'</td>
                        <td width="100">'.$r->technician_name.'</td>
                        <td width="150">'.$r->service_result.'</td>
                        <td width="60">'.get_status_name($r->service_status).'</td>
                    </tr>
                    ';

                    $i++;
                }


                $html .=  '</tbody></table>';

	            $this->pdf->WriteHTML($html, true, false, true, false,'');

                ob_end_clean();
	            //Close and output PDF document
	            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
            }else{
            	show_error('User not found.', 404);
            }

    	}

    }
    public function service_history($query=''){
    	if(empty($query)){
    		show_error('Product not found.', 404);
    	}else{

            $rs = $this->report->search_history($query);

            if($rs){
            	$this->load->library('pdf');
	            $this->pdf->setPrintHeader(false);
	            $this->pdf->setPrintFooter(false);
	            $this->pdf->setTopMargin(15);

	            // set document information
	            $this->pdf->SetSubject('AA Service');
	            $this->pdf->SetKeywords('AA Service');

	            // add a page
	            $this->pdf->AddPage('L');
	            $this->pdf->SetFont('freeserif', '', 11);

	            $html = '
	            <div align="center"><h1>ประวัติการแจ้งซ่อมของสินค้า</h1></div>
                รหัส <b> '.$query.'</b> <br> <br>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="30">#</th>
                    <th width="60">วันที่</th>
                    <th width="100">เลขที่ใบรับซ่อม</th>
                    <th width="100">อาการ</th>
                    <th width="100">ผู้แจ้งซ่อม</th>
                    <th width="100">หน่วยงานที่แจ้ง</th>
                    <th width="100">ช่างผู้ปฏิบัติงาน</th>
                    <th width="150">ผลการซ่อม</th>
                    <th width="60">สถานะปัจจุบัน</th>
                </tr>
                </thead>
                <tbody>
                ';
                $i = 1;
                foreach($rs as $r)
                {
                    $html .= '
                    <tr>
                        <td width="30">'.$i.'</td>
                        <td width="60">'.to_thai_date($r->date_serv).'</td>
                        <td width="100">'.$r->service_code.'</td>
                        <td width="100">'.$r->cause.'</td>
                        <td width="100">'.$r->contact_name.'</td>
                        <td width="100">'.$r->customer_name.'</td>
                        <td width="100">'.$r->technician_name.'</td>
                        <td width="150">'.$r->service_result.'</td>
                        <td width="60">'.get_status_name($r->service_status).'</td>
                    </tr>
                    ';

                    $i++;
                }


                $html .=  '</tbody></table>';

	            $this->pdf->WriteHTML($html, true, false, true, false,'');

                ob_end_clean();
	            //Close and output PDF document
	            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
            }else{
            	show_error('Query not found.', 404);
            }

    	}

    }

    public function product_all(){
        $rs = $this->product->get_list_all();

        if($rs){
            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(15);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage('L');
            $this->pdf->SetFont('freeserif', '', 11);

            $html = '
                <div align="center"><h1>รายการสินค้าทั้งหมด</h1></div>
	                        <table>
                <thead>
                <tr style="background-color: gray;">
                    <th width="30"><b>#</b></th>
                    <th width="70"><b>รหัส</b></th>
                    <th width="70"><b>Serial No.</b></th>
                    <th width="120"><b>ประเภท</b></th>
                    <th width="70"><b>ยี่ห้อ</b></th>
                    <th width="70"><b>รุ่น</b></th>
                    <th width="130"><b>รายละเอียด</b></th>
                    <th width="100"><b>หน่วยงาน/ลูกค้า</b></th>
                    <th width="70"><b>วันที่ซื้อ</b></th>
                    <th width="40"><b>อายุ(ปี)</b></th>
                </tr>
                </tr>
                </thead>
                <tbody>
                ';
            $i = 1;
            foreach($rs as $r)
            {
                $html .= '
                    <tr>
                    <td width="30">'.$i.'</td>
                    <td width="70">'.$r->product_code.'</td>
                    <td width="70">'.$r->product_serial.'</td>
                    <td width="120">'.$r->type_name.'</td>
                    <td width="70">'.$r->brand_name.'</td>
                    <td width="70">'.$r->model_name.'</td>
                    <td width="130">'.$r->spec.'</td>
                    <td width="100">'.$r->customer_name.'</td>
                    <td width="70">'.to_thai_date($r->purchase_date).'</td>
                    <td width="40">'.count_age($r->purchase_date).'</td>
                </tr>
                    ';

                $i++;
            }


            $html .=  '</tbody></table>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');

            ob_end_clean();
            //Close and output PDF document
            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
        }else{
            show_error('User not found.', 404);
        }

    }
    public function product_filter($customer_code='', $type_code=''){
        $rs = $this->product->search_filter_all($type_code, $customer_code);

        if($rs){
            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(15);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage('L');
            $this->pdf->SetFont('freeserif', '', 11);

            $html = '

                <div align="center"><h1>รายการสินค้าทั้งหมด (ตามเงื่อนไข)</h1></div>
	                        <table>
                <thead>
                <tr style="background-color: gray;">
                    <th width="30"><b>#</b></th>
                    <th width="70"><b>รหัส</b></th>
                    <th width="70"><b>Serial No.</b></th>
                    <th width="120"><b>ประเภท</b></th>
                    <th width="70"><b>ยี่ห้อ</b></th>
                    <th width="70"><b>รุ่น</b></th>
                    <th width="130"><b>รายละเอียด</b></th>
                    <th width="100"><b>หน่วยงาน/ลูกค้า</b></th>
                    <th width="70"><b>วันที่ซื้อ</b></th>
                    <th width="40"><b>อายุ(ปี)</b></th>
                </tr>
                </tr>
                </thead>
                <tbody>
                ';
            $i = 1;
            foreach($rs as $r)
            {
                $html .= '
                    <tr>
                    <td width="30">'.$i.'</td>
                    <td width="70">'.$r->product_code.'</td>
                    <td width="70">'.$r->product_serial.'</td>
                    <td width="120">'.$r->type_name.'</td>
                    <td width="70">'.$r->brand_name.'</td>
                    <td width="70">'.$r->model_name.'</td>
                    <td width="130">'.$r->spec.'</td>
                    <td width="100">'.$r->customer_name.'</td>
                    <td width="70">'.to_thai_date($r->purchase_date).'</td>
                    <td width="40">'.count_age($r->purchase_date).'</td>
                </tr>
                    ';

                $i++;
            }


            $html .=  '</tbody></table>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');

            ob_end_clean();
            //Close and output PDF document
            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
        }else{
            show_error('User not found.', 404);
        }

    }
    public function customer(){
        $rs = $this->customer->get_all();

        if($rs){
            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(15);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage('L');
            $this->pdf->SetFont('freeserif', '', 11);

            $html = '
                <div align="center"><h1>ข้อมูลลูกค้า/หน่วยงาน</h1></div>
                 <hr><br>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="80"><b>รหัส</b></th>
                    <th width="210"><b>ชื่อหน่วยงาน/ลูกค้า</b></th>
                    <th width="150"><b>ชื่อผู้ติดต่อ</b></th>
                    <th width="220"><b>ที่อยู่</b></th>
                    <th width="100"><b>เบอร์โทรศัพท์</b></th>
                </tr>
                </tr>
                </thead>
                <tbody>
                ';

            foreach($rs as $r)
            {
                $html .= '
                    <tr>
                    <td width="80">'.$r->code.'</td>
                    <td width="210">'.$r->name.'</td>
                    <td width="150">'.$r->contact_name.'</td>
                    <td width="220">'.$r->address.'</td>
                    <td width="100">'.$r->telephone.'</td>
                </tr>
                    ';
            }


            $html .=  '</tbody></table>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');

            ob_end_clean();
            //Close and output PDF document
            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
        }else{
            show_error('User not found.', 404);
        }

    }
    public function suppliers(){
        $rs = $this->supplier->get_all();

        if($rs){
            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(15);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage('L');
            $this->pdf->SetFont('freeserif', '', 11);

            $html = '
                <div align="center"><h1>ข้อมูลร้านค้า</h1></div>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="80"><b>รหัส</b></th>
                    <th width="210"><b>ชื่อหน่วยงาน/ลูกค้า</b></th>
                    <th width="150"><b>ชื่อผู้ติดต่อ</b></th>
                    <th width="220"><b>ที่อยู่</b></th>
                    <th width="100"><b>เบอร์โทรศัพท์</b></th>
                </tr>
                </tr>
                </thead>
                <tbody>
                ';

            foreach($rs as $r)
            {
                $html .= '
                    <tr>
                    <td width="80">'.$r->code.'</td>
                    <td width="210">'.$r->name.'</td>
                    <td width="150">'.$r->contact_name.'</td>
                    <td width="220">'.$r->address.'</td>
                    <td width="100">'.$r->telephone.'</td>
                </tr>
                    ';
            }


            $html .=  '</tbody></table>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');

            ob_end_clean();
            //Close and output PDF document
            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
        }else{
            show_error('User not found.', 404);
        }

    }

    public function other_device(){
        $rs = $this->device->get_list_all();

        if($rs){
            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(15);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage('L');
            $this->pdf->SetFont('freeserif', '', 11);

            $html = '
                <div align="center"><h1>ข้อมูลอุปกรณ์</h1></div>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="80"><b>รหัส</b></th>
                    <th width="210"><b>รายการ</b></th>
                </tr>
                </tr>
                </thead>
                <tbody>
                ';

            foreach($rs as $r)
            {
                $html .= '
                    <tr>
                    <td width="80">'.$r->code.'</td>
                    <td width="210">'.$r->name.'</td>
                </tr>
                    ';
            }


            $html .=  '</tbody></table>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');

            ob_end_clean();
            //Close and output PDF document
            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
        }else{
            show_error('User not found.', 404);
        }

    }
    public function charge_item(){
        $rs = $this->item->get_list_all();

        if($rs){
            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(15);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage('L');
            $this->pdf->SetFont('freeserif', '', 11);

            $html = '
                <div align="center"><h1>รายการอุปกรณ์/ค่าใช้จ่าย</h1></div>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="80"><b>รหัส</b></th>
                    <th width="210"><b>รายการ</b></th>
                    <th width="100"><b>ราคา</b></th>
                </tr>
                </tr>
                </thead>
                <tbody>
                ';

            foreach($rs as $r)
            {
                $html .= '
                    <tr>
                    <td width="80">'.$r->code.'</td>
                    <td width="210">'.$r->name.'</td>
                    <td width="100">'.number_format($r->price, 2).'</td>
                </tr>
                    ';
            }


            $html .=  '</tbody></table>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');

            ob_end_clean();
            //Close and output PDF document
            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
        }else{
            show_error('User not found.', 404);
        }

    }

    public function users(){
        $rs = $this->admin->get_list();

        if($rs){
            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(15);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage('L');
            $this->pdf->SetFont('freeserif', '', 11);

            $html = '
                <div align="center"><h1>ผู้ใช้งาน (Users)</h1></div>
	                        <table>
                <thead>
                <tr bgcolor="gray">
                    <th width="100">รหัสผู้ใช้งาน</th>
                    <th width="80">ชื่อผู้ใช้งาน</th>
                    <th width="400">ชื่อ - สกุล</th>
                    <th width="100">ประเภท</th>
                    <th width="100">สถานะ</th>
                </tr>
                </thead>
                <tbody>
                ';

            foreach($rs as $r)
            {
                $status = $r->user_status == '1' ? 'ปกติ' : 'ระงับสิทธิ';

                if($r->user_type == '3')
                    $type = 'Admin';
                else if($r->user_type == '2')
                    $type = 'ช่าง';
                else $type = 'ทั่วไป';

                $html .= '
                    <tr>
                    <td width="100">'.$r->user_code.'</td>
                    <td width="80">'.$r->username.'</td>
                    <td width="400">'.$r->fullname.'</td>
                    <td width="100">'.$type.'</td>
                    <td width="100">'.$status.'</td>
                </tr>
                    ';
            }


            $html .=  '</tbody></table>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');

            ob_end_clean();
            //Close and output PDF document
            $this->pdf->Output(date('YmdHis').'.pdf', 'I');
        }else{
            show_error('User not found.', 404);
        }

    }
}