<?php
/**----------------------------------------------------------------------
 * OpenEwei V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/12/27
 * Time: 17:54
 * ----------------------------------------------------------------------
 */
namespace app\common\layout;

use app\common\controller\Base;
use think\Exception;

class Iframe extends Base
{

    protected $metaTitle; // 页面标题
    protected $tips; // 页面提示文字

    /**
     * @var array
     */
    public static $script = [];

    /**
     * @var array
     */
    public static $css = [];

    /**
     * @var array
     */
    public static $js = [];

    /**
     * @var array
     */
    public static $extensions = [];

    /**
     * @var Row[]
     */
    protected $rows = [];


    public function initialize() {
        parent::initialize();
    }

    /**
     * 设置页面标题
     * @param $title 标题文本
     * @return $this
     */
    public function setMetaTitle($meta_title) {
        $this->metaTitle = $meta_title;
        return $this;
    }

    /**
     * 设置页面说明
     * @param $title 标题文本
     * @return $this
     */
    public function setPageTips($content,$type='info') {
        $this->tips = $content;
        return $this;
    }

    /**
     * Alias of method row.
     *
     * @param mixed $content
     *
     * @return Content
     */
    public function content($content)
    {

        if ($this->request->isAjax()) {
            return $content;
        }
        $this->addRow($content);

        return $this;
    }

    /**
     * 自定义高级查询方法
     * @param  array $searchFields [description]
     * @param  string $template [description]
     * @return [type] [description]
     * @date   2018-09-24
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public function search($searchFields = [],$template = '')
    {
        if ($this->request->isAjax()) return $this;
        $this->assign('searchFields',$searchFields);

        if ($template=='') {
            $template = APP_PATH.'/common/view/layout/iframe/search.html';
        }
        $this->addRow($this->fetch($template));
        return $this;
    }

    /**
     * Add one row for content body.
     *
     * @param $content
     *
     * @return $this
     */
    public function row($content)
    {
        if ($this->request->isAjax()) return $this;
        $this->addRow($content);
        return $this;
    }

    /**
     * Add Row.
     *
     * @param Row $row
     */
    protected function addRow($row)
    {
        $this->rows[] = $row;
    }

    /**
     * Build html of content.
     *
     * @return string
     */
    public function build()
    {
        ob_start();

        foreach ($this->rows as $row) {
            echo $row;
        }

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }

    /**
     * Render this content.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->request->isAjax()) {
            $items = [
                'meta_title'  => $this->metaTitle,//页面标题
                'tips'        => $this->tips,// 页面提示说明
                'content'     => $this->build(),
            ];

            $templateFile = APP_PATH.'common/view/layout/iframe/content.html';
            return $this->fetch($templateFile, $items);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}