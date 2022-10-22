<?php

namespace app\admin\model;

use think\Model;


class Number extends Model
{

    

    

    // 表名
    protected $name = 'registration_number';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'dutyrange_text',
        'status_text'
    ];
    

    
    public function getDutyrangeList()
    {
        return ['0' => __('Dutyrange 0'), '1' => __('Dutyrange 1'), '2' => __('Dutyrange 2'), '3' => __('Dutyrange 3')];
    }

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }


    public function getDutyrangeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['dutyrange']) ? $data['dutyrange'] : '');
        $list = $this->getDutyrangeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
