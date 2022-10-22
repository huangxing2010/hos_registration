<?php

namespace app\api\controller;

use app\common\controller\Api;
use fast\Http;
use think\Validate;
use fast\Random;
use app\common\library\Token;

class Wechatuser extends Api
{
    /**
     * @var string[]   实例数量
     */
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['login','getopenid'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['islogin'];

    protected $AppID = "wx4d846284d7c948c7";
    protected $AppSecret = "3569c9a00f646dc56b2a3d3f737431ca";

    public function getopenid($code)
    {
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$this->AppID&secret=$this->AppSecret&js_code=$code&grant_type=authorization_code";
          $res = Http::get($url);
          $arry_res = json_decode($res,true);  //对象转数组


         // var_dump($arry_res["openid"]);
        //$this->error("aaaa",$arry_res);
          if($arry_res["openid"]){
                 $post = $this->request->post();
                 //var_dump($post);die();
                 //登录数据验证
                 $rule = [
                     'nickname'  => 'require|length:2,30'
                 ];

                 $msg = [
                     'nickname.require' => '缺少openid55',
                     'nickname.length' => 'openid长度不符合',
                 ];

                 $v = new Validate($rule,$msg);

                 if (!$v->check($post)) {
                     $this->error('登录失败：' . $v->getError());
                 }

                 $u = model('admin/User')->where('openid',$arry_res["openid"])->find();

                 if($u){
                     //执行登录
                     Token::clear($u["id"]);
                     $this->auth->direct($u["id"]);
                     $this->success('登录成功', $this->auth->getUserinfo());
                 }
                 else{
                     //执行注册
                     $username = $arry_res["openid"];
                     //var_dump($u);
                     // 初始密码给一个随机数
                     $password = Random::alnum(12);
                     $this->auth->register($username,$password,'','',[
                         "username"=>$post["nickname"],
                         "nickname"=>$post["nickname"],
                         "gender"=>$post["gender"] == 1?'0':'1',
                         "openid"=>$arry_res["openid"],
                     ]);
                     $this->success('注册成功', $this->auth->getUserinfo());
                 }
              $this->success('成功',$arry_res);
          }else{
              $this->error('失败',$arry_res);
          }

    }

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

    //测试登录状态
    public function islogin(){

        $this->success('登录成功', $this->auth->getUserinfo());
    }
}