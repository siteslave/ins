$(function(){
	var request = {};

    request.ajax = {
        get_request_list: function(start, stop, cb){
            var url = '/services/get_request_list',
                params = {
                    start: start,
                    stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_request_status_list: function(status, start, stop, cb){
            var url = '/services/get_request_status_list',
                params = {
                    start: start,
                    stop: stop,
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_request_total: function(cb){
            var url = '/services/get_request_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_request_status_total: function(status, cb){
            var url = '/services/get_request_status_total',
                params = {
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        cancel_request: function(id, cb){
            var url = '/services/cancel_request',
                params = {
                    id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        confirm_request: function(id, cb){
            var url = '/services/confirm_request',
                params = {
                    id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        search_request: function(query, cb){
            var url = '/services/search_request',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
    };
    //Request
    request.set_request_list = function(data){
        if(_.size(data.rows) > 0){
            _.each(data.rows, function(v){
                var status = v.status_code == '-1' ? '<button class="btn btn-danger" type="button"><i class="icon-trash"></i></button>' :
                    v.status_code == '1' ? '<button class="btn btn-success" type="button"><i class="icon-ok"></i></button>' :
                        '<button class="btn" type="button"><i class="icon-time"></i></button>';
                var disb = v.status_code == '1' ? 'disabled="disabled"' : '';

                $('#tbl_request_list tbody').append(
                    '<tr>' +
                        '<td>' + status + '</td>' +
                        '<td>' + v.code + '</td>' +
                        '<td>' + to_thai_date(v.req_date) + '</td>' +
//                        '<td>' + v.customer + '</td>' +
                        '<td>' + v.contact + '</td>' +
                        '<td>' + v.telephone + '</td>' +
                        '<td>' + v.detail + '</td>' +
                        '<td>' +
                        '<div class="btn-group dropup">' +
                        ' <button class="btn dropdown-toggle" data-toggle="dropdown"> ' +
                        '<i class="icon-th-list"></i> <span class="caret"></span> ' +
                        '</button>' +
                        '<ul class="dropdown-menu pull-right">' +
                        '<li><a href="#" data-name="btn_cancel" data-id="'+ v.id +'"><i class="icon-trash"></i> ยกเลิก</a></li>' +
                        '<li><a href="#" data-name="btn_confirm" data-id="'+ v.id +'"><i class="icon-ok"></i> ยืนยัน (รับเรื่องแล้ว)</a></li>' +
                        '</ul>' +
                        '</div>' +
                        '</td>' +
                        '</tr>'
                );
            });
        }else{
            $('#tbl_request_list tbody').append(
                '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
            );
        }
    };
    request.get_request_list = function(){
        $('#main_paging').fadeIn('slow');
        $('#tbl_request_list tbody').empty();
        request.ajax.get_request_total(function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_request_list tbody').append(
                    '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                );
            }else{
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        request.ajax.get_request_list(this.slice[0], this.slice[1], function(err, data){

                            if(err){
                                App.alert(err);
                                $('#tbl_request_list tbody').append(
                                    '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                                );
                            }else{
                                request.set_request_list(data);
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

    request.get_request_status_list = function(status){
        $('#main_paging').fadeIn('slow');
        $('#tbl_request_list tbody').empty();
        request.ajax.get_request_status_total(status, function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_request_list tbody').append(
                    '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                );
            }else{
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        request.ajax.get_request_status_list(status, this.slice[0], this.slice[1], function(err, data){

                            if(err){
                                App.alert(err);
                                $('#tbl_request_list tbody').append(
                                    '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                                );
                            }else{
                                request.set_request_list(data);
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

    $('a[href="#tab1"]').on('click', function(){
        request.get_request_list();
    });

    $(document).on('click', 'a[data-name="btn_cancel"]', function(e){
        if(confirm('คุณต้องการยกเลิกรายการใช่หรือไม่'))
        {
            var id = $(this).data('id');
            request.ajax.cancel_request(id, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('ยกเลิกรายการเสร็จเรียบร้อยแล้ว');
                    request.get_request_list();
                }
            });
        }

    });

    $(document).on('click', 'a[data-name="btn_confirm"]', function(e){
        if(confirm('ต้องการยืนยัน (รับเรื่อง) รายการนี้ใช่หรือไม่?'))
        {
            var id = $(this).data('id');
            request.ajax.confirm_request(id, function(err){
                if(err)
                {
                    App.alert(err);
                }
                else
                {
                    App.alert('ยืนยันรายการเรียบร้อยแล้ว');
                    request.get_request_list();
                }
            });
        }

    });

    $('#btn_request_search').on('click', function(e){

        var query = $('#txt_request_query').val();
        $('#main_paging').fadeOut('slow');
        if(!query)
        {
            //App.alert('กรุณาระบุรหัสร้องขอ (Request number)');
            request.get_request_list();
        }
        else
        {
            $('#tbl_request_list tbody').empty();
            request.ajax.search_request(query, function(err, data){
                if(err)
                {
                    $('#tbl_request_list tbody').append(
                        '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                    );
                }
                else
                {
                    $('#main_paing').fadeOut('slow');
                    request.set_request_list(data);
                }
            });
        }

        e.preventDefault();
    });

    $(document).on('click', 'a[data-name="btn_get_status"]', function(e){
        var status = $(this).data('status');

        if(status == '-2')
        {
            request.get_request_list()
        }
        else
        {
            request.get_request_status_list(status);
        }

        e.preventDefault();
    });

    request.get_request_list();
});
