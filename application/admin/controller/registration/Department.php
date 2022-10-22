<?php

namespace app\admin\controller\registration;

use app\common\controller\Backend;
use fast\Tree;
use think\Cache;
use think\Db;
use think\exception\DbException;
use app\admin\model\AuthRule;
use think\exception\PDOException;
use think\exception\ValidateException;

/**
 * 科室门诊管理
 *
 * @icon fa fa-circle-o
 */
class Department extends Backend
{

    /**
     * Department模型对象
     * @var \app\admin\model\Department
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Department;

        //树形分类
        $tree = Tree::instance();
        $tree->init(collection($this->model->order('weigh desc')->select())->toArray(), 'pid');
        $this->categorylist = $tree->getTreeList($tree->getTreeArray(0), 'name');
        $categorydata = [0 => ['id' => '0', 'name' => __('None')]];
        foreach ($this->categorylist as $k => $v) {
            $categorydata[$v['id']] = $v;
        }
        $this->view->assign("parentList", $categorydata);

        $this->view->assign("statusList", $this->model->getStatusList());
    }

    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //构造父类select列表选项数据
            $list = $this->categorylist;
            $total = count($list);
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();

    }

    /**
     * 编辑
     *
     * @param $ids
     * @return string
     * @throws DbException
     * @throws \think\Exception
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds) && !in_array($row[$this->dataLimitField], $adminIds)) {
            $this->error(__('You have no permission'));
        }
        if (false === $this->request->isPost()) {
            $this->view->assign('row', $row);

        }

        if($this->request->isPost()){
            $params = $this->request->post('row/a');
            if($params){
                if ($params['pid'] == $row['id']) {
                    $this->error(__('Can not change the parent to self'));
                }
                if ($params['pid'] != $row['pid']) {
                    $childrenIds = Tree::instance()->init(collection(AuthRule::select())->toArray())->getChildrenIds($row['id']);
                    if (in_array($params['pid'], $childrenIds)) {
                        $this->error(__('Can not change the parent to child'));
                    }
                }

                //这里需要针对name做唯一验证
              /*  $ruleValidate = \think\Loader::validate('Department');
                $ruleValidate->rule([
                    'name' => 'require' . $row->id,
                ]);*/

                //return json($params); die();
                $result = $row->allowField(true)->save($params);
                if ($result === false) {
                    $this->error($row->getError());
                }
               // Cache::rm('__menu__');
                $this->success();

            }
            $this->error();

        }

        return $this->view->fetch();


    }

    /*public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }

        $this->view->assign('row', $row);

        if ($this->request->isPost()) {
           // $this->token();
            $params = $this->request->post("row/a", [], 'strip_tags');
            if ($params) {
                if (!$params['pid']) {
                    $this->error(__('The non-menu rule must have parent'));
                }
                if ($params['pid'] == $row['id']) {
                    $this->error(__('Can not change the parent to self'));
                }
                if ($params['pid'] != $row['pid']) {
                    $childrenIds = Tree::instance()->init(collection(AuthRule::select())->toArray())->getChildrenIds($row['id']);
                    if (in_array($params['pid'], $childrenIds)) {
                        $this->error(__('Can not change the parent to child'));
                    }
                }
                //这里需要针对name做唯一验证
                $ruleValidate = \think\Loader::validate('AuthRule');
                $ruleValidate->rule([
                    'name' => 'require|unique:AuthRule,name,' . $row->id,
                ]);
                $result = $row->validate()->save($params);
                if ($result === false) {
                    $this->error($row->getError());
                }
                Cache::rm('__menu__');
                $this->success();
            }
            $this->error();


            //$this->success();
        }



        return $this->view->fetch();

    }*/


    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


}
