<?php
/**
 * Created by PhpStorm.
 * User: ewei
 * Date: 2018/12/11
 * Time: 21:07
 */
namespace app\admin\validate;

use think\Validate;

class ArticleCategory extends Validate
{
    protected $rule = [
        'name' => 'require',
    ];

    protected $message = [
        'name.require' => '分类名称必填',
    ];
    protected $scene = [
        'add'   =>  ['name'],
        'edit'  =>  ['name'],
    ];
}

