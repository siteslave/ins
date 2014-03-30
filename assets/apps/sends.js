$(function(){
	var sends = {};
	
	sends.modal = {
		show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).show();
       },
       
       hide_new: function(){
       		$('#mdl_new').modal('hide');
       },

        show_remove: function(){
            $('#mdl_regemove_get').modal({backdrop: 'static'}).show();
       },

       hide_remove: function(){
       		$('#mdl_regemove_get').modal('hide');
       },
       
        show_get: function(){
            $('#mdl_get').modal({backdrop: 'static'}).show();
       },
       
       hide_get: function(){
       		$('#mdl_get').modal('hide');
       }
	};
	
	sends.ajax = {
       search: function(query, start, stop, cb){
            var url = '/sends/search',
                params = {
                    query: query,
                    start: start,
                    stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       search_total: function(query, cb){
            var url = '/sends/search_total',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       get_list_total: function(status, cb){
            var url = '/sends/get_list_total',
                params = {
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       get_list: function(status, start, stop, cb){
            var url = '/sends/get_list',
                params = {
                    status: status,
                    start: start,
                    stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       save: function(data, cb){
       		var url = '/sends/save',
       			params = {
       				data: data
       			};
       			
       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       save_get: function(data, cb){
       		var url = '/sends/save_get',
       			params = {
       				data: data
       			};
       			
       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       remove_get: function(data, cb){
       		var url = '/sends/remove_get',
       			params = {
       				data: data
       			};
       			
       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       remove: function(id, service_code, cb){
       		var url = '/sends/remove',
       			params = {
       				id: id,
                    service_code: service_code
       			};
       			
       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       }
	};
	
	sends.clear_new = function(){
		$('#txt_send_date').val('');
		$('#txt_new_service_code').val('');
		$('#txt_new_service_code').removeAttr('disabled');
		$('#txt_new_service_company_name').val('');
		$('#txt_new_service_company_code').val('');
		$('#txt_isupdate').val('0');
        $('#txt_id').val('');
	}

    $('#txt_new_service_code').typeahead({
        ajax: {
            url: site_url + '/sends/search_service_ajax',
            timeout: 500,
            displayField: 'service_code',
            triggerLength: 3,
            preDispatch: function(query){
                return {
                    query: query
                }
            },

            preProcess: function(data){
                if(data.success){
                    return data.rows;
                }else{
                    return false;
                }
            }
        },
        updater: function(data){
            return data;
        }
    });

	$('#txt_new_service_company_name').typeahead({
        ajax: {
            url: site_url + '/sends/search_supplier_ajax',
            timeout: 500,
            displayField: 'name',
            triggerLength: 3,
            preDispatch: function(query){
                return {
                    query: query
                }
            },

            preProcess: function(data){
                if(data.success){
                    return data.rows;
                }else{
                    return false;
                }
            }
        },
        updater: function(data){
            var sup = data.split('#');
            var code = sup[0],
                name = sup[1];

            $('#txt_new_service_company_code').val(code);
            return name;
        }
    });

	$('#btn_new').on('click', function(){
		sends.clear_new();
		sends.modal.show_new();
	});
	
	$('#btn_save').on('click', function(){
		var items = {};
		
		items.change_status = $('#chk_new_send_change_status').attr('checked') ? '1' : '0';
		items.company_code = $('#txt_new_service_company_code').val();
		items.service_code = $('#txt_new_service_code').val();
		items.send_date = $('#txt_send_date').val();
        items.is_update = $('#txt_isupdate').val();
        items.id = $('#txt_id').val();

			if(!items.send_date){
				App.alert('กรุณาระบุวันที่ส่งซ่อม');
			}else if(!items.service_code){
				App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
			}else if(!items.company_code){
				App.alert('กรุณาระบุร้านค้า/บริษัทที่ส่งซ่อม');
			}else{
				//do save
				sends.ajax.save(items, function(err){
					if(err){
						App.alert(err);
					}else{
						App.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
						//get list
						sends.modal.hide_new();
                        sends.get_list();
					}
				});
			}
		
	});
	
	sends.do_search = function(query){
		sends.ajax.search_total(query, function(err, data){
	        if(err){
	            App.alert(err);
	        }else{
	            $('#main_paging').paging(data.total, {
	                    format: " < . (qq -) nnncnnn (- pp) . >",
	                    perpage: App.record_perpage,
	                    lapping: 1,
	                    page: 1,
	                    onSelect: function(page){
	                        sends.ajax.search(query, this.slice[0], this.slice[1], function(err, data){
	                            sends.set_list(err, data);
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

    //get list status
    sends.set_list = function(err, data){
        $('#tbl_list > tbody').empty();
        if(err){
            App.alert(err);
            $('#tbl_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    var status = v.send_status == '1' ? '<i class="icon-ok"></i>' : '<i class="icon-minus"></i>';

                    $('#tbl_list > tbody').append(
                        '<tr>' +
                            '<td>'+ to_thai_date(v.send_date) +'</td>' +
                            '<td>'+ v.send_code +'</td>' +
                            '<td>'+ v.company_name +'</td>' +
                            '<td>'+ v.service_code +'</td>' +
                            '<td>'+ v.product_code +'</td>' +
                            '<td>'+ v.type_name +'</td>' +
                            '<td>'+ v.brand_name +'</td>' +
                            '<td>'+ v.model_name +'</td>' +
                            '<td>'+ to_thai_date(v.get_date) +'</td>' +
                            '<td>'+ status +'</td>' +
                            '<td>'+
                            '<div class="btn-group dropup"> ' +
                            '<a href="javascript:void(0);" class="btn btn primary"><i class="icon-th-list"></i></a>' +
                            '<a class="btn btn primary dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> ' +
                            '<span class="caret"></span> ' +
                            '</a>' +
                            '<ul class="dropdown-menu pull-right">' +
                            '<li><a href="javascript:void(0);" data-name="btn_edit" data-id="'+ v.id +'" ' +
                            'data-send_code="' + v.send_code + '" data-service_code="'+ v.service_code +'" ' +
                            'data-send_date="'+ v.send_date +'" data-company_code="'+ v.company_code +'" data-company_name="'+ v.company_name +'" ' +
                            'data-product_code="'+ v.product_code +'"><i class="icon-edit"></i> แก้ไขข้อมูล</a></li>' +
                            '<li><a href="javascript:void(0);" data-name="btn_get" data-send_code="'+ v.send_code +'" ' +
                            'data-id="'+ v.id +'" data-sv="'+ v.service_code +'" data-get_date="'+ to_thai_date(v.get_date) +'"><i class="icon-download-alt"></i> รับคืน</a></li>' +
                            '<li><a href="javascript:void(0);" data-name="btn_remove_get" data-id="'+ v.id +'" data-send_code="'+ v.send_code +'" ' +
                            'data-sv="'+ v.service_code +'"><i class="icon-upload-alt"></i> ยกเลิกรับคืน</a></li>' +
                            '<li class="divider"></li>' +
                            '<li><a href="javascript:void(0);" data-name="btn_remove" data-id="'+ v.id +'" data-sv="'+ v.service_code +'"><i class="icon-trash"></i> ลบรายการ </a></li>' +
                            '</ul></div>' +
                            '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
            }
        }

    };

    sends.get_list = function(){
		var status = $('#txt_status').val();
		sends.ajax.get_list_total(status, function(err, data){
	        if(err){
	            App.alert(err);
	        }else{
	            $('#main_paging').paging(data.total, {
	                    format: " < . (qq -) nnncnnn (- pp) . >",
	                    perpage: App.record_perpage,
	                    lapping: 1,
	                    page: 1,
	                    onSelect: function(page){
	                        sends.ajax.get_list(status, this.slice[0], this.slice[1], function(err, data){
	                            sends.set_list(err, data);
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
	
	$('a[data-name="btn_set_status"]').click(function(){
		var status_id = $(this).data('status');
		$('#txt_status').val(status_id);
		
		sends.get_list();
	});
	
	//search
	$('#btn_search').click(function(){
		var query = $('#txt_query').val();
		if(!query){
			App.alert('กรุณาระบุคำที่ต้องการค้นหา');
		}else{
			//do search
			sends.do_search(query);
		}	
	});

	$(document).on('click', 'a[data-name="btn_edit"]', function(){
		var items = {};
		items.id = $(this).attr('data-id');
		items.send_code = $(this).attr('data-send_code');
		items.service_code = $(this).attr('data-service_code');
		items.send_date = $(this).attr('data-send_date');
		items.company_code = $(this).attr('data-company_code');
		items.company_name = $(this).attr('data-company_name');
		
		//set data

		$('#txt_send_date').val(to_thai_date(items.send_date));
		$('#txt_new_service_code').val(items.service_code).attr('disabled', 'disabled').css('background-color', 'white');
		$('#txt_new_service_company_name').val(items.company_name);
		$('#txt_new_service_company_code').val(items.company_code);
		$('#txt_isupdate').val('1');
		$('#txt_id').val(items.id);

		sends.modal.show_new();
		
		
	});
	//get return
	$('a[data-name="btn_get"]').live('click', function(){
		var id = $(this).data('id'),
			sv = $(this).data('sv'),
			send_code = $(this).data('send_code'),
            get_comment = $(this).data('get_comment'),
            get_date = $(this).data('get_date');

            $('#txt_get_date').val(get_date);
			$('#txt_get_send_code').val(send_code);
			$('#txt_get_service_code').val(sv);
			$('#txt_send_id').val(id);
			
			sends.modal.show_get();
	});
	
	$('#btn_get_save').click(function(){
		var items = {
			id: $('#txt_send_id').val(),
			get_date: $('#txt_get_date').val(),
			service_code: $('#txt_get_service_code').val()
		};
		
		if(!items.id){
			App.alert('กรุณาระบุรหัสส่งซ่อม');
		}else if(!items.get_date){
			App.alert('กรุณาระบุวันที่รับคืน');
		}else{
			sends.ajax.save_get(items, function(err){
				if(err){
					App.alert(err);
				}else{
					App.alert('บันทึกข้อมูลการรับเสร็จเรียบร้อยแล้ว');
					sends.modal.hide_get();
					sends.get_list();
				}
			});
		}
	});

    //remove get
    $('a[data-name="btn_remove_get"]').live('click', function(){
        var id = $(this).attr('data-id'),
            send_code = $(this).attr('data-send_code'),
            sv = $(this).attr('data-sv'),
            remove_comment = $(this).attr('data-remove_comment') == 'null' ? '-' : $(this).attr('data-remove_comment');


        $('#txt_remove_send_code').val(send_code);
        $('#txt_remove_service_code').val(sv);
        $('#txt_remove_send_id').val(id);
        $('#txt_remove_comment').val(remove_comment);

        sends.modal.show_remove();

    });

    //do remove
    $('#btn_do_remove_get').click(function(){
    	var items = {};
    	items.id = $('#txt_remove_send_id').val(),
    	items.service_code = $('#txt_remove_service_code').val();

    	if(!items.id){
    		App.alert('กรุณาระบุข้อมูลรับซ่อม');
    	}else{
    		sends.ajax.remove_get(items, function(err){
    			App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
    			sends.modal.hide_remove();

    			sends.get_list();
    		});
    	}
    });
	

	//data-name="btn_remove" data-id="'+ v.id +'"
	$(document).on('click', 'a[data-name="btn_remove"]', function(){

		if(confirm('คุณต้องการลบรายการ ' + $(this).attr('data-sv')  + ' ใช่หรือไม่?')){
			var id = $(this).attr('data-id'),
                service_code = $(this).attr('data-sv');

			if(!id){
				App.alert('กรุณาระบุ ข้อมูลที่ต้องการลบ (ไม่พบ ID)');
			}else{
				//do remove
				sends.ajax.remove(id, service_code, function(err){
					if(err){
						App.alert(err);	
					}else{
						App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
						sends.get_list();
					}
				});
			}
		}

	});

	sends.get_list();
	
});
