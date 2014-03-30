$(function(){
    var groups = {};

    groups.modal = {
        show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).css({
                width: 600,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        }
    };

    groups.ajax = {
        save: function(data, cb){
            var url = '/groups/save',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove: function(id, cb){
            var url = '/groups/remove',
                params = {
                    id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list: function(start, stop, cb){
            var url = '/groups/get_list',
                params = {
                	start: start,
                	stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list_total: function(cb){
            var url = '/groups/get_list_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search: function(query, cb){
            var url = '/groups/search',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    };

	groups.set_list = function(data){
		if(_.size(data.rows) > 0){
            _.each(data.rows, function(v){
                $('#tbl_list tbody').append(
                    '<tr><td>' + v.name + '</td>' +
                        '<td>' +
                            '<div class="btn-group">' +
                            '<a href="javascript:void(0);" class="btn" data-name="edit" data-vname="' + v.name + '" data-id="' + v.id + '"><i class="icon-edit"></i></a>' +
                            '<a href="javascript:void(0);" class="btn" data-name="remove" data-id="' + v.id + '"><i class="icon-trash"></i></a>' +
                            '</div>' +
                        '</td>' +
                    '</tr>'
                );
            });
        }else{
            $('#tbl_list tbody').append(
                '<tr><td colspan="2">ไม่พบรายการ</td></tr>'
            );
        }	
	};
	groups.get_list = function(){
	    $('#main_paging').fadeIn('slow');
		groups.ajax.get_list_total(function(err, data){
	        if(err){
	            App.alert(err);
	        }else{
	            $('#main_paging > ul').paging(data.total, {
	                format: " < . (qq -) nnncnnn (- pp) . >",
	                perpage: App.record_perpage,
	                lapping: 1,
	                page: 1,
	                onSelect: function(page){
	                    //console.log('page: ' + page);
	                    //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop
	
	                    groups.ajax.get_list(this.slice[0], this.slice[1], function(err, data){
	                    	$('#tbl_list tbody').empty();
	                        if(err){
	                            App.alert(err);
	                        }else{
	                            groups.set_list(data);
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
	
    //show new modal
    $('#btn_new').click(function(){
        groups.modal.show_new();
    });

    $('#btn_save').click(function(){
        var items = {};
        items.name = $.trim($('#txt_name').val());
        items.id = $('#txt_id').val();
        items.old_name = $('#txt_old_name').val();

        if(!items.name){
            App.alert('กรุณาระบุชื่อ');
        }else{
            groups.ajax.save(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    $('#txt_name').val('');
                    $('#txt_id').val('');
                    $('#txt_old_name').val('');
                    $('#mdl_new').modal('hide');
                    //load list
                    groups.get_list();
                }
            });
        }
    });

    $('a[data-name="edit"]').live('click', function(){
        var id = $(this).attr('data-id'),
            name = $.trim($(this).attr('data-vname'));

        $('#txt_id').val(id);
        $('#txt_name').val(name);
        $('#txt_old_name').val(name);

        groups.modal.show_new();
    });

    $('#mdl_new').on('hidden', function(){
        $('#txt_name').val('');
        $('#txt_id').val('');
        $('#txt_old_name').val('');
    });

    $('a[data-name="remove"]').live('click', function(){
        var id = $(this).attr('data-id');
        var t = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){
            groups.ajax.remove(id, function(err){
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
            groups.ajax.search(query, function(err, data){
                if(err){
                    App.alert(err);
                    $('#tbl_list tbody').append(
                        '<tr><td colspan="2">ไม่พบรายการ</td></tr>'
                    );
                }else{
                    if(_.size(data.rows) > 0){
                        _.each(data.rows, function(v){
                            $('#tbl_list tbody').append(
                                '<tr><td>' + v.name + '</td>' +
                                    '<td>' +
                                    '<div class="btn-group">' +
                                    '<a href="javascript:void(0);" class="btn" data-name="edit" data-vname="' + v.name + '" data-id="' + v.id + '"><i class="icon-edit"></i></a>' +
                                    '<a href="javascript:void(0);" class="btn" data-name="remove" data-id="' + v.id + '"><i class="icon-trash"></i></a>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>'
                            );
                        });
                    }else{
                        $('#tbl_list tbody').append(
                            '<tr><td colspan="2">ไม่พบรายการ</td></tr>'
                        );
                    }
                }
            });
        }else{
            //App.alert('กรุณาระบุคำค้นหา ต้องมากกว่า 2 ตัวอักษรขึ้นไป');
            groups.get_list();
        }
    });

    groups.get_list();
});