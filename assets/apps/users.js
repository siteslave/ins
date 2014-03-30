$(function(){

    $('#btn_login').click(function(){
        var username = $('#username').val(),
            password = $('#password').val();

        if(!username){
            alert('กรุณากรอกชื่อผู้ใช้งาน');
            return false;
        }else if(!password){
            alert('กรุณากรอกรหัสผ่าน');
            return false;
        }else{
            return true;
        }
    });
});
