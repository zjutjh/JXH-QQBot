<?php
/**
 * getReqSign ：根据 接口请求参数 和 应用密钥 计算 请求签名
 * @param $params 接口请求参数（特别注意：不同的接口，参数对一般不一样，请以具体接口要求为准）
 * @param $appkey 应用密钥
 * @return string 签名结果
 */
function getReqSign($params /* 关联数组 */, $appkey /* 字符串*/)
{
    // 1. 字典升序排序
    ksort($params);

    // 2. 拼按URL键值对
    $str = '';
    foreach ($params as $key => $value) {
        if ($value !== '') {
            $str .= $key . '=' . urlencode($value) . '&';
        }
    }

    // 3. 拼接app_key
    $str .= 'app_key=' . $appkey;

    // 4. MD5运算+转换大写，得到请求签名
    $sign = strtoupper(md5($str));
    return $sign;
}
/**
 *  api json response
 * @param int $code 状态码
 * @param string $msg 状态信息
 * @param null $data 返回数据
 * @return JsonResponse
 */
function StandardJsonResponse($code, $msg = '', $data = null)
{
    $json = [
        'code' => $code,
        'msg' => $msg,
    ];

    if ($data !== null) {
        $json['data'] = $data;
    }
    return response()->json($json);
}

/**
 * 标准成功响应
 * @param null $data
 * @return JsonResponse
 */
function StandardSuccessJsonResponse($data = null)
{
    return StandardJsonResponse(1, "Success", $data);
}

/**
 * 标准失败响应
 * @param null $data
 * @return JsonResponse
 */
function StandardFailJsonResponse($data = null)
{
    return StandardJsonResponse(-1, "Fail", $data);
}

function issetDefNull($var){
    return isset($var)?$var:null;
}
