<?php
namespace Yaoshanliang\PhpSms;
use Toplan\PhpSms\Agent;

class ChuanglanAgent extends Agent {
    //override
    //发送短信一级入口
    public function sendSms($tempId, $to, array $tempData, $content)
    {
       //在这个方法中调用二级入口
       //根据你使用的服务商的接口选择调用哪个方式发送短信
       $this->sendContentSms($to, $content);
       // $this->sendTemplateSms($tempId, $to, $tempData);
    }

    //override
    //发送短信二级入口：发送内容短信
    public function sendContentSms($to, $content)
    {
        $url = 'http://222.73.117.158/msg/HttpBatchSendSM';

        //创蓝接口参数
        $params = array (
            'account' => $this->apiAccount,
            'pswd' => $this->apiPassword,
            'msg' => $content,
            'mobile' => $to,
            'needstatus' => true,
            'product' => '',
            'extno' => ''
        );

        //可用方法:
        $result = $this->curlPost($url, $params);
        $result = preg_split("/[,\r\n]/", $result);

        //切记更新发送结果
        if (0 == $result[1]) {
            $this->result('success', true);//是否发送成功
        } else {
            $this->result('success', false);//是否发送成功
        }
        $this->result('info', '');//发送结果信息说明
        $this->result('code', $result[1]);//发送结果代码
    }

    //override
    //发送短信二级入口：发送模板短信
    public function sendTemplateSms($tempId, $to, array $tempData)
    {
        //同上...
    }

    //override
    //发送语音验证码入口
    public function voiceVerify($to, $code)
    {
        //同上...
    }

    private function curlPost($url,$postFields)
    {
        $postFields = http_build_query($postFields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
