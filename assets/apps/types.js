$(function(){
    var types = {};

    types.modal = {
        show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).show();
        }
    };

    types.ajax = {
        save: function(data, cb){
            var url = '/types/save',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove: function(code, cb){
            var url = '/types/remove',
                params = {
                    code: code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list: function(start, stop, cb){
            var url = '/types/get_list',
                params = {
                	start: start,
                	stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_list_total: function(cb){
            var url = '/types/get_list_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search: function(query, cb){
            var url = '/types/search',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    };
	types.set_list = function(data){
		if(_.size(data.rows) > 0){
            _.each(data.rows, function(v){
                $('#tbl_list tbody').append(
                    '<tr>' +
                        '<td>' + v.code + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' +
                            '<div class="btn-group">' +
                            '<a href="javascript:void(0);" class="btn" data-name="edit" data-vname="' + v.name + '" data-code="' + v.code + '"><i class="icon-edit"></i></a>' +
                            '<a href="javascript:void(0);" class="btn" data-name="remove" data-code="' + v.code + '"><i class="icon-trash"></i></a>' +
                            '</div>' +
                        '</td>' +
                    '</tr>'
                );
            });
        }else{
            $('#tbl_list tbody').append(
                '<tr><td colspan="3">ไม่พบรายการ</td></tr>'
            );
        }
	};
	types.get_list = function(){
	    $('#main_paging').fadeIn('slow');
		types.ajax.get_list_total(function(err, data){
	        if(err){
	            App.alert(err);
	        }else{
	            $('#main_paging').paging(data.total, {
	                format: " < . (qq -) nnncnnn (- pp) . >",
	                perpage: App.record_perpage,
	                lapping: 1,
	                page: 1,
	                onSelect: function(page){
	                    //console.log('page: ' + page);
	                    //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop

	                    types.ajax.get_list(this.slice[0], this.slice[1], function(err, data){
	                    	$('#tbl_list tbody').empty();
	                        if(err){
	                            App.alert(err);
	                        }else{
	                            types.set_list(data);
	                        }

	                    });

	                },
	                onFormat: function(type){
	                    switch (type) {

	                        case 'block':

	                            if (!this.active)
	                                return '<li class="disabled"><a href="">' + this.value + '</a></li>';
	                            else if (this.value != this.page)
	                                return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
	                            return '<li class="active"><a href="#">' + this.value + '</a></li>';

	                        case 'right':
	                        case 'left':

	                            if (!this.active) {
	                                return "";
	                            }
	                            return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';

	                        case 'next':

	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&raquo;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&raquo;</a></li>';

	                        case 'prev':

	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&laquo;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&laquo;</a></li>';

	                        case 'first':

	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&lt;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&lt;</a></li>';

	                        case 'last':

	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&gt;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&gt;</a></li>';

	                        case 'fill':
	                            if (this.active) {
	                                return '<li class="disabled"><a href="#">...</a></li>';
	                            }
	                    }
	                    return ""; // return nothing for missing branches
	                }
	            });
	        }
	    });
	};

	types.clear_form = function(){
	    $('#txt_name').val('');
        $('#txt_code').val('').removeAttr('disabled');
        $('#txt_isupdate').val('0');
	};

    //show new modal
    $('#btn_new').click(function(){
        types.modal.show_new();
    });

    $('#btn_save').click(function(){
        var items = {};
        items.name = $.trim($('#txt_name').val());
        items.code = $('#txt_code').val();
        items.isupdate = $('#txt_isupdate').val();

        if(!items.name){
            App.alert('กรุณาระบุชื่อ');
        }else{
            types.ajax.save(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    types.clear_form();
                    $('#mdl_new').modal('hide');
                    //load list
                    types.get_list();
                }
            });
        }
    });

    $('a[data-name="edit"]').live('click', function(){
        var code = $(this).attr('data-code'),
            name = $.trim($(this).attr('data-vname'));

        $('#txt_code').val(code).attr('disabled', 'disabled').css('background-color', 'white');
        $('#txt_name').val(name);
        $('#txt_isupdate').val('1');

        types.modal.show_new();
    });

    $('#mdl_new').on('hidden', function(){
        types.clear_form();
    });

    $('a[data-name="remove"]').live('click', function(){
        var code = $(this).attr('data-code');
        var t = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){
            types.ajax.remove(code, function(err){
                if(err){
                    App.alert(err);
                }else{
                    //remove row
                    App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                    $(t).fadeOut('slow');
                }
            });
        }
    });

    //search
    $('#btn_search').click(function(){
        var query = $.trim($('#txt_query').val());
		$('#main_paging').fadeOut('slow');
        $('#tbl_list tbody').empty();

        if(query && query.length > 2){
            //do search
            types.ajax.search(query, function(err, data){
                if(err){
                    App.alert(err);
                    $('#tbl_list tbody').append(
                        '<tr><td colspan="3">ไม่พบรายการ</td></tr>'
                    );
                }else{
                    types.set_list(data);
                }
            });
        }else{
            //App.alert('กรุณาระบุคำค้นหา ต้องมากกว่า 2 ตัวอักษรขึ้นไป');
            types.get_list();
        }
    });
    types.get_list();
});
