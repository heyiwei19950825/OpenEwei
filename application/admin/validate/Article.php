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
        'cid' => 'require|number',
        'title' => 'require',
        'content' => 'require',
        'author' => 'require',
    ];

    protected $message = [
        'cid.require' => '所属栏目不能为空必填',
        'title.require' => '标题必填',
        'content.require' => '内容必填',
        'author.require' => '作者必填',
    ];
    protected $scene = [
        'add'   =>  ['cid','title','content','author'],
        'edit'  =>  ['cid','title','content','author'],
    ];
}
