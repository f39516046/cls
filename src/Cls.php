<?php
namespace Cls;

class Cls{

	public $SecretId;
	public $SecretKey;
	public $Host;

	//FormatedParameters 参数以数组形式表达 FormatedHeaders也以参数形式表达
	public function getSignContent($request,$SignType = "sha1") {
		$SignTime=$request->getSignTime();
		$FormatedParameters=$request->getFormatedParameters();
		$FormatedHeaders=$request->getFormatedHeaders();
		//仅get有url参数参与签名
		if($request->Method=='get'){
		    ksort($FormatedParameters);//序列化参数
		    $FormatedParameters=array_change_key_case($FormatedParameters,CASE_LOWER);
		    $url_param_list=implode(';', array_keys($FormatedParameters));
		    $FormatedParameters=http_build_query($FormatedParameters);
		}else{
			$FormatedParameters=[];
		}
	    $FormatedHeaders=array_merge($FormatedHeaders,['Host'=>$this->Host]);//HOST为必填header
	    ksort($FormatedHeaders);
	    $FormatedHeaders=array_change_key_case($FormatedHeaders,CASE_LOWER);
	    $header_list=implode(';', array_keys($FormatedHeaders));
	    $FormatedHeaders=http_build_query($FormatedHeaders);
		$HttpRequestInfo =$request->Method."\n".$request->Uri."\n".$FormatedParameters."\n".$FormatedHeaders."\n";
	    $StringToSign=$SignType."\n".$SignTime."\n".sha1($HttpRequestInfo)."\n";
	    $SignKey=hash_hmac('sha1', $SignTime, $this->SecretKey);
	    $sign=hash_hmac('sha1', $StringToSign, $SignKey);
	    return "q-sign-algorithm={$SignType}&q-ak={$this->SecretId}&q-sign-time={$SignTime}&q-key-time={$SignTime}&q-header-list={$header_list}&q-url-param-list={$url_param_list}&q-signature={$sign}";
	}

	//不对参数及header加密
	public function getBaseSignContent($request,$SignType = "sha1") {
		$SignTime=$request->getSignTime();
		$HttpRequestInfo =$request->Method."\n".$request->Uri."\n"."\n"."\n";
	    $StringToSign=$SignType."\n".$SignTime."\n".sha1($HttpRequestInfo)."\n";
	    $SignKey=hash_hmac('sha1', $SignTime, $this->SecretKey);
	    $sign=hash_hmac('sha1', $StringToSign, $SignKey);
	    return "q-sign-algorithm={$SignType}&q-ak={$this->SecretId}&q-sign-time={$SignTime}&q-key-time={$SignTime}&q-header-list=&q-url-param-list=&q-signature={$sign}";
	}

	//执行方法
	public function execute($request,$Authorization){
		$url='http://'.$this->Host.$request->Uri;
		$data=$request->getFormatedParameters();
		$Method=$request->getMethod();
		$FormatedHeaders=array_merge($request->FormatedHeaders,['Host'=>$this->Host,'Authorization'=>$Authorization]);
		$res=$this->saber_request($url,$data,$Method,$FormatedHeaders);
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