<?php
namespace Cls;

class Request{

	public $Method;
	public $Uri;

	public $FormatedParameters;
	public $FormatedHeaders=[];
	public $SignTime;

	public function __construct($Method,$Uri,$FormatedParameters=[],$ContentType='application/json'){
		$this->Method=$Method;
		$this->Uri=$Uri;
		$this->FormatedParameters=$FormatedParameters;
		if($Method=='post'||$Method=='put'){
			$body=json_encode($FormatedParameters);
			$this->FormatedHeaders=['Content-Type'=>$ContentType,'Content-MD5'=>md5($body)];
		}
	}

	public function getMethod(){
		return $this->Method;
	}

	public function getUri(){
		return $this->Uri;
	}

	public function getFormatedParameters(){
		return $this->FormatedParameters;
	}

	public function getFormatedHeaders(){
		return $this->FormatedHeaders;
	}

	public function setSignTime($SignTime){
		$this->SignTime=$SignTime;
	}

	public function getSignTime(){
		return $this->SignTime;
	}

}