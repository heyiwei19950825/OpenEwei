<?php
/**
 * Created by PhpStorm.
 * User: ewei
 * Date: 2018/12/11
 * Time: 21:07
 */
namespace app\admin\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title' => 'require',
        'content' => 'require',
        'author' => 'require',
    ];

    protected $message = [
        'title.require' => '标题必填',
        'content.require' => '内容必填',
        'author.require' => '作者必填',
    ];
    protected $scene = [
        'add'   =>  ['title','content','author'],
        'edit'  =>  ['title','content','author'],
    ];
}
