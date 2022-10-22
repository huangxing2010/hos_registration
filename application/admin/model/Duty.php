<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Duty extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'registration_duty';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'integer';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'range_text',
        'publishtime_text',
        'status_text'
    ];
    

    
    public function getRangeList()
    {
        return ['0' => __('Range 0'), '1' => __('Range 1'), '2' => __('Range 2'), '3' => __('Range 3')];
    }

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }


    public function getRangeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['range']) ? $data['range'] : '');
        $list = $this->getRangeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getPublishtimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['publishtime']) ? $data['publishtime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setPublishtimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


    public function doctor()
    {
        return $this->belongsTo('app\admin\model\registration\Doctor', 'doctor_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
