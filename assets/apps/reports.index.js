$(function(){

    var rpt = {};

    rpt.ajax = {
        get_total_by_customer: function(data, cb){
            var url = '/reports/get_total_by_customer',
                params = {
                    s: data.s,
                    e: data.e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_total: function(data, cb){
            var url = '/reports/get_total_success_by_date',
                params = {
                    s: data.s,
                    e: data.e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list_by_date: function(data, start, stop, cb){
            var url = '/reports/get_list_by_date',
                params = {
                    s: data.s,
                    e: data.e,
                    start: start,
                    stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list_by_date_total: function(data, cb){
            var url = '/reports/get_list_by_date_total',
                params = {
                    s: data.s,
                    e: data.e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_status_total: function(data, cb){
            var url = '/reports/get_status_total_by_date',
                params = {
                    s: data.s,
                    e: data.e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_technician: function(data, start, stop, cb){
            var url = '/reports/get_service_by_technician',
                params = {
                    s: data.s,
                    e: data.e,
                    start: start,
                    stop: stop,
                    user_code: data.user_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_technician_total: function(data, cb){
            var url = '/reports/get_service_by_technician_total',
                params = {
                    s: data.s,
                    e: data.e,
                    user_code: data.user_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_customer: function(data, start, stop, cb){
            var url = '/reports/get_service_by_customer',
                params = {
                    s: data.s,
                    e: data.e,
                    start: start,
                    stop: stop,
                    customer_code: data.customer_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_customer_total: function(data, cb){
            var url = '/reports/get_service_by_customer_total',
                params = {
                    s: data.s,
                    e: data.e,
                    customer_code: data.customer_code
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
    }


    rpt.get_total = function(data)
    {
        rpt.ajax.get_total(data, function(err, data){
            $('#tbl_mrpt_total > tbody').empty();

            if(err)
            {
                App.alert(err);
                $('#tbl_mrpt_total > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
            }
            else
            {
                var datax = {};

                datax.title = [], datax.success = [], datax.not_success = [];

                _.each(data.rows, function(v){
                    var total = parseInt(v.success) + parseInt(v.not_success);

                    $('#tbl_mrpt_total > tbody').append(
                        '<tr>' +
                            '<td>'+ v.user_code +'</td>' +
                            '<td>'+ v.fullname +'</td>' +
                            '<td>'+ v.success +'</td>' +
                            '<td>'+ v.not_success +'</td>' +
                            '<td>'+ total +'</td>' +
                            '<tr>'
                    );

                    datax.success.push(parseInt(v.success));
                    datax.not_success.push(parseInt(v.not_success));

                    datax.title.push(v.user_code);
                });

                rpt.chart.get_total(datax);
            }
        });
    };

    rpt.get_status_total = function(data)
    {
        rpt.ajax.get_status_total(data, function(err, data){
            $('#tbl_mrpt_total_status > tbody').empty();

            if(err)
            {
                App.alert(err);
                $('#tbl_mrpt_total_status > tbody').append('<tr><td colspan="2">ไม่พบรายการ</td></tr>');
            }
            else
            {
                _.each(data.rows, function(v){
                    $('#tbl_mrpt_total_status > tbody').append(
                        '<tr>' +
                            '<td>'+ v.status_name +'</td>' +
                            '<td>'+ v.total +'</td>' +
                            '<tr>'
                    );
                });

                rpt.chart.get_status_total(data);
            }
        });
    };

    rpt.chart = {};

    rpt.chart.get_status_total = function(data){
        var options = {
            chart: {
                renderTo: 'div_rpt_total_status',
                type: 'column'
            },

            title: {
                text: 'สถิติการให้บริการแยกตามสถานะซ่อม'
            },
            subtitle: {
                text: 'ข้อมูลการให้บริการของช่าง'
            },

            xAxis: {
                categories: [],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },

            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tootip: {
                formatter: function(){
                    return this.x + ": " + this.y + " รายการ";
                }
            },

            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },

            series: [{
                name: 'รายการ',
                data: []
            }],
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }

        };

        _.each(data.rows, function(v){
            options.xAxis.categories.push(v.status_name);
            options.series[0].data.push(parseFloat(v.total));
        });

        //console.log(options.series);
        new Highcharts.Chart(options);
    };

    rpt.chart.get_total = function(data){
        var options = {
            chart: {
                renderTo: 'div_rpt_total',
                type: 'column'
            },

            title: {
                text: 'สถิติการให้บริการ'
            },
            subtitle: {
                text: 'ข้อมูลการให้บริการของช่าง'
            },

            xAxis: {
                categories: [],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },

            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tootip: {
                formatter: function(){
                    return this.x + ": " + this.y + " รายการ";
                }
            },

            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },

            series: [],
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }

        };
        //options.xAxis.categories.push(data.types);
        options.series.push({name: 'จำหน่าย', data: data.success});
        options.series.push({name: 'ยังไม่จำหน่าย', data: data.not_success});

        _.each(data.title, function(v){
            options.xAxis.categories.push(v);
        });

        //console.log(options.series);
        new Highcharts.Chart(options);
    };

    $('#btn_mrpt_do_get').on('click', function(){
        var data = {};
        data.s = $('#txt_mrpt_date_s').val();
        data.e = $('#txt_mrpt_date_e').val();
        data.t = $('#sl_mrpt_type').val();

        if(!data.s)
        {
            App.alert('กรุณาระบุวันที่เริ่มต้น');
        }
        else if(!data.e)
        {
            App.alert('กรุณาระบุวันที่สิ้นสุด');
        }
        else
        {
            rpt.get_total(data);
            rpt.get_status_total(data);
        }
    });

    $('#btn_get_service').on('click', function(){
        var data = {};
        data.s = $('#txt_service_list_s').val();
        data.e = $('#txt_service_list_e').val();

        if(!data.s)
        {
            App.alert('กรุณาระบุวันที่เริ่มต้น');
        }
        else if(!data.e)
        {
            App.alert('กรุณาระบุวันที่สิ้นสุด');
        }
        else
        {
            rpt.get_service_list(data);
        }
    });

    $('#btn_get_service_by_technician').on('click', function(){
        var data = {};
        data.s = $('#txt_service_list_by_tech_s').val();
        data.e = $('#txt_service_list_by_tech_e').val();
        data.user_code = $('#sl_technician_list').val();

        if(!data.s)
        {
            App.alert('กรุณาระบุวันที่เริ่มต้น');
        }
        else if(!data.e)
        {
            App.alert('กรุณาระบุวันที่สิ้นสุด');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุช่าง');
        }
        else
        {
            rpt.get_list_by_technician(data);
        }
    });

    $('#btn_print_service_by_technician').on('click', function(){
        var data = {};
        data.s = $('#txt_service_list_by_tech_s').val();
        data.e = $('#txt_service_list_by_tech_e').val();
        data.user_code = $('#sl_technician_list').val();

        if(!data.s)
        {
            App.alert('กรุณาระบุวันที่เริ่มต้น');
        }
        else if(!data.e)
        {
            App.alert('กรุณาระบุวันที่สิ้นสุด');
        }
        else if(!data.user_code)
        {
            App.alert('กรุณาระบุช่าง');
        }
        else
        {
            App.goto_url('/prints/technician_history/' + data.user_code + '/' + to_string_date(data.s) + '/' + to_string_date(data.e));
        }
    });

    $('#btn_print_service_list').on('click', function(){
        var data = {};
        data.s = $('#txt_service_list_s').val();
        data.e = $('#txt_service_list_e').val();
        if(!data.s)
        {
            App.alert('กรุณาระบุวันที่เริ่มต้น');
        }
        else if(!data.e)
        {
            App.alert('กรุณาระบุวันที่สิ้นสุด');
        }
        else
        {
            App.goto_url('/prints/service_list/' + to_string_date(data.s) + '/' + to_string_date(data.e));
        }
    });

    rpt.get_list_by_technician = function(items){
        rpt.ajax.get_service_by_technician_total(items, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging2').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        rpt.ajax.get_service_by_technician(items, this.slice[0], this.slice[1], function(err, data){
                            $('#tbl_service_list_by_technician tbody').empty();
                            rpt.set_list_by_technician(err, data);

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


    rpt.set_list_by_technician = function(err, data){
        $('#tbl_service_list_by_technician > tbody').empty();
        if(err){
            $('#tbl_service_list_by_technician > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    var disc = v.discharge_status == 'Y' ? '<i class="icon-ok"></i>' : '<i class="icon-minus"></i>';
                    $('#tbl_service_list_by_technician > tbody').append(
                        '<tr>' +
                            '<td>' + v.service_code + '</td>' +
                            '<td>' + v.date_serv + '</td>' +
                            '<td>' + v.product_code + '</td>' +
                            '<td>' + v.type_name + '</td>' +
                            '<td>' + v.brand_name + '</td>' +
                            '<td>' + v.model_name + '</td>' +
                            '<td>' + v.customer_name + '</td>' +
                            //'<td>' + v.technician_name + '</td>' +
                            '<td>' + disc + '</td>' +
                            '<td>' + v.service_status + '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_service_list_by_technician > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
            }
        }

    };

    rpt.set_service_list = function(err, data){
        $('#tbl_service_list > tbody').empty();
        if(err){
            $('#tbl_service_list_by_technician > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    var disc = v.discharge_status == 'Y' ? '<i class="icon-ok"></i>' : '<i class="icon-minus"></i>';
                    $('#tbl_service_list > tbody').append(
                        '<tr>' +
                            '<td>' + v.service_code + '</td>' +
                            '<td>' + v.date_serv + '</td>' +
                            '<td>' + v.product_code + '</td>' +
                            '<td>' + v.type_name + '</td>' +
                            '<td>' + v.brand_name + '</td>' +
                            '<td>' + v.model_name + '</td>' +
                            '<td>' + v.customer_name + '</td>' +
                            '<td>' + App.clear_null_value(v.technician_name) + '</td>' +
                            '<td>' + disc + '</td>' +
                            '<td>' + v.service_status + '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_service_list_by_technician > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
            }
        }

    };

    rpt.get_service_list = function(v){
        rpt.ajax.get_list_by_date_total(v, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        rpt.ajax.get_list_by_date(v, this.slice[0], this.slice[1], function(err, data){
                            rpt.set_service_list(err, data);
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


    rpt.get_list_by_customer = function(items){
        rpt.ajax.get_service_by_customer_total(items, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging3').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        rpt.ajax.get_service_by_customer(items, this.slice[0], this.slice[1], function(err, data){
                            $('#tbl_service_list_by_customer tbody').empty();
                            rpt.set_list_by_customer(err, data);

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

    rpt.set_list_by_customer = function(err, data){
        $('#tbl_service_list_by_customer > tbody').empty();
        if(err){
            $('#tbl_service_list_by_customer > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    var disc = v.discharge_status == 'Y' ? '<i class="icon-ok"></i>' : '<i class="icon-minus"></i>';
                    $('#tbl_service_list_by_customer > tbody').append(
                        '<tr>' +
                            '<td>' + v.service_code + '</td>' +
                            '<td>' + v.date_serv + '</td>' +
                            '<td>' + v.product_code + '</td>' +
                            '<td>' + v.type_name + '</td>' +
                            '<td>' + v.brand_name + '</td>' +
                            '<td>' + v.model_name + '</td>' +
                            '<td>' + v.customer_name + '</td>' +
                            //'<td>' + v.technician_name + '</td>' +
                            '<td>' + disc + '</td>' +
                            '<td>' + v.service_status + '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_service_list_by_customer > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
            }
        }

    };


    $('#btn_get_service_by_customer').on('click', function(){
        var data = {};
        data.s = $('#txt_service_list_by_customer_s').val();
        data.e = $('#txt_service_list_by_customer_e').val();
        data.customer_code = $('#sl_customers_list').val();

        if(!data.s)
        {
            App.alert('กรุณาระบุวันที่เริ่มต้น');
        }
        else if(!data.e)
        {
            App.alert('กรุณาระบุวันที่สิ้นสุด');
        }
        else if(!data.customer_code)
        {
            App.alert('กรุณาระบุชื่อหน่วยงาน');
        }
        else
        {
            rpt.get_list_by_customer(data);
        }
    });

    $('#btn_print_service_by_customer').on('click', function(){
        var data = {};
        data.s = $('#txt_service_list_by_customer_s').val();
        data.e = $('#txt_service_list_by_customer_e').val();
        data.customer_code = $('#sl_customers_list').val();

        if(!data.s)
        {
            App.alert('กรุณาระบุวันที่เริ่มต้น');
        }
        else if(!data.e)
        {
            App.alert('กรุณาระบุวันที่สิ้นสุด');
        }
        else if(!data.customer_code)
        {
            App.alert('กรุณาระบุช่าง');
        }
        else
        {
            App.goto_url('/prints/customer_history/' + data.customer_code + '/' + to_string_date(data.s) + '/' + to_string_date(data.e));
        }
    });

});