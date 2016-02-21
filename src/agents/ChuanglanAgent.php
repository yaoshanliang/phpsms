<?php
namespace Yaoshanliang\PhpSms;

class ChuanglanAgent extends Agent {
    //override
    //发送短信一级入口
    public function sendSms($tempId, $to, array $tempData, $content)
    {
       //在这个方法中调用二级入口
       //根据你使用的服务商的接口选择调用哪个方式发送短信
       $this->sendContentSms($to, $content);
       $this->sendTemplateSms($tempId, $to, $tempData);
    }

    //override
    //发送短信二级入口：发送内容短信
    public function sendContentSms($to, $content)
    {
        //获取配置文件中的参数
        $key = $this->apikey;

        //可用方法:
        Agent::sockPost($url, $query);//fsockopen
        Agent::curl($url, array $params, bool $isPost);//curl

        //切记更新发送结果
        $this->result('success', true);//是否发送成功
        $this->result('info', $msg);//发送结果信息说明
        $this->result('code', $code);//发送结果代码
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
}
