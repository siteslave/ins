<form class="form-signin" method="post" action="<?=site_url('users/do_login')?>">
    <input type="text" class="input-block-level" id="username"
           rel="tooltip" title="ชื่อผู้ใช้งาน/Username" name="username" placeholder="ชื่อผู้ใช้งาน" autofocus>
    <input type="password" class="input-block-level"
           rel="tooltip" title="รหัสผ่าน/Password" id="password" name="password" placeholder="รหัสผ่าน">
    <button class="btn btn-large btn-primary btn-block" id="btn_login" type="submit">เข้าสู่ระบบ</button>
</form>