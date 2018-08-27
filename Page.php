<?php
//测试数据，每页5条，共50条数据
$page = new Page(5,50);
//打印公开方法，获取所有页数的url是否正确
echo '<pre>';
var_dump($page->allUrl());
echo '</pre>';

class Page
{
    //每页显示多少条数据
    protected $number;
    //一共多少条数据
    protected $totalCount;
    //当前页
    protected $page;
    //总页数
    protected $totalPage;
    //url
    protected $url;

    //析构方法,参数：1:每页显示多少条2:一共多少条数据
    public function __construct($number,$totalCount)
    {
        $this->number = $number;
        $this->totalCount = $totalCount;
        //得到总页数
        $this->totalPage = $this->getTotalPage();
        //得到当前页数
        $this->page = $this->getPage();
        //得到url,getUrl为核心方法
        $this->url = $this->getUrl();
    }
    //获取总页数
    protected function getTotalPage()
    {
        return ceil($this->totalCount / $this->number);
    }
    //获取当前页
    protected function getPage()
    {
        if(empty($_GET['page'])){
            $page = 1;
        }else if($_GET['page'] > $this->totalPage){
            $page = $this->totalPage;
        }else if($_GET['page'] < 1){
            $page = 1;
        }else{
            $page = $_GET['page'];
        }
        return $page;
    }
    //得到url地址
    protected function getUrl()
    {
        //得到协议名
        $scheme = $_SERVER['REQUEST_SCHEME'];
        //得到主机名
        $host = $_SERVER['SERVER_NAME'];
        //得到端口号
        $port = $_SERVER['SERVER_PORT'];
        //得到路径和请求字符串
        $uri = $_SERVER['REQUEST_URI'];

        /*中间做处理，要将page=5这种字符串拼接url中，所
        以原来url中有page这个参数,我们首先需要先将原
        来的page参数给清空*/
        $uriArray = parse_url($uri);
        $path = $uriArray['path'];

        if(!empty($uriArray['query'])){
            //首先将请求字符串变为关联数组
            parse_str($uriArray['query'],$array);
            //清除掉关联数组中的page键值对
            unset($array['page']);
            //将剩下的参数拼接为请求字符串
            $query = http_build_query($array);
            //再将请求字符串拼接到路径的后面
            if($query != ''){
                $path = $path.'?'.$query;
            }
        }
        return $scheme.'://'.$host.':'.$port.$path;
    }
    //第一页
    protected function setUrl($str)
    {
        //跳转到第一页的时候，需要判断有没有page参数
        if(strstr($this->url,'?')){
            $url = $this->url.'&'.$str;
        }else{
            $url = $this->url.'?'.$str;
        }
        return $url;
    }
    //所有页数
    public function allUrl()
    {
        $str = array(
            'first'=>$this->first(),
            'prev'=>$this->prev(),
            'next'=>$this->next(),
            'end'=>$this->end(),
        );
        return $str;
    }
    //第一页
    public function first()
    {
        return $this->setUrl('page=1');
    }
    //下一页(根据当前page得到下一页)
    public function next()
    {
        //如果当前页加1大于总的页数
        if($this->page+1 > $this->totalPage){
            $page = $this->totalPage;
        }else{
            $page = $this->page+1;
        }
        return $this->setUrl('page='.$page);
    }
    //上一页(根据当前page得到上一页)
    public function prev()
    {
        //如果当前页减1小于1
        if($this->page-1 < 1){
            $page = 1;
        }else{
            $page = $this->page-1;
        }
        return $this->setUrl('page='.$page);
    }
    //最后一页
    public function end()
    {
        return $this->setUrl('page='.$this->totalPage);
    }
    //偏移量显示
    public function limit(){
        // limit 0,5  limit 5,5
        $offset = ($this->page - 1) * $this->number;
        return $offset.','.$this->number;
    }
}
