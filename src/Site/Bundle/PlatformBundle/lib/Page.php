<?php
namespace Site\Bundle\PlatformBundle\lib;

/**
 * 分页类，根据正则匹配 低耦
 *
 * @author starsea
 * @link   http://www.haidx.com
 * @version 0.1
 */


class Page
{

    /**
     * 当前页
     */
    private $currPage;

    /**
     * 当前页完整url
     */
    private $_url;

    /**
     * 总页数
     */
    private $_totalPage;


    private $_baseUrl;

    /**
     * 分页配置信息
     */
    private $_config = array(

        /**
         * 分页整体配置
         */

        //分页基准网址
        'url_rule' => '',

        //总记录数
        'total_rows' => '',

        //每页记录数
        'per_page' => 20,

        //放在你当前页码的前面和后面的“数字”链接的数量
        'num_links' => 3,

        //$_GET分页变量名
        'get_name' => 'page',

        //分页查询参数
        'query_string' => array(),

        //链接目标，在标签是a标签的时候起作用
        'target' => '',

        //ajax分页执行的js函数名
        'ajax_func' => '',

        //文章内容分页的标识符
        'content_page_sign' => '',

        //文章分页内容
        'content' => '',

        //url模式，默认根据配置文件的URL方式改变，如果为true，则使用传统方式
        'url_mode' => false,

        /**
         * 分页容器标签配置
         */

        //分页容器标签
        'page_container_tag' => 'div',

        //分页容器标签的class样式名
        'page_container_tag_style' => 'page',

        /**
         * 起始链接定义
         */

        //首页链接的名字
        'first_link' => '首页',

        //首页链接标签
        'first_tag' => 'a',

        //首页链接class样式名
        'first_tag_style' => '',

        /**
         * 尾页链接定义
         */

        //尾页链接的名字
        'last_link' => '尾页',

        //尾页链接标签
        'last_tag' => 'a',

        //尾页链接class样式名
        'last_tag_style' => '',

        /**
         * 上一页、下一页链接定义
         */

        //上一页链接的名字
        'prev_link' => '上一页',

        //上一页链接标签
        'prev_tag' => 'a',

        //上一页链接class样式名
        'prev_tag_style' => '',


        //下一页链接的名字
        'next_link' => '下一页',

        //下一页链接标签
        'next_tag' => 'a',

        //下一页链接class样式名
        'next_tag_style' => '',

        /**
         * 定义当前页链接
         */

        //当前页链接标签
        'current_tag' => 'a',

        //当前页链接class样式名
        'current_tag_style' => '',

        /**
         * 定义数字链接
         */

        //数字链接
        'num_tag' => 'a',

        //数字链接class样式名
        'num_tag_style' => '',

    );

    /**
     * 分页结果字符串数组
     */
    private $_str = array(

        //首页
        'first' => '',

        //尾页
        'last' => '',

        //上一页
        'prev' => '',

        //下一页
        'next' => '',

        //数字分页
        'nums' => '',

        //分页信息，例：1/50，解释：当前第1页，共50页
        'info' => '',

        //总记录数
        'count' => '',
    );

    /**
     * 构造方法
     * @param array $config 分页配置参数
     * @return object 类本身
     */
    public function __construct(array $config)
    {
        if (!is_array($config)) return false;
        $this->_config = array_merge($this->_config, $config);
        $this->init();
        return $this;
    }

    /**
     * 进行初始化工作
     */
    protected function init()
    {
        $this->generateBaseUrl();

        $this->currPage = $this->_config['curr_page'] ? $this->_config['curr_page'] : 1;

        $this->_totalPage = ceil($this->_config['total_rows'] / $this->_config['per_page']);

        if ($this->currPage > $this->_totalPage) {
            $this->currPage = $_GET[$this->_config['get_name']] = $this->_totalPage;
        }

    }


    public function generateBaseUrl()
    {

        $this->_baseUrl = preg_replace($this->_config['url_rule'], '${1}{page}${2}', $_SERVER['REQUEST_URI']);

        //没匹配成功
        if ($this->_baseUrl === $_SERVER['REQUEST_URI']) {

            $this->_baseUrl = $this->getRequestUri() . '/{page}';

        }

        return $this->_baseUrl;
    }

