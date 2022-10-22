define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'registration/order/index' + location.search,
                    add_url: 'registration/order/add',
                    edit_url: 'registration/order/edit',
                    del_url: 'registration/order/del',
                    multi_url: 'registration/order/multi',
                    import_url: 'registration/order/import',
                    table: 'registration_order',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'order_num', title: __('Order_num'), operate: 'LIKE'},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'memo', title: __('Memo'), operate: 'LIKE'},
                        {field: 'state', title: __('State'), searchList: {"-1":__('State -1'),"0":__('State 0'),"1":__('State 1'),"2":__('State 2'),"3":__('State 3')}, formatter: Table.api.formatter.normal},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        {field: 'doctor.name', title: __('Doctor.name'), operate: 'LIKE'},
                        {field: 'duty.dutydate', title: __('Duty.dutydate'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'duty.range', title: __('Duty.range')},
                        {field: 'number.start', title: __('number.start'), operate: 'LIKE'},
                        {field: 'number.finish', title: __('number.finish'), operate: 'LIKE'},
                        {field: 'number.dutyrange', title: __('Number.dutyrange')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        recyclebin: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    'dragsort_url': ''
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: 'registration/order/recyclebin' + location.search,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {
                            field: 'deletetime',
                            title: __('Deletetime'),
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {
                            field: 'operate',
                            width: '130px',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'Restore',
                                    text: __('Restore'),
                                    classname: 'btn btn-xs btn-info btn-ajax btn-restoreit',
                                    icon: 'fa fa-rotate-left',
                                    url: 'registration/order/restore',
                                    refresh: true
                                },
                                {
                                    name: 'Destroy',
                                    text: __('Destroy'),
                                    classname: 'btn btn-xs btn-danger btn-ajax btn-destroyit',
                                    icon: 'fa fa-times',
                                    url: 'registration/order/destroy',
                                    refresh: true
                                }
                            ],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },

        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
