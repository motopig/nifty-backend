<?php


if (!function_exists('webCan')) {
    /**
     * 检查管理员是否有权限
     *
     * @param  string $permission 权限标识
     * @return bool
     */
    function webCan($permission)
    {
        return auth('web')->user()->iscan($permission);
    }
}


if (!function_exists('formatResponse')) {
    /**
     * 格式化返回数据格式
     *
     * @param  string $codeLang 状态码language
     * @param  string $msgLang 错误信息language或数组形式的数据
     * @param  array $data 当返回表示成功时，可以传此参数替换默认的文案
     * @return array  格式化后的数据
     *                成功示例：['respCode' => '0', 'respMsg' => '成功', 'data' => [...]]
     *                错误示例：['respCode' => '1', 'respMsg' => '失败']
     */
    function formatResponse($codeLang = 'suc', $msgLang = 'suc', $data = [])
    {
        $response = [
            'respCode' => trans('code.' . $codeLang),
            'respMsg' => trans('msg.' . $msgLang),
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return $response;
    }
}
