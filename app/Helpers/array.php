<?php
if (!function_exists('two_dimensional_array_unique')) {

    /**
     * 移除二维数组中指定键名重复的值
     *
     * @param  $array
     * @param  $key
     *
     * @return array
     */
    function two_dimensional_array_unique($array, $key)
    {
        $i = 0;
        $key_array = [];
        $temp_array = [];

        foreach ($array as $value) {
            if (!in_array($value[$key], $key_array)) {
                $key_array[$i] = $value[$key];
                $temp_array[$i] = $value;
            }
            $i++;
        }

        return $temp_array;
    }
}

if (!function_exists('array_random')) {

    /**
     * 随机返回数组中的值
     *
     * @param  $array
     *
     * @return mixed
     */
    function array_random($array)
    {
        return $array[array_rand($array)];
    }
}

if (!function_exists('two_dimensional_array_sort')) {

    /**
     * 二维数组排序
     *
     * @param  $array
     * @param  $on
     * @param  $order
     *
     * @return array
     */
    function two_dimensional_array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = [];
        $sortable_array = [];
        $on = (string)$on;
        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}
if (!function_exists('create_level_tree')) {

    /**
     * 生成一维数组 HTML 层级树
     *
     * @param        $data
     * @param int $parent_id
     * @param int $level
     * @param string $html
     *
     * @return array
     */
    function create_level_tree($data, $parent_id = 0, $level = 0, $html = '-')
    {
        $tree = [];
        foreach ($data as $item) {
            $item['html'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
            $item['html'] .= $level === 0 ? "" : '|';
            $item['html'] .= str_repeat($html, $level);

            if ($item['parent_id'] == $parent_id) {
                $tree[] = $item;
                $tree = array_merge($tree, create_level_tree($data, $item['id'], $level + 1));
            }
        }

        return $tree;
    }
}

if (!function_exists('create_node_tree')) {

    /**
     * 生成二维数组节点树
     *
     * @param        $data
     * @param int $parent_id
     * @param string $name
     *
     * @return array
     */
    function create_node_tree($data, $parent_id = 0, $name = 'child')
    {
        $tree = [];

        foreach ($data as $item) {
            if ($item['parent_id'] == $parent_id) {
                $item[$name] = create_node_tree($data, $item['id']);
                $tree[] = $item;
            }
        }

        return $tree;
    }
}

if (!function_exists('get_week_start_time_and_end_date')) {

    /**
     * 获取一个星期的开始(星期日)与结束(星期六)日期
     *
     * @return array
     */
    function get_week_start_time_and_end_date()
    {
        $day = date('w');
        $end = 6 - $day;
        $start = 6 - $end;
        $arr[] = date('Y-m-d 00:00:00', strtotime('now -' . $start . ' day'));
        $arr[] = date('Y-m-d 23:59:59', strtotime('now +' . $end . ' day'));

        return $arr;
    }
}

if (!function_exists('getParentsByChildId')) {
    /**
     * 根据子元素 ID 获取所有的父元素
     *
     * @param $data
     * @param $child_id
     *
     * @return array
     */
    function getParentsByChildId($data, $child_id)
    {
        $arr = [];
        foreach ($data as $item) {
            if ($data['id'] == $child_id) {
                $arr[] = $item;
                $arr = array_merge($arr, getParentsByChildId($data, $item['parent_id']));
            }
        }

        return $arr;
    }
}

if (!function_exists('getChildsByParentId')) {
    /**
     * 根据父元素 ID 获取所有的子元素
     *
     * @param $data
     * @param $parent_id
     *
     * @return array
     */
    function getChildsByParentId($data, $parent_id)
    {
        $arr = [];
        foreach ($data as $item) {
            if ($data['parent_id'] == $parent_id) {
                $arr[] = $item;
                $arr = array_merge($arr, getChildsByParentId($data, $item['parent_id']));
            }
        }

        return $arr;
    }
}


if (!function_exists('array_array_key_diff')) {
    /**
     * 比较数组中指定ID的值
     *
     * @param $data1
     * @param $data2
     *
     * @return array
     */
    function array_array_key_diff($data1, $data2, $key)
    {
        return array_udiff_uassoc($data1, $data2,
            function ($d1, $d2) use ($key) {
                if ($d1[$key] == $d2[$key]) {
                    return 0;
                }
                return 1;
            },
            function () {
                return 0;
            });
    }
}


if (!function_exists('get_tree_array')) {
    /**
     * 根据一位数组获取多级树状结构(不重复)
     * @param $arr 需要转换的数组
     * @param string $pid
     * @param array $sub
     * @return array
     */
    function get_tree_array($arr, $pid = '', $sub = array())
    {
        foreach ($arr as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $v['sub'] = get_tree_array($arr, $v['id'], $v);
                if ($pid === '') {
                    $sub[] = $v['sub'];
                } else {
                    $sub['sub'][] = $v['sub'];
                }
            }
        }
        return $sub;
    }
}


