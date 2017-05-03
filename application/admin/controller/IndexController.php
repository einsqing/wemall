<?php
namespace app\admin\controller;
use think\helper\Time;
use app\common\model\User;
use app\common\model\Analysis;
class IndexController extends BaseController
{
    public function index()
    {
    	//今日用户
        $todayUser     = User::whereTime('created_at', 'today')->count();
        $this->assign("todayUser", $todayUser);
        //本周用户
        $weekUser      = User::whereTime('created_at', 'week')->count();
        $this->assign("weekUser", $weekUser);
        //本月用户
        $monthUser     = User::whereTime('created_at', 'month')->count();
        $this->assign("monthUser", $monthUser);
        //总用户
        $totalUser     = User::count();
        $this->assign("totalUser", $totalUser);

		$line_data = $this->getDateAnalysis();

		$newUserLine = array();
        foreach ($line_data as $key => $value) {
            $newUserLine[$key] = $value["registers"];
        }
        $this->assign("newUserLine", json_encode($newUserLine));


        $newsList = getHttpResponseGET('http://www.wemallshop.com/cms/index/news');

        $this->assign("newsList", json_decode($newsList,true));
        $this->assign("url", 'http://www.wemallshop.com/');

    	cookie("prevUrl", request()->url());
        return view();
    }

	public function getDateAnalysis(){
        $analysis = Analysis::whereTime('created_at', 'between', Time::dayToNow(18, true))
                  ->order('id desc')
                  ->select()
                  ->toArray();

        $date = array();
        for ($i = 18; $i >= 0; $i--) {
            array_push($date, date("Y-m-d", strtotime("-$i day")));
        }
        $this->assign("date", json_encode($date));

        $line_data = array();
        foreach ($date as $key => $value) {
            $line_data[$key] = array(
                "id" => "0",
                "orders" => "0",
                "trades" => "0",
                "registers" => "0",
                "users" => "0",
                "date" => "0",
            );
            foreach ($analysis as $k => $v) {
                if ($v["date"] == $value) {
                    $line_data[$key] = $v;
                }
            }
        }
        return $line_data;
	}




}
