<?php
/**
 * Created by PhpStorm.
 * User: mayunfeng
 * Date: 2017/12/12
 * Time: 21:42
 */

namespace common\library\upload;

use BaiduBce\BosProvide;
use yii\base\Exception;
use yii\web\UploadedFile;

class Upload
{

    const TOKEN = 'kwsemcom989'; //图片服务器Token

    const HOST_DEV = 'http://static.xiaolutuiguang.com/upload.php'; // 线上图片服务器

    const HOST_PRD = 'http://static.xiaolutuiguang.com/upload.php'; // 线上图片服务器


    public static function uploadImg(UploadedFile $uploadedFile)
    {

//        $bos = new BosProvide();
//        $name = date('YmdHis').rand(1000,9999);
//        return $bos->putObjectFromFile($name,$uploadedFile->tempName);

        $time = time();
        $curlFile = new \CURLFile($uploadedFile->tempName,$uploadedFile->type,$uploadedFile->name);
        $post = [
            'upload'=>$curlFile,
            'time'=>$time,
            "hash"=>md5($time."-".$uploadedFile->name."-".self::TOKEN),
            "fileName"=>$uploadedFile->name,
            'bucket' => 'look'
        ] ;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        //启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_URL, YII_DEBUG == true ? self::HOST_DEV : self::HOST_PRD);
        $info= curl_exec($ch);
        curl_close($ch);
        $info = json_decode($info,true);
        if ($info['errCode'] == 0) {
            return $info['url'];
        } else {
            throw new Exception($info['errMsg']);
        }
    }
}