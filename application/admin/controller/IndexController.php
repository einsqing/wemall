<?php
namespace app\admin\controller;
 
class IndexController extends BaseController
{
    public function index()
    {
    	cookie("prevUrl", request()->url());
        return view();
    }
}
