$(function(){
    var companies = {
        ajax: {
            save: function(data, cb){
                var url = '/companies/save',
                    params = {
                        data: data
                    };

                App.ajax(url, params, function(err, data){
                    err ? cb(err) : cb(null, data);
                });
            }
        }
    };

    $('#btn_save').click(function(){
        var data = {
            name: $('#txt_name').val(),
            address: $('#txt_address').val(),
            tax_code: $('#txt_tax_code').val(),
            telephone: $('#txt_telephone').val(),
            fax: $('#txt_fax').val(),
            email: $('#txt_email').val(),
            url: $('#txt_url').val()
        };

        if(!data.name){
            App.alert('กรุณาระบุชื่อกิจการ');
        }else if(!data.address){
            App.alert('กรุณาระบุที่อยู่');
        }else if(!data.telephone){
            App.alert('กรุณาระบุหมายเลขโทรศัพท์');
        }else{
            companies.ajax.save(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('ปรับปรุงข้อมูลเสร็จเรียบร้อยแล้ว');
                }
            });
        }
    });
});
