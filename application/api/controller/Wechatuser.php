<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Validate;
use fast\Random;

class Wechatuser extends Api
{
    /**
     * @var string[]   实例数量
     */
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['login'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];

    public function login(){

        $post = $this->request->post();

        //登录数据验证
        $rule = [
            'openid'  => 'require|length:10,30'
        ];

        $msg = [
            'openid.require' => '缺少openid',
            'openid.length' => 'openid长度不符合',
        ];

        $v = new Validate($rule,$msg);

        if (!$v->check($post)) {
            $this->error('登录失败：' . $v->getError());
        }

        $u = model('admin/User')->where('openid',$post["openid"])->find();
        if($u){
            //执行登录
            Token::clear($u["id"]);
            $this->auth->direct($u["id"]);
            $this->success('登录成功', $this->auth->getUserinfo());
        }
        else{
            //执行注册
            $username = $post["openid"];
            // 初始密码给一个随机数
            $password = Random::alnum(12);
            $this->auth->register($username,$password,'','',["openid"=>$post["openid"]
            ]);
            $this->success('注册成功', $this->auth->getUserinfo());
        }


    }
}