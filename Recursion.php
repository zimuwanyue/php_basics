   /**
     *无限极分类
     *$categories:需要分类的数据
     *$parent_id:顶级分类
     *$list:返回的数据
     *$level:用于区分分类层级，html页面使用
     *{foreach from=$categories  key=k item=cat}
     *<tr>
     *<td>{'---'|str_repeat:$cat.level}{$cat.c_name}</td>
     *</tr>
     *{/foreach}
     */
    private function noLimitCategories($categories,$parent_id=0,$level=0){
        //定义变量保存有效数据
        static $list = array();
        //循环遍历
        foreach($categories as $cat){
            if($cat['c_parent_id'] == $parent_id){
                //将当前函数的level加入到分类数据中
                $cat['level'] = $level;
                $list[] = $cat;
                //获取所有$cat可能存在的所有子分类，递归调用自己
                $this->noLimitCategories($categories,$cat['id'],$level+1);
            }
        }
        //返回数据
        return $list;
    }