if (!function_exists('array_combine_keys')) {
    /**
     * 通过相同的键名组合成新的数组
     * @param $arr1 key list
     * @param $arr2 value list
     * @return array
     */
    function array_combine_keys($arr1, $arr2)
    {
        if (empty($arr1) || empty($arr2)) {
            return [];
        }
        $arr = [];
        foreach ($arr1 as $key => $value) {
            if (array_key_exists($key, $arr2)) {
                $arr[$value] = $arr2[$key];
            }
        }
        return $arr;
    }
}

if (!function_exists('array_combine_values')) {
    /**
     * 通过数组的值组成新的数组
     * @param $array
     * @param  key
     * @param  value
     * @param  group
     * @return array
     */
    function array_combine_values($array, $keyId, $valueId = null, $group_id = null)
    {
        if (empty($array)) {
            return $array;
        }
        $ret = [];
        foreach ($array as $key => $value) {
            $keyExist = array_key_exists($keyId, $value);
            $valExist = array_key_exists($valueId, $value);
            $groupExist = array_key_exists($group_id, $value);
            if ($keyExist && $valExist) {
                if ($groupExist) {
                    $ret[$value[$group_id]][$value[$keyId]] = $value[$valueId];
                } else {
                    $ret[$value[$keyId]] = $value[$valueId];
                }
            } elseif ($keyExist) {
                if ($groupExist) {
                    $ret[$value[$group_id]][$value[$keyId]] = array_diff_key($value, [$group_id => '', $keyId => '']);
                } else {
                    $ret[$value[$keyId]] = array_diff_key($value, [$keyId => '']);
                }
            }
        }
        return $ret;
    }
}


if (!function_exists('array_dimensions')) {
    /**
     * 查看数组的维度
     * @param $array
     * @return number
     */
    function array_dimensions($array)
    {
        if (empty($array)) {
            return 0;
        }

        if (is_array($array)) {
            foreach ($array as $value) {
                return array_dimensions($value) + 1;
            }
        }
        return 1;
    }
}

if (!function_exists('array_wipe_invalid')) {

    /**
     * 去除数组中无效的值 空 或者 null
     * @param $array
     * @return array
     */
    function array_wipe_invalid($array)
    {
        $foo = ["", null];
        return array_diff($array, $foo);
    }
}

if (!function_exists('array_merge_combine')) {

    /**
     * @param string|array $ex
     * @param array $array1
     * @param array $array2
     * @return array
     */
    function array_merge_combine($ex, array $array1, array $array2, callable $filter = null, $column = ['employee_name' => 'value'])
    {
        list($keys, $vals) = each($column);

        $rlt = [];
        if ($filter !== null) {
            foreach ($array1 as $key => $val) {
                if (array_key_exists($key, $array2)) {
                    if ($filter($val, $array2[$key])) {
                        $rlt[$key] = array_merge($val, $array2[$key]);
                    }
                } else {
                    if ($filter($val, null)) {
                        $val[$vals] = '';
                        $rlt[$key] = $val;
                    }
                }

            }
        } else {
            foreach ($array1 as $key => $val) {
                if (array_key_exists($key, $array2)) {
                    $rlt[$key] = array_merge($val, $array2[$key]);
                } else {
                    $val[$vals] = '';
                    $rlt[$key] = $val;
                }
            }
        }
        $rlt = array_combine(array_column($rlt, $keys), array_column($rlt, $vals));
        if ($ex !== null) {
            $ex = is_array($ex) ? $ex : ['id' => $ex];
            $rlt = array_merge($ex, $rlt);
        }

        return $rlt;
    }
}


if (!function_exists('array_wipe_null')) {

    /**
     * @param $data
     * @return mixed
     */
    function array_wipe_null($data)
    {
        foreach ($data as $k => &$v) {
            if (!is_array($v['value']) && !$v) {
                unset($data[$k]);
            } elseif (is_array($v['value']) && array_key_exists('id', $v['value'])) {
                if (!$v['value']['id']) {
                    unset($data[$k]);
                }
            } elseif (is_array($v['value']) && array_key_exists(0, $v['value'])) {
                if (!$v['value'][0]['id']) {
                    unset($data[$k]);
                }
            }
        }

        return $data;
    }

}

if ( ! function_exists('elements'))
{
    function elements($items, $array, $default = "")
    {
        $return = array();

        if ( ! is_array($items))
        {
            $items = array($items);
        }

        foreach ($items as $item)
        {
            if (isset($array[$item]))
            {
                $return[$item] = $array[$item];
            }
            else
            {
                $return[$item] = $default;
            }
        }

        return $return;
    }
}