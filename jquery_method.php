<?php
/**
 * Created by PhpStorm.
 * User: chenyunhe
 * Date: 2016/10/25
 * Time: 18:58
 * jquery两种请求方式
 */

/*
function jquerypost(){
    $.post("c_pay_list.php?action=tidan",{mailcontent:$('#mailcontent').val(),remark:$('#remark').val(),sendgold:$('#sendgold').val(),ischarge:$("input[name='ischarge']:checked").val(),bind:$("input[name='bind']:checked").val(),prop:$('#prop').val(),propnum:$('#propnum').val(),zone:$('#zone').val(),name:$('#uname').val(),openid:$('#openid').val(),billno:$('#billno').val()},
            function(data){
                msg = data['msg'];
                alert(msg);
                $('#tidanfm').form('clear');
                $('#dlg').dialog('close');
                $('#dg').datagrid('reload');
            },
            "json");//这里返回的类型有：json,html,xml,text
}

function jqpost(){
    $.post("opAllGameActivity.php?action=del",{zone1:minzone,zone2:maxzone,acttype2:acttypevalue,actid2:actidvalue,actstate2:3,stime:stime},function(data){alert(data);})
}


function jqueryget(){
    starttime = $('#starttime').val();
    endtime = $('#endtime').val();
    zone = $('#ZONE').val();
    openid = $('#ACC').val();
    name = $('#NAME').val();
    gs_user = $('#gs_user').val();

    $.get("c_achievements.php?action=gettotal&zone="+zone+"&openid="+openid+"&name="+name+"&gsuser="+gs_user+"&starttime="+starttime+"&endtime="+endtime,function(result) {

        $('#zonge').val(result);
    });
}

function ajax(f_NAME,f_ITEMGOT,f_MAILTITLE,zone)
{
    if(confirm("注意：确定？取消？"))
    {
        $.ajax(
        {
            type:'POST',
            url:'c_giftinfo.php?action=del&zone='+zone,
            data:{f_NAME:f_NAME,f_ITEMGOT:f_ITEMGOT,f_MAILTITLE:f_MAILTITLE},
            success:function()
            {
                $("#ht_id_search1").click();
            }
        });
        $("#ht_id_search1").click();
    }
}
*/

/*
 * php自动生成新密码自定义函数（带实例演示）
      适用环境： PHP5.2.x  / mysql 5.0.x
       代码作者： xujiajay www.jbxue.com
       联系方式： xujiaphp@gmail.com
* */
function genPassword($min = 5, $max = 8)
{
    $validchars="abcdefghijklmnopqrstuvwxyz123456789";
    $max_char=strlen($validchars)-1;
    $length=mt_rand($min,$max);
    $password = "";
    for($i=0;$i<$length;$i )
    {
        $password.=$validchars[mt_rand(0,$max_char)];
    }
    return $password;
}
echo "新密码：".genPassword()."";
echo "新密码：".genPassword(5,10)."
";
?>
