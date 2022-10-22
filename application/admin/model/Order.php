<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Order extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'registration_order';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'integer';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'publishtime_text',
        'state_text'
    ];
    

    
    public function getStateList()
    {
        return ['-1' => __('State -1'), '0' => __('State 0'), '1' => __('State 1'), '2' => __('State 2'), '3' => __('State 3')];
    }


    public function getPublishtimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['publishtime']) ? $data['publishtime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['state']) ? $data['state'] : '');
        $list = $this->getStateList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setPublishtimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }


    public function doctor()
    {
        return $this->belongsTo('app\admin\model\registration\Doctor', 'doctor_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }


    public function duty()
    {
        return $this->belongsTo('app\admin\model\registration\Duty', 'duty_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }


    public function number()
    {
        return $this->belongsTo('app\admin\model\registration\Number', 'number_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
