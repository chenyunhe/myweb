<?php

/**
 * php文件处理类 例子
 *SplFileInfo
 */
class batchRename
{
    public $serverCfg = array();

	/**
	 * @var string
	 *
	 * format: zid	uid	name (2017613,pl7613)
	 */
	public $plat = '';

	public function run(){
		$plat = $_SERVER['argv'][1];
		if(empty($plat)){
			return false;
		}
		$this->plat = $plat;
		
		$fileName = "data/".$this->plat."/".$this->plat."_user.txt";
		$this->setConfig();
		$file = new SplFileInfo($fileName);
		$fileInfo = $file->openFile('r');
		while (!$fileInfo->eof()) {
			$line =  trim($fileInfo->fgets());
			$data = explode(",", $line);
			if (count($data) == 2){	
				$uid = $data[0];
				$zid = $this->getzid($data[0]);
				$nickname = $data[1];
				$this->to_edit($uid,$zid,$nickname);
			}
		}
	}

	public function getzid($uid){
		$zoneid =intval($uid/1000000);
		if(isset($this->getzonied)) {
			if(isset($this->getzonied[$zoneid])){
				$zoneid = $this->getzonied[$zoneid];
			}
		}

		return $zoneid;
	}

	public function setConfig(){
		include "data/".$this->plat."/".$this->plat."gameserver_config.php";
		$this->serverCfg = $config['servers'];
		$this->getzonied = (is_array($config['getzonied'])) ? $config['getzonied'] : array() ;
	}

	public function to_edit($uid,$zid,$nickname){
		$cmd = array(
				'zoneid' => intval($zid),
				'secret' => $this->serverCfg[$zid]['secret'],
				'uid' => intval($uid),
				'cmd' => 'admin.setnames.reuname',
				'params' => array(
						'nickname' => $nickname,
				),
		);

		$host = $this->serverCfg[$zid]['host'];
		$port = $this->serverCfg[$zid]['port'];

		if ($host && $port){
			$r = json_decode($this->send_gameserver($host, $port, $cmd),true);
			if(!is_array($r) || $r['ret']!=0){
			   $this->writeError($uid,$nickname); 
			}
			
		}else{
			$this->writeError($uid,$nickname); 
			echo "error:{$zid},{$uid} config error";
		}

		echo "\n";
	}

	public function writeError($uid,$nickname){
		$errorpath='error/';
		if(!is_dir($errorpath))
		{
			mkdir($errorpath,0777);
		}
        $errorpath = $errorpath.'/user';
		if(!is_dir($errorpath))
		{
			mkdir($errorpath,0777);
		}

		$filename=$errorpath.'/'.$this->plat.".txt";
		$handle=fopen($filename,"a+");
		fwrite($handle,$uid.",".$nickname."\r\n");
		fclose($handle);
	}

	public function send_gameserver($host, $port, $request)
	{
		$fp = fsockopen($host, $port);

		if (!$fp) {
			return false;
		}

		$request = json_encode($request);

		$nwrite = fputs($fp, "1 $request\r\n");
		$len = 1024;
		$result = fread($fp, $len);
		$binary = substr($result, 1, 3);
		$header = unpack("v", $binary);

		$result_len = strlen($result);

		if (isset($header [1])) {
			do {
				$next_len = $header [1] - $result_len;
				if ($next_len > 0) {
					$next_len = $next_len > $len ? $len : $next_len;
					$result .= fread($fp, $next_len);
					$result_len += $next_len;
				}
			} while ($header [1] - $result_len > 0);
		}

		if (strlen($result) > 5) {
			$result = substr($result, 5);
		}

		fclose($fp);

		return $result;
	}
}


$class = new batchRename();
$class->run();

//10，35，43，51，112，119
