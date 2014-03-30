$(function(){
	var main = {};
	
	main.modal = {
		show_change_password: function(){
            $('#mdl_change_password').modal({backdrop: 'static'}).show();
        },hide_change_password: function(){
            $('#mdl_change_password').modal('hide');
        }
	};
	
	main.ajax = {
        change_password: function(new_pass, old_pass, cb){
            var url = '/users/change_password',
                params = {
                    new_pass: new_pass,
                    old_pass: old_pass
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
	};
	
	//change password
	$('a[data-name="chk-pass"]').click(function(){
		main.modal.show_change_password();
	});

    $('#btn_do_change_password').click(function(){
        var new_pass = $('#txt_new_password').val();
        var old_pass = $('#txt_old_password').val();

        if(!new_pass){
            App.alert('กรุณาระบุรหัสผ่านใหม่');
        }else if(!old_pass)
        {
            App.alert('กรุณาระบุรหัสผ่านเดิม');
        }
        else {
            //do change password
            main.ajax.change_password(new_pass, old_pass, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('เปลี่ยนรหัสผ่านเสร็จเรียบร้อยแล้ว');
                    main.modal.hide_change_password();
                }
            });
        }
    });
});