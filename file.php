      if(!is_dir($this->dir))
			{
				mkdir($this->dir,0777);
			}   
            $date=date('Ymd');
            $backpath=$this->dir.$date;

            if(!is_dir($backpath))
			{
				mkdir($backpath,0777);
			}

			$backpath=$backpath."/".$plat;
			if(!is_dir($backpath))
			{
				mkdir($backpath,0777);
			}

			$filename=$backpath."/".$zid.".txt";
			$handle=fopen($filename,"a+");
      $row['test']='aaa';
      $str=fwrite($handle,serialize($row)."\r\n");
			fclose($handle);
