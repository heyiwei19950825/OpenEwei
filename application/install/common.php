<?php
/**----------------------------------------------------------------------
 * EweiOpen V3
 * Copyright 2017-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/11/2
 * Time: 15:44
 * ----------------------------------------------------------------------
 */

// 判断文件或目录是否有写的权限
function is_really_writable($file)
{
    if (DIRECTORY_SEPARATOR == '/' and @ ini_get("safe_mode") == false) {
        return is_writable($file);
    }
    if (!is_file($file) or ($fp = @fopen($file, "r+")) === false) {
        return false;
    }

    fclose($fp);
    return true;
}