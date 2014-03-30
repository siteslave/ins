$(function(){

    var serial = {
        ajax: {
            save: function(data, cb){
                var url = '/admins/serial_save',
                    params = {
                        data: data
                    };

                App.ajax(url, params, function(err, data){
                    err ? cb(err) : cb(null, data);
                });
            }
        }
    };

    $('a[data-name="btn_set_data" ]').click(function(){
        var data = {};
        data.id = $(this).attr('data-id');
        data.serial = $(this).parent().prev().find('input[data-name="serial"]').val();
        data.prefix = $(this).parent().prev().prev().prev().find('input[data-name="prefix"]').val();
        data.adddate = $(this).parent().prev().prev().find('input:[type="checkbox"]');

        data.adddate = data.adddate.attr('checked') ? '1' : '0';

        if(!data.serial)
        {
            App.alert('กรุณาระบุค่าเริ่มต้นของลำดับที่');
        }
        else if(!data.prefix)
        {
            App.alert('กรุณาระบุรูปแบบ');
        }
        else
        {
            serial.ajax.save(data, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อย');
                }
            });
        }
    });
});
