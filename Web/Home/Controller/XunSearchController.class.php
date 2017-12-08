<?php
namespace Home\Controller;

use Think\Controller;

class XunSearchController extends Controller {

	/**
	 * 创建商品表索引
	 */
    public function creatIndex(){

    	// 导入第三方类库
    	vendor('xunsearch.lib.XS');
    	$xs = new \XS('goods');
    	$index = $xs->index;
        // $index->clean();
        
    	$goods = D('goods');
    	$arr = $goods->field('shop_goods.id,shop_goods.name,shop_goods.price,shop_goods.sold,shop_goods.cover,shop_goods.tid,shop_goods.status,shop_type.name as tname')->join('shop_type on shop_goods.tid=shop_type.id')->select();
        // dump($arr);
        // die;

    	foreach ($arr as $v) {
    		$doc = new \XSDocument($v);
    		$index->update($doc);
            $index->flushIndex();  
    	}
    	// var_dump($arr);

    }

    /**
     * 判断搜索框中的数据
     */
    public function judge(){

        if (IS_AJAX) {

            // $data = $_POST;
            $data['q'] = I('post.q','','trim');
            if ($data['q'] || $data['q'] === '0') {
                $this->ajaxReturn($data['q']);
            } else {
                $this->ajaxReturn(false);
            }
            
        }
    }

    // public function 


    /**
     * 执行搜索
     */
    public function search(){

    	// 导入第三方类库
    	vendor('xunsearch.lib.XS');

        // 支持的 GET 参数列表
        // q: 查询语句
        // m: 开启模糊搜索，其值为 yes/no
        // f: 只搜索某个字段，其值为字段名称，要求该字段的索引方式为 self/both
        // s: 排序字段名称及方式，其值形式为：xxx_ASC 或 xxx_DESC
        // p: 显示第几页，每页数量为 XSSearch::PAGE_SIZE 即 10 条

        // 变量
        $eu = '';
        $__ = array('q', 'm', 'f', 's', 'p');
        foreach ($__ as $_) {
            $$_ = isset($_GET[$_]) ? $_GET[$_] : '';
        }
        
        // 设置链接 $_SERVER['SCRIPT_NAME']. '?q=' . urlencode($q) . '&m=' . $m . '&f=' . $f . '&s=' . $s . $eu;
        $bu = U('XunSearch/search','q='.$q.'&s='.$s);

        // other variable maybe used in tpl
        $count = $total = $search_cost = 0;
        $docs = $related = $corrected = $hot = array();
        $error = $pager = '';
        $total_begin = microtime(true);

        // 开始搜索
        try {
            $xs = new \XS('goods');
            $search = $xs->search;
            $search->setCharset('UTF-8');

            // 设置排序方法
            if (($pos = strrpos($s, '_')) !== false) {
                $sf = substr($s, 0, $pos);
                $st = substr($s, $pos + 1);
                $search->setSort($sf, $st === 'ASC');
            }
           
            // 设置分页,数量 
            $p = max(1, intval($p));

            // $n = XSSearch::PAGE_SIZE; // 默认值 10

            $n = 12; // 每页显示数量

            $search->setLimit($n, ($p - 1) * $n);

            // 搜索词纠错
            $corrected = $search->getCorrectedQuery($q);

            // 设置模糊搜索
            // $search->setFuzzy(true);   

            // 获取热搜词
            // $hot = $search->getHotQuery();
            
            // 获得查询结果

            $goods = D('goods');
            $res = $goods->typeSearch($q, $s);
            
            if (!$res) {

                $res = $search->setQuery($q.' AND status:2')->search();
                // 获得查询结果数量
                $count = $search->getLastCount();
            } else {
                // 搜索分类 处理结果
                // 获得查询结果数量
                $count = $goods->count;
                $r = [];
                // 设置
                for ($a = ($p - 1) * $n; $a < $p * $n; $a++) {
                    $r[] = $res[$a];
                    if ($a == ($count - 1) ) break; 
                }
                $res = $r;
            }     

            

            // 分页显示输出
            if ($count > $n) {
                $pb = max($p - 5, 1);
                $pe = min($pb + 10, ceil($count / $n) + 1);
                $pager = '';
                do {
                    $pager .= ($pb == $p) ? '<li class="disabled"><a>' . $p . '</a></li>' : '<li><a href="' . $bu . '?p=' . $pb . '">' . $pb . '</a></li>';
                } while (++$pb < $pe);
            }
            // dump($pager);die;
        } catch (XSException $e) {
            $error = strval($e);
            echo $error;
        }

        $roc = $search->setQuery('status:2')->search();

        // dump($roc['0']->name);die;
        // 处理搜索提示信息
        // $goods->point($res, $corrected);
        // xunsearch-full-1.4.10

        // 分配数据
        $this->assign('q',$q);          // 搜索词语
        // $this->assign('hot',$hot);      // 获取热搜
        $this->assign('sort',$s);       // 排序条件
        $this->assign('list',$res);     // 商品数据
        $this->assign('count',$count);  // 商品数量
        $this->assign('corrected',$corrected);  // 纠错词语
        $this->assign('pager',$pager);  // 分页
        
        // 输出模板
    	$this->display('Goods/search');
    }

    public function suggest(){
        // 加载 XS 入口文件
        vendor('xunsearch.lib.XS');

        // Prefix Query is: term (by jQuery-ui)
        $q = isset($_POST['q']) ? trim($_POST['q']) : '';
        $q = get_magic_quotes_gpc() ? stripslashes($q) : $q;
        $terms = array();
        if (!empty($q) && strpos($q, ':') === false) {
            try {
                $xs = new \XS('goods');
                $terms = $xs->search->setCharset('UTF-8')->getExpandedQuery($q);
            } catch (XSException $e) {
                
            }
        }
        
        $this->ajaxReturn($terms);

    }

    public function hot(){
        vendor('xunsearch.lib.XS');

        $xs = new \XS('goods');
        $search = $xs->search;
        $search->setCharset('UTF-8');

        // 获取热搜词
        $hot = $search->getHotQuery();

        $this->ajaxReturn($hot);
    }

    
}