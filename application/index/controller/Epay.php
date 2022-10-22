<?php

namespace app\index\controller;

use app\common\controller\Frontend;

class Epay extends Frontend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        return $this->view->fetch();
    }

}