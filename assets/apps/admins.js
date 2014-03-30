$(function(){
    var admin = {};

    admin.modal = {
        show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).show();
        },
        show_change_password: function(){
            $('#mdl_change_password').modal({backdrop: 'static'}).show();
        }
    };

    admin.ajax = {
        get_list: function(cb){
            var url = '/admins/get_list',
                params = {

                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_detail: function(id, cb){
            var url = '/admins/get_detail',
                params = {
                      id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save: function(data, cb){
            var url = '/admins/save',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove: function(id, cb){
            var url = '/admins/remove',
                params = {
                    id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        change_password: function(data, cb){
            var url = '/admins/change_password',
                params = {
                    id: data.id,
                    password: data.password1
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
    };

    admin.get_list = function(){
        $('#tbl_list tbody').empty();
        admin.ajax.get_list(function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_list tbody').append(
                    '<tr><td colspan="5">ไม่พบรายการ</td></tr>'
                );
            }else{
                if(_.size(data.rows) > 0){
                    _.each(data.rows, function(v){
                        var status = v.user_status == '1' ? 'ปกติ' : 'ระงับสิทธิ';
                        $('#tbl_list tbody').append(
                            '<tr>' +
                                '<td>' + v.user_code + '</td>' +
                                '<td>' + v.username + '</td>' +
                                '<td>' + v.fullname + '</td>' +
                                '<td>' + v.type_name + '</td>' +
                                '<td>' + status + '</td>' +
                                '<td><div class="btn-group"> ' +
                                '<a href="javascript:void(0);" class="btn" title="แก้ไข" data-name="btn_edit" ' +
                                'data-id="'+ v.id +'"><i class="icon-edit"></i> </a> ' +
                                '<a href="javascript:void(0);" class="btn" title="เปลี่ยนรหัสผ่าน" ' +
                                'data-name="btn_change_pass" data-username="'+ v.username +'" ' +
                                'data-id="'+ v.id +'"><i class="icon-key"></i> </a> ' +
                                '<a href="javascript:void(0);" class="btn" title="ลบ" data-name="btn_remove" ' +
                                'data-id="'+ v.id +'"><i class="icon-trash"></i> </a> ' +
                                '</div></td>' +
                            '</tr>'
                        );
                    });
                }else{
                    $('#tbl_list tbody').append(
                        '<tr><td colspan="5">ไม่พบรายการ</td></tr>'
                    );
                }
            }
        });
    };

    admin.clear_form = function(){
        $('#txt_id').val('');
        //$('#txt_old_fullname').val('');
        $('#txt_fullname').val('');
        $('#txt_username').val('');
        $('#txt_password').removeAttr('disabled');
        $('#txt_username').removeAttr('disabled');
        $('#txt_password').val('');
        //$('#sl_user_type').val();
        //$('#chk_active').attr('checked') ? '1' : '0';
        //$('#sl_owner').val();
    };

    admin.set_data = function(id){
        admin.ajax.get_detail(id, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#txt_id').val(data.rows.id);
                $('#txt_fullname').val(data.rows.fullname);
                $('#txt_username').val(data.rows.username);
                $('#txt_password').attr('disabled', 'disabled').css('background-color', 'white');
                $('#txt_username').attr('disabled', 'disabled').css('background-color', 'white');;
                $('#txt_password').val('######');
                $('#sl_user_type').val(data.rows.user_type);

                if(data.rows.user_status == '1'){
                    $('#chk_active').attr('checked', 'checked');
                }else{
                    $('#chk_active').removeAttr('checked');
                }

                admin.modal.show_new();
            }
        });
    };

    $('#mdl_new').on('hidden', function(){
        admin.clear_form();
    });

    $('#btn_new').click(function(){
        admin.modal.show_new();
    });

    $('#btn_save').click(function(){
        var items = {};
        items.id = $('#txt_id').val();
        items.fullname = $('#txt_old_fullname').val();
        items.fullname = $('#txt_fullname').val();
        items.username = $('#txt_username').val();
        items.password = $('#txt_password').val();
        items.user_type = $('#sl_user_type').val();
        items.user_status = $('#chk_active').attr('checked') ? '1' : '0';

        if(!items.fullname){
            App.alert('กรุณาระบุชื่อ - สกุล');
        }else if(!items.username || items.username.length < 4){
            App.alert('กรุณาระบุชื่อผู้ใช้งาน อย่างน้อย 4 ตัวอักษรขึ้นไป');
        }else if(!items.password){
            App.alert('กรุณาระบุรหัสผ่าน');
        }else{
            //do save
            admin.ajax.save(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                    admin.clear_form();
                    admin.get_list();
                    $('#mdl_new').modal('hide');
                }
            });
        }


    });

    $('a[data-name="btn_edit"]').live('click', function(){
        var id = $(this).attr('data-id');

        //set user detail
        admin.set_data(id);
    });

    $('a[data-name="btn_change_pass"]').live('click', function(){
        var id = $(this).attr('data-id'),
            username = $(this).attr('data-username');
        //set data
        $('#txt_change_username').val(username);
        $('#txt_change_id').val(id);

        admin.modal.show_change_password();
    });

    $('#mdl_change_password').on('hidden', function(){
        $('#txt_change_username').val('');
        $('#txt_change_id').val('');
        $('#txt_new_password').val(''),
        $('#txt_confirm_new_password').val('');
    });

    $('#btn_do_change_password').click(function(){
        var items = {};
        items.id = $('#txt_change_id').val(),
        items.password1 = $('#txt_new_password').val(),
        items.password2 = $('#txt_confirm_new_password').val();

        if(!items.password1){
            App.alert('กรุณาระบุรหัสผ่าน');
        }else if(!items.password2){
            App.alert('กรุณาระบุรหัสผ่าน (อีกครั้ง)');
        }else if(items.password1 != items.password2){
            App.alert('รหัสผ่านทั้งสอง ไม่เหมือนกัน กรุณาตรวจสอบ');
        }else{
            admin.ajax.change_password(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('เปลี่ยนรหัสผ่านเสร็จเรียบร้อยแล้ว');
                    $('#mdl_change_password').modal('hide');
                }
            });
        }
    });

    //remove
    $('a[data-name="btn_remove"]').live('click', function(){
        var id = $(this).attr('data-id'),
            obj = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่? \r\nหากผู้ใช้งานคนนี้ได้ทำการให้บริการไปแล้วจะไม่สามารถลบได้')){
            admin.ajax.remove(id, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                    obj.fadeOut('slow');
                }
            })
        }
    });

    $('#btn_print').on('click', function(){
        App.goto_url('/prints/users');
    });

    admin.get_list();
});
