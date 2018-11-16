<?php
namespace app\index\controller;
use think\Controller;
use think\Cookie;
use think\Session;
use think\Config;
class Index extends controller
{

	function _initialize()
    {
        parent::_initialize();
        $this->model = model('bing');
    }

    public function index()
    {
    	$bings=$this->model->get_list();
        if(@Session::get('date')!=date('Ymd')){
            Session::set('date',date('Ymd'));
            file_get_contents('https://api.neweb.top/index/api/create_data');
        }
    	return view('index/index',['bings'=>$bings['data'],'pages'=>$bings['pages']]);
    }

    public function view(){
        $date=input('date');
        $s=$this->model->select_one($date);

        return view('detail/view',['bings'=>$s]);
    }
    public function about(){

        return view('about/index');
    }

    
}
