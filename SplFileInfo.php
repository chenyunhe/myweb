//php 文件处理类	
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
