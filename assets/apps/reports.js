$(function(){
   var report = {};
   
   report.ajax = {
       get_total_by_customer: function(cb){
           var url = '/reports/get_total_by_customer',
               params = {};

           App.ajax(url, params, function(err, data){
               err ? cb(err) : cb(null, data);
           });
       },
       get_total_by_customer_date: function(s, e, cb){
           var url = '/reports/get_total_by_customer_date',
               params = {
                   s: s,
                   e: e
               };

           App.ajax(url, params, function(err, data){
               err ? cb(err) : cb(null, data);
           });
       },

       get_total_by_product: function(cb){
           var url = '/reports/get_total_by_product',
               params = {};

           App.ajax(url, params, function(err, data){
               err ? cb(err) : cb(null, data);
           });
       },
       get_total_by_product_date: function(s, e, cb){
           var url = '/reports/get_total_by_product_date',
               params = {
                   s: s,
                   e: e
               };

           App.ajax(url, params, function(err, data){
               err ? cb(err) : cb(null, data);
           });
       },
       get_service_total: function(cb){
            var url = '/reports/get_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        
        get_status_total: function(cb){
            var url = '/reports/get_status_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        
        get_status_total_by_date: function(s, e, cb){
            var url = '/reports/get_status_total_by_date',
                params = {
                    s: s,
                    e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        
        get_service_total_by_date: function(s, e, cb){
            var url = '/reports/get_total_by_date',
                params = {
                    s: s,
                    e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
        
   };

    report.chart = {};

    report.chart.get_tech_total = function(data){
        var options = {
            credits : {
                enabled : false
            },
            chart: {
                renderTo: 'graph_tech',
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
            }
             ,
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
            options.xAxis.categories.push(v.user_code);
            options.series[0].data.push(parseFloat(v.total));
        });

        new Highcharts.Chart(options);
    };

    report.chart.get_customer_total = function(data){
        var options = {
            credits : {
                enabled : false
            },
            chart: {
                renderTo: 'graph_customer',
                type: 'column'
            },

            title: {
                text: 'สถิติการรับบริการของหน่วยงาน/ลูกค้า'
            },
            subtitle: {
                text: 'จำนวนการใช้บริการ'
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
                    text: 'ครั้ง'
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
            }
             ,
            tootip: {
                formatter: function(){
                    return this.x + ": " + this.y + " ครั้ง";
                }
            },

            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },

            series: [{
                name: 'ครั้ง',
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
            options.xAxis.categories.push(v.code);
            options.series[0].data.push(parseFloat(v.t));
        });

        new Highcharts.Chart(options);
    };

    report.chart.get_product_total = function(data){
        var options = {
            credits : {
                enabled : false
            },
            chart: {
                renderTo: 'graph_product',
                type: 'column'
            },

            title: {
                text: 'รายการสินค้าที่มีการซ่อมบ่อยที่สุด'
            },
            subtitle: {
                text: 'จำนวนการใช้บริการ'
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
                    text: 'ครั้ง'
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
            }
             ,
            tootip: {
                formatter: function(){
                    return this.x + ": " + this.y + " ครั้ง";
                }
            },

            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },

            series: [{
                name: 'ครั้ง',
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
            options.xAxis.categories.push(v.code);
            options.series[0].data.push(parseFloat(v.t));
        });

        new Highcharts.Chart(options);
    };

    report.chart.get_status_total = function(data){
        var options = {
            credits : {
                enabled : false
            },
            chart: {
                renderTo: 'graph_status',
//                type: 'column',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },

            title: {
                text: 'สถิติการให้บริการแยกตามสถานะซ่อม'
            },
            subtitle: {
                text: 'ข้อมูลการให้บริการของช่าง'
            },
/*
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
            },*/
            tootip: {
                formatter: function(){
                    return this.x + ": " + this.y + " รายการ";
                }
            },

            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
/*                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }*/
            },

            series: [{
                type: 'pie',
                name: 'Browser share',
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
        var arr = [];
        _.each(data.rows, function(v){
            options.series[0].data.push([v.status_name, v.total]);
        });
        new Highcharts.Chart(options);
    };


    report.get_total_by_customer = function()
    {
        report.ajax.get_total_by_customer(function(err, data){
            $('#tbl_customer_service_count > tbody').empty();

            if(err)
            {
                App.alert(err);
                $('#tbl_customer_service_count > tbody').append('<tr><td colspan="3">ไม่พบรายการ</td></tr>');
            }
            else
            {
                report.chart.get_customer_total(data);

                _.each(data.rows, function(v){
                    $('#tbl_customer_service_count > tbody').append(
                        '<tr>' +
                            '<td>'+ v.code +'</td>' +
                            '<td>'+ v.name +'</td>' +
                            '<td>'+ addCommasNoDecimal(v.t) +'</td>' +
                            '<tr>'
                    );
                });
            }
        });
    };

    report.get_total_by_product = function()
    {
        report.ajax.get_total_by_product(function(err, data){
            $('#tbl_product_service_count > tbody').empty();

            if(err)
            {
                App.alert(err);
                $('#tbl_product_service_count > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
            }
            else
            {
                if(!data.rows)
                {
                    App.alert('ไม่พบรายการ');
                    $('#tbl_product_service_count > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
                }
                else
                {
                    report.chart.get_product_total(data);

                    _.each(data.rows, function(v){
                        $('#tbl_product_service_count > tbody').append(
                            '<tr>' +
                                '<td>'+ v.code +'</td>' +
                                '<td>'+ v.type_name +'</td>' +
                                '<td>'+ v.brand_name +'</td>' +
                                '<td>'+ v.model_name +'</td>' +
                                '<td>'+ addCommasNoDecimal(v.t) +'</td>' +
                                '<tr>'
                        );
                    });

                }
            }
        });
    };

    report.get_total_by_customer_date = function(s, e)
    {
        report.ajax.get_total_by_customer_date(s, e, function(err, data){
            $('#tbl_customer_service_count > tbody').empty();

            if(err)
            {
                App.alert(err);
                $('#tbl_customer_service_count > tbody').append('<tr><td colspan="3">ไม่พบรายการ</td></tr>');
            }
            else
            {
                if(!data.rows)
                {
                    App.alert('ไม่พบรายการ');
                    $('#tbl_customer_service_count > tbody').append('<tr><td colspan="3">ไม่พบรายการ</td></tr>');
                }
                else
                {
                    report.chart.get_customer_total(data);

                    _.each(data.rows, function(v){
                        $('#tbl_customer_service_count > tbody').append(
                            '<tr>' +
                                '<td>'+ v.code +'</td>' +
                                '<td>'+ v.name +'</td>' +
                                '<td>'+ addCommasNoDecimal(v.t) +'</td>' +
                                '<tr>'
                        );
                    });
                }

            }
        });
    };

    report.get_total_by_product_date = function(s, e)
    {
        report.ajax.get_total_by_product_date(s, e, function(err, data){
            $('#tbl_product_service_count > tbody').empty();

            if(err)
            {
                App.alert(err);
                $('#tbl_product_service_count > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
            }
            else
            {
                if(!data.rows)
                {
                    App.alert('ไม่พบรายการ');
                    $('#tbl_product_service_count > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
                }
                else
                {
                    report.chart.get_product_total(data);

                    _.each(data.rows, function(v){
                        $('#tbl_product_service_count > tbody').append(
                            '<tr>' +
                                '<td>'+ v.code +'</td>' +
                                '<td>'+ v.type_name +'</td>' +
                                '<td>'+ v.brand_name +'</td>' +
                                '<td>'+ v.model_name +'</td>' +
                                '<td>'+ addCommasNoDecimal(v.t) +'</td>' +
                                '<tr>'
                        );
                    });
                }

            }
        });
    };

   report.get_service_total = function(){
       report.ajax.get_service_total(function(err, data){
           
            $('#tbl_tech_service_count > tbody').empty();
           if(err){
               $('#tbl_tech_service_count > tbody').append(
                   '<tr><td colspan="3">ไม่พบข้อมูล</td></tr>'
               );
           }else{

               report.chart.get_tech_total(data);

               _.each(data.rows, function(v){

                   $('#tbl_tech_service_count > tbody').append(
                       '<tr>' +
                           '<td> ' + v.user_code + '</td>' +
                           '<td> ' + v.fullname + '</td>' +
                           '<td>'+ v.total +'</td>' +
                           '</tr>'
                   );
               });
           } 
       });
   };
 
   
   report.get_service_total_by_date = function(s, e){
       report.ajax.get_service_total_by_date(s, e, function(err, data){
           
           //report.render_chart_tech(data);
           
            $('#tbl_tech_service_count > tbody').empty();
           if(err){
               $('#tbl_tech_service_count > tbody').append(
                   '<tr><td colspan="3">ไม่พบข้อมูล</td></tr>'
               );
           }else{

               report.chart.get_tech_total(data);

               _.each(data.rows, function(v){
                   
                  $('#tbl_tech_service_count > tbody').append(
                       '<tr>' +
                       '<td> ' + v.user_code + '</td>' +
                       '<td> ' + v.fullname + '</td>' +
                       '<td>'+ v.total +'</td>' +
                       '</tr>'
                   ); 
               });
           } 
       });
   };

   
   report.get_status_total_by_date = function(s, e){
        report.ajax.get_status_total_by_date(s, e, function(err, data){
            //chart
            $('#tbl_status_count > tbody').empty();
           if(err){
               $('#tbl_status_count > tbody').append(
                   '<tr><td colspan="2">ไม่พบข้อมูล</td></tr>'
               );
           }else{

               report.chart.get_status_total(data);

               _.each(data.rows, function(v){
                   $('#tbl_status_count > tbody').append(
                       '<tr><td>'+ v.status_name +'</td><td>'+ v.total +'</td></tr>'
                   );
               });
           } 
       });
   };


   report.get_status_total = function(){
       report.ajax.get_status_total(function(err, data){
            $('#tbl_status_count > tbody').empty();
           if(err){
               $('#tbl_status_count > tbody').append(
                   '<tr><td colspan="4">ไม่พบข้อมูล</td></tr>'
               );
           }else{
               report.chart.get_status_total(data);

               _.each(data.rows, function(v){
                   $('#tbl_status_count > tbody').append(
                       '<tr><td>'+ v.status_name +'</td><td>'+ v.total +'</td></tr>'
                   );
               });
           } 
       });
   };
   
   $('#btn_rpt_tech_get').click(function(){
       var  s = $('#txt_rpt_tech_sdate').val(),
            e = $('#txt_rpt_tech_edate').val();
       
       if(!s || !e){
           App.alert('กรุณาระบุวันที่ เพื่อแสดงข้อมูล');
       }else{
           report.get_service_total_by_date(s, e);
       }
   });

   $('#btn_rpt_customer_get').click(function(){
       var  s = $('#txt_rpt_customer_sdate').val(),
            e = $('#txt_rpt_customer_edate').val();

       if(!s || !e){
           App.alert('กรุณาระบุวันที่ เพื่อแสดงข้อมูล');
       }else{
            report.get_total_by_customer_date(s, e);
       }
   });
   $('#btn_rpt_product_get').click(function(){
       var  s = $('#txt_rpt_product_sdate').val(),
            e = $('#txt_rpt_product_edate').val();

       if(!s || !e){
           App.alert('กรุณาระบุวันที่ เพื่อแสดงข้อมูล');
       }else{
            report.get_total_by_product_date(s, e);
       }
   });

     
   $('#btn_rpt_status_get').click(function(){
       var  s = $('#txt_rpt_status_sdate').val(),
            e = $('#txt_rpt_status_edate').val();
       
       if(!s || !e){
           App.alert('กรุณาระบุวันที่ เพื่อแสดงข้อมูล');
       }else{
           report.get_status_total_by_date(s, e);
       }
   });

   report.get_total_by_customer();
   report.get_total_by_product();
   report.get_status_total();
   report.get_service_total();
   
});
