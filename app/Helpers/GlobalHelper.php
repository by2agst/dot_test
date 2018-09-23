<?php
if (!function_exists('custom_curl')) {
	function custom_curl($url, $headers = array('cache-control: no-cache'), $post = array(), $timeout = 180,  $encode = ''){
		$regex      = '.+:([0-9]{2,5})?.+';
		preg_match('/^'.$regex.'/', $url, $xurl);
		$port       = @$xurl[1]; 
		$default    = ini_get('max_execution_time');
		$start_exec = microtime(true);
		
		$custom_req = $post ? 'POST' : 'GET';

		$curl = curl_init();

		$opt = array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => $encode,
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => $timeout,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => $custom_req,
			CURLOPT_HTTPHEADER     => $headers,
		);

		if($port){
			$opt[CURLOPT_PORT] = $port;
		}

		if($post){
			$opt[CURLOPT_POSTFIELDS] = http_build_query($post);
		}

		curl_setopt_array($curl, $opt);

		$response = curl_exec($curl);
		$error = curl_error($curl);

		curl_close($curl);

		$exec_time = microtime(true) - $start_exec;
		set_time_limit($default);

		return compact('exec_time', 'response', 'error');
	}
}
?>