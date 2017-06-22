<?php
if ( ! function_exists('is_image')) {
    /**
     * 判断文件的MIME类型是否为图片
     */
    function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}

if ( ! function_exists('is_uuid')) {
    /**
     * 判断是不是uuid
     */
    function is_uuid($uuid)
    {
        return is_string($uuid) && (bool)preg_match('/^[a-f0-9]{8,8}-(?:[a-f0-9]{4,4}-){3,3}[a-f0-9]{12,12}$/i', $uuid);
    }
}

if ( ! function_exists('is_json')) {
    /**
     * 判断是不是json
     */
    function is_json($str)
    {
        return is_string($str) && !is_null(json_decode($str));
    }
}
