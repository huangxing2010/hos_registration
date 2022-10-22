define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'registration/number/index' + location.search,
                    add_url: 'registration/number/add',
                    edit_url: 'registration/number/edit',
                    del_url: 'registration/number/del',
                    multi_url: 'registration/number/multi',
                    import_url: 'registration/number/import',
                    table: 'registration_number',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'start', title: __('Start'), operate: 'LIKE'},
                        {field: 'finish', title: __('Finish'), operate: 'LIKE'},
                        {field: 'dutyrange', title: __('Dutyrange'), searchList: {"0":__('Dutyrange 0'),"1":__('Dutyrange 1'),"2":__('Dutyrange 2'),"3":__('Dutyrange 3')}, formatter: Table.api.formatter.normal},
                        {field: 'memo', title: __('Memo'), operate: 'LIKE'},
                        {field: 'status', title: __('Status'), searchList: {"normal":__('Normal'),"hidden":__('Hidden')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
