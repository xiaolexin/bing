<?php
namespace app\index\controller;
header('content-type:text/html;charset=utf-8');
use think\Controller;
use think\Model;
class Api extends Controller{

		function _initialize()
	    {
	        parent::_initialize();
	        $this->model = model('bing');
	        $this->api_model=model('api');
	        $this->qiniu_model=model('qiniu');
	    }

		function create_data(){
			//查询今日的数据是否生成
			$res=$this->model->find_one();
			if($res){
				exit('今日数据已生成！感谢您的访问');
			}
			$data=$this->api_model->get_data();
			if($data){ 
				//保存图片到七牛云
				$result=$this->qiniu_model->upload($data['img_url']);
				if($result['err']!=1){
					//保存数据到数据库
					$data['img_url']=$result['data'];
					$rres=$this->model->insertOne($data);
					if($rres){print_r(date('Ymd').'数据写入成功！');}else{print_r('数据写入失败');}
				}else{
					print_r('七牛云保存失败');
				}
			}else{
				print_r('接口数据获取失败');
			}
		}
	
}