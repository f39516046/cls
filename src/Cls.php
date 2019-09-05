<?php
namespace Cls;

class Cls{

	public $SecretId;
	public $SecretKey;
	public $Host;

	//FormatedParameters 参数以数组形式表达 FormatedHeaders也以参数形式表达
	public function getSignContent($params,$signType = "sha1") {
		//仅get有url参数
		if($params['Method']!='get'){
			$params['FormatedParameters']=[];
		}
	    ksort($params['FormatedParameters']);
	    $params['FormatedParameters']=array_change_key_case($params['FormatedParameters'],CASE_LOWER);
	    $url_param_list=implode(';', array_keys($params['FormatedParameters']));
	    $params['FormatedParameters']=http_build_query($params['FormatedParameters']);
	    $params['FormatedHeaders']=array_merge($params['FormatedHeaders'],['Host'=>$this->Host]);//HOST为必填header
	    ksort($params['FormatedHeaders']);
	    $params['FormatedHeaders']=array_change_key_case($params['FormatedHeaders'],CASE_LOWER);
	    $header_list=implode(';', array_keys($params['FormatedHeaders']));
	    $params['FormatedHeaders']=http_build_query($params['FormatedHeaders']);
		$HttpRequestInfo =$params['Method']."\n".$params['Uri']."\n".$params['FormatedParameters']."\n".$params['FormatedHeaders']."\n";
	    $StringToSign=$signType."\n".$params['signTime']."\n".sha1($HttpRequestInfo)."\n";
	    $SignKey=hash_hmac('sha1', $params['signTime'], $this->SecretKey);
	    $sign=hash_hmac('sha1', $StringToSign, $SignKey);
	    return "q-sign-algorithm={$signType}&q-ak={$this->SecretId}&q-sign-time={$params['signTime']}&q-key-time={$params['signTime']}&q-header-list={$header_list}&q-url-param-list={$url_param_list}&q-signature={$sign}";
	}

	//不对参数及header加密
	public function getBaseSignContent($params,$signType = "sha1") {
		$HttpRequestInfo =$params['Method']."\n".$params['Uri']."\n"."\n"."\n";
	    $StringToSign=$signType."\n".$params['signTime']."\n".sha1($HttpRequestInfo)."\n";
	    $SignKey=hash_hmac('sha1', $params['signTime'], $this->SecretKey);
	    $sign=hash_hmac('sha1', $StringToSign, $SignKey);
	    return "q-sign-algorithm={$signType}&q-ak={$this->SecretId}&q-sign-time={$params['signTime']}&q-key-time={$params['signTime']}&q-header-list=&q-url-param-list=&q-signature={$sign}";
	}

	//执行方法
	public function execute($request,$Authorization){
		$request['FormatedHeaders']=array_merge($request['FormatedHeaders'],['Host'=>$this->Host]);
		$request['FormatedHeaders']=array_merge($request['FormatedHeaders'],['Authorization'=>$Authorization]);
		$url='http://'.$this->Host.$request['Uri'];
		$data=$request['FormatedParameters'];
		$method=$request['Method'];
		$headers=$request['FormatedHeaders'];
		$res=$this->saber_request($url,$data,$method,$headers);
		return $res;
	}

	protected function saber_request($url='',$data=[],$method='GET',$headers=[],$saber_options=[],$timeout=2){
	    $options['timeout']=$timeout;
	    $options['uri']=$url;
	    $options['method']=strtoupper($method);
	    $options['headers']=$headers;
	    if($options['method']=='GET'){
	      $options['uri_query']=$data;
	    }else{
	      if($headers['Content-Type']=='application/json'){
	        $options['json']=$data;
	      }else{
	        $options['data']=$data;
	      }
	    }
	    try{
	      $saber = \Swlib\Saber::create($saber_options)->request($options);
	      $res['http_code']=$saber->getStatusCode();
	      $res['content']=(string)$saber->getBody();
	      return $res;
	    }catch(\Exception $e){
	      $res['http_code']=0;
	      $res['content']=$e->getMessage();
	      return $res;
	    }
}

}