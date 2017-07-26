<?php 
  public function accessory($params=array()){
        $zids=get_cli_option('zids');
        $zidsarr=explode('_',$zids);

        if(count($zidsarr)<2) exit("zids error");
        for($i=$zidsarr[0];$i<=$zidsarr[1];$i++){
            $flag=$this->saveaccessory($i);
        }
         
         echo 'end';        
    }
    
    ## 符合条件的玩家数据写入文件
    public function saveaccessory($zid){

        $tarr=array(
            't1'=>array("a4","a8","a12","a16","a68"),
            't2'=>array("a20","a24","a28","a32","a76"),
            't3'=>array("a36","a40","a44","a48","84"),
            't4'=>array("a52","a56","a60","a64","a92"),
        );        

        $f=array(
            "f4","f8","f12","f16","f68",
            "f20","f24","f28","f32","f76",
            "f36","f40","f44","f48","84",
            "f52","f56","f60","f64","f92"
        );

        $setsql="select count(*) as total from accessory";
        $getresult=$this->getdata($zid,$setsql);
        $total=$getresult[0]['total'];
        $num=100;
        $totalpage=ceil($total/$num);
  
        if($totalpage>0){
            $dir = "{$this->dir}/accessory";
            File::mkdirs($dir);
            $filename = "{$dir}/{$zid}.txt";
            $handle =fopen($filename,"w");

            $keys=array("zid","uid","a4","a8","a12","a16","a68","a20","a24","a28","a32","a76","a36","a40","a44","a48","84",
            "a52","a56","a60","a64","a92","f4","f8","f12","f16","f68","f20","f24","f28","f32","f76","f36","f40","f44","f48",
            "f52","f56","f60","f64","f92","nickname","vip"
            );
            $str=fwrite($handle,implode("\t",array_values($keys))."\r\n");

            for($i=1;$i<=$totalpage;$i++){
                 $limit = ' LIMIT ' . ($i-1)*$num . ' , ' . $num;
                 $setsql="select uid,used,fragment from accessory order by uid asc $limit"; 
                 $getresult=$this->getdata($zid,$setsql);
                 if(is_array($getresult) && count($getresult)>0){
                    foreach($getresult as $k=>$v){
                        $newrow=array();
                        $newrow['zid']=$zid;
                        $newrow['uid']=$v['uid'];
                        
                        $used = (array)json_decode($v['used'],true);
                        $fragment = (array)json_decode($v['fragment'],true);
                        $flag=false;
                    
                        for($n=1;$n<=4;$n++){
                            for($p=1;$p<=5;$p++){
                                $acc=$tarr['t'.$n][$p-1];
                                $newrow[$acc]=0;
                                if($used['t'.$n]['p'.$p][0]==$acc){
                                    $newrow[$acc]=1;
                                     $flag=true;
                                }
                            }
                        }

                        foreach($f as $val){
                            $newrow[$val]=0;
                            if($fragment[$val]>0){
                                $newrow[$val]=$fragment[$val];
                                $flag=true;
                            }
                        }

                        if($flag){
                            $setsql="select nickname,vip from userinfo where uid={$v['uid']}";
                            $getresult=$this->getdata($zid,$setsql);
                            $newrow['nickname']=empty($getresult[0]['nickname']) ? 0 : $getresult[0]['nickname'] ;
                            $newrow['vip']=(int)$getresult[0]['vip'];

                            $str=fwrite($handle,implode("\t",array_values($newrow))."\r\n");
                        }
                    }
                }
            }

            fclose($handle); 
        }
    }
?>