    public function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (substr($uri, -1) == '/') {
            $uri = rtrim($uri, '/');
        }
        return $uri;
    }


    /**
     * 组装分页信息
     */
    private function _pageInfo()
    {
        $this->_str['info'] =
            $this->openTag
                (
                    $this->_config['first_tag'],
                    array(' title' => '当前第' . $this->currPage . '页，共' . $this->_totalPage . '页')
                ) .
            $this->currPage . '/' . $this->_totalPage . $this->closeTag($this->_config['first_tag']) . "\r\n";
    }

    /**
     * 组装总记录数
     */
    private function _pageCount()
    {
        $this->_str['count'] =
            $this->openTag
                (
                    $this->_config['first_tag'],
                    array(' title' => '共有' . $this->_config['total_rows'] . '条记录')
                ) . $this->_config['total_rows'] . $this->closeTag($this->_config['first_tag']) . "\r\n";
    }

    /**
     * 获取参数结果
     * @param string $name 配置名，如果为空则返回所以配置
     * @return string || array 配置信息
     */
    public function getConfig($name = null)
    {
        if (empty($name))
            return $this->_config;
        else if (isset($this->_config[$name]))
            return $this->_config[$name];
        else
            return false;
    }


    /**
     * 设置HTML起始标签
     * @param string $tag 标签名
     * @param array $attrs 标签属性
     * @return string 返回组装好的标签
     */
    protected function openTag($tag, $attrs = array())
    {
        $tag = '<' . $tag;
        if (!empty($attrs) && is_array($attrs))
            foreach ($attrs as $name => $val) $tag .= empty($val) ? null : $name . '="' . $val . '"';
        $tag .= '>';
        return $tag;
    }

    /**
     * 设置HTML结尾标签
     * @param string $tag 标签名
     * @return string 返回HTML结尾标签
     */
    protected function closeTag($tag)
    {
        return '</' . $tag . '>';
    }

    /**
     * 获取分页url
     */
    private function _getPageUrl($page)
    {

        $this->_url = str_replace('{page}', $page, $this->_baseUrl);
        return $this->_url;
    }


    /**
     * 获取当前url
     */
    public function getUrl()
    {
        return $this->_getPageUrl($this->currPage);
    }

    /**
     * 当前页减1 上一页页码
     * @return int
     */
    private function _prev()
    {
        return $this->currPage - 1;
    }

    /**
     * 当前页加1 下一页页码
     * @return int
     */
    private function _next()
    {
        return $this->currPage + 1;
    }

    /**
     * 解析属性，并获取标签属性
     * @param string $name 配置信息里的变量名
     * @param string $url 分页url
     * @return array 标签属性数组
     */
    private function _getAttr($name, $url)
    {
        $val = $this->getConfig($name);
        if (empty($this->_config['ajax_func'])) {
            if ($val == 'a')
                $attrs = array(' href' => $url, 'target' => $this->getConfig('target'));
            else
                $attrs = array(' onclick' => "location.href='$url';");
        } else
            $attrs = array(' onclick' => $this->_config['ajax_func'] . '(\'' . $url . '\');');
        if (!empty($this->_config[$name . '_style']))
            $attrs[' class'] = $this->_config[$name . '_style'];
        return $attrs;
    }

    /**
     * 获取完整的标签
     * @param string $tag
     */
    private function _getLabel($tag, $link, $attr)
    {
        return $this->openTag($tag, $attr) . $link . $this->closeTag($tag);
    }

    /**
     * 转到首页的链接完整标签字符串
     */
    private function _pageFirst()
    {
        $attrs = $this->_getAttr('first_tag', $this->_getPageUrl(1));
        $this->_str['first'] = $this->_getLabel
                (
                    $this->getConfig('first_tag'),
                    $this->getConfig('first_link'),
                    $attrs
                ) . "\r\n";
    }

    /**
     * 转到尾页的链接完整标签字符串
     */
    private function _pageLast()
    {
        $attrs = $this->_getAttr('last_tag', $this->_getPageUrl($this->_totalPage));
        $this->_str['last'] = $this->_getLabel
                (
                    $this->getConfig('last_tag'),
                    $this->getConfig('last_link'),
                    $attrs
                ) . "\r\n";
    }

    /**
     * 转到上一页的链接完整标签字符串
     */
    private function _pagePrev()
    {
        $attrs = $this->_getAttr('prev_tag', $this->_getPageUrl($this->_prev()));
        $this->_str['prev'] = $this->_getLabel
                (
                    $this->getConfig('prev_tag'),
                    $this->getConfig('prev_link'),
                    $attrs
                ) . "\r\n";
    }

    /**
     * 转到下一页的链接完整标签字符串
     */
    private function _pageNext()
    {
        $attrs = $this->_getAttr('next_tag', $this->_getPageUrl($this->_next()));
        $this->_str['next'] = $this->_getLabel
                (
                    $this->getConfig('next_tag'),
                    $this->getConfig('next_link'),
                    $attrs
                ) . "\r\n";
    }

    /**
     * 数字链接完整标签字符串
     */
    private function _pageNums()
    {
        $numLink = $this->_config['num_links'];
        $numsLink = $numLink * 2 + 1;

        if ($numsLink >= $this->_totalPage) {
            $pageStart = 1;
            $pageEnd = $this->_totalPage;
        } else if (($this->currPage - $numLink - 1 + $numsLink) > $this->_totalPage) {
            $pageStart = $this->_totalPage - $numsLink + 1;
            $pageEnd = $this->_totalPage;
        } else {
            $pageStart = ($this->currPage <= $numLink) ? 1 : $this->currPage - $numLink;
            $pageEnd = ($pageStart == 1) ? $numsLink : $pageStart + $numsLink - 1;
        }

        for ($page = $pageStart; $page <= $pageEnd; $page++) {
            if ($this->currPage == $page) {
                $label = $this->openTag($this->_config['current_tag']) .
                    $page .
                    $this->closeTag($this->_config['current_tag']);
            } else {
                $attrs = $this->_getAttr('num_tag', $this->_getPageUrl($page));
                $label = $this->_getLabel($this->getConfig('num_tag'), $page, $attrs);
            }
            $this->_str['nums'] .= $label . "\r\n";
        }
    }


    /**
     * 自定义显示方式(显示顺序按数组先后顺序设置)
     * 可设置的类型：
     * first 首页链接
     * last  尾页链接
     * prev  上一页链接
     * next  下一页链接
     * nums  数字链接
     * info  分页信息，显示：当前页码/所有页码
     * count 总记录数
     * @param  array 需要显示的链接段
     * @return string 分页字符串
     */
    public function display($options = array())
    {
        $str = '';
        if ($this->_config['total_rows'] == 0 || $this->_config['per_page'] > $this->_config['total_rows']) return '';
        if (empty($options)) {
            if ($this->currPage != 1) {
                $this->_pageFirst();
                $this->_pagePrev();
            }
            if ($this->currPage != $this->_totalPage) {
                $this->_pageLast();
                $this->_pageNext();
            }
            $this->_pageInfo();
            $this->_pageCount();
            $this->_pageNums();
            $str = $this->_str['count'] . $this->_str['info'] . $this->_str['first'] .
                $this->_str['prev'] . $this->_str['nums'] . $this->_str['next'] . $this->_str['last'];
        }

        return $this->openTag($this->_config['page_container_tag'],
            array(' class' => $this->_config['page_container_tag_style'])) . "\r\n" .
        $str .
        $this->closeTag($this->_config['page_container_tag']);
    }


    /**
     * 内容自定义显示方式(显示顺序按数组先后顺序设置)
     * 用于内容分页，列表分页请用 display() 方法
     *
     * 可设置的类型：
     * first 首页链接
     * last  尾页链接
     * prev  上一页链接
     * next  下一页链接
     * nums  数字链接
     * info  分页信息，显示：当前页码/所有页码
     * count 总记录数
     * @param  array 需要显示的链接段
     * @return string 分页字符串
     */
    public function cDisplay($options = array())
    {

        $str = <<<EOD
<div class="pages_box">
    <div class="post_page">
        <div class="bg_c"></div>
        <div class="pagelist">
EOD;

        $this->_pageNums();
        $this->_pagePrev(); //上一页
        $this->_pageNext(); // 下一

        $str .= $this->_str['nums'];
        $str .= <<<EOD
       </div>
    </div>
EOD;
        if ($this->_config['curr_page'] == 1) {

            $str .= '<span class="no">上一页</span>';
        } else {
            $str .= $this->_str['prev'];
        }

        $str .= '<span class="page_num">第' . $this->currPage . '页</span>';


        if ($this->_config['curr_page'] == $this->_totalPage) {

            $str .= '<span class="no">下一页</span>';
        } else {
            $str .= $this->_str['next'];
        }

        $str .= '</div>';

        return $str;

    }

}

?>
