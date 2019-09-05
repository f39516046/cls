<?php
namespace Cls;

class Logset{

	public $logset_id;
	public $logset_name;
	public $period;
	private $Uri='/logset';
	public $Method;
	private $FormatedParameters;
	public $FormatedHeaders=[];

	public function setLogsetParams(){
		$this->FormatedParameters=['logset_id'=>$this->logset_id,'logset_name'=>$this->logset_name,'period'=>$this->period];
		$this->FormatedParameters=array_filter($this->FormatedParameters);//过滤非必要参数
		if($this->Method=='post'||$this->Method=='put'){
			$body=json_encode($this->FormatedParameters);
			$this->FormatedHeaders=['Content-Type'=>'application/json','Content-MD5'=>md5($body)];
		}
		return ['Method'=>$this->Method,'Uri'=>$this->Uri,'FormatedParameters'=>$this->FormatedParameters,'FormatedHeaders'=>$this->FormatedHeaders];
	}

}