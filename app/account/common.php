<?php

// 这是系统自动生成的公共文件

/**
 * 方法用途描述
 * 描述：用于处理API访问时返回数组.
 *
 * @param $array 响应的数据
 *
 * @return [] 处理后返回对象
 * @date 2017年11月2日下午4:38:58
 */
function resultResponse($array)
{
    return [
        'code' => 200,
        'data' => $array['data'],
        'time' => $_SERVER['REQUEST_TIME'],
    ];
}
