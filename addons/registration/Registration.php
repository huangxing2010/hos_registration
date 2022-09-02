<?php

namespace addons\registration;

use app\common\library\Menu;
use think\Addons;

/**
 * 插件
 */
class Registration extends Addons
{


    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = [
            [
                'name'    => 'registration',
                'title'   => '预约挂号',
                'icon'    => 'fa fa-graduation-cap',
                'sublist' => [
                    [
                        "name"    => "registration/doctor",
                        "title"   => "医生管理",
                        'icon'    => 'fa fa-map-marker',
                        'sublist' => [
                            ["name" => "registration/doctor/index", "title" => "查看",],
                            ["name" => "registration/doctor/add", "title" => "添加"],
                            ["name" => "registration/doctor/edit", "title" => "编辑"],
                            ["name" => "registration/doctor/del", "title" => "删除"],
                            ["name" => "registration/doctor/multi", "title" => "批量更新"],
                        ]
                    ],
                    [
                        "name"    => "registration/department",
                        "title"   => "科室管理",
                        'icon'    => 'fa fa-photo',
                        'sublist' => [
                            ["name" => "registration/department/index", "title" => "查看",],
                            ["name" => "registration/department/add", "title" => "添加"],
                            ["name" => "registration/department/edit", "title" => "编辑"],
                            ["name" => "registration/department/del", "title" => "删除"],
                            ["name" => "registration/department/multi", "title" => "批量更新"],
                        ]
                    ],
                    [
                        "name"    => "registration/duty",
                        "title"   => "排班管理",
                        'icon'    => 'fa fa-braille',
                        'sublist' => [
                            ["name" => "registration/duty/index", "title" => "查看",],
                            ["name" => "registration/duty/add", "title" => "添加"],
                            ["name" => "registration/duty/edit", "title" => "编辑"],
                            ["name" => "registration/duty/del", "title" => "删除"],
                            ["name" => "registration/duty/multi", "title" => "批量更新"],


                        ]
                    ],
                    [
                        "name"    => "registration/sick",
                        "title"   => "患者管理",
                        'icon'    => 'fa fa-graduation-cap',
                        'sublist' => [
                            ["name" => "registration/sick/index", "title" => "查看",],
                            ["name" => "registration/sick/add", "title" => "添加"],
                            ["name" => "registration/sick/edit", "title" => "编辑"],
                            ["name" => "registration/sick/del", "title" => "删除"],
                            ["name" => "registration/sick/multi", "title" => "批量更新"],
                        ]
                    ],
                    [
                        "name"    => "registration/diagnose",
                        "title"   => "诊断情况",
                        'icon'    => 'fa fa-graduation-cap',
                        'sublist' => [
                            ["name" => "registration/diagnose/index", "title" => "查看",],
                            ["name" => "registration/diagnose/add", "title" => "添加"],
                            ["name" => "registration/diagnose/edit", "title" => "编辑"],
                            ["name" => "registration/diagnose/del", "title" => "删除"],
                            ["name" => "registration/diagnose/multi", "title" => "批量更新"],
                        ]
                    ],
                    [
                        "name"    => "registration/info",
                        "title"   => "挂号跟踪",
                        'icon'    => 'fa fa-graduation-cap',
                        'sublist' => [
                            ["name" => "registration/info/index", "title" => "查看",],
                            ["name" => "registration/info/add", "title" => "添加"],
                            ["name" => "registration/info/edit", "title" => "编辑"],
                            ["name" => "registration/info/del", "title" => "删除"],
                            ["name" => "registration/info/multi", "title" => "批量更新"],
                        ]
                    ]

                ]
            ]
        ];
        Menu::create($menu);
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        Menu::delete("registration");
        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {
        Menu::enable("registration");
        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {
        Menu::disable("registration");
        return true;
    }



}
