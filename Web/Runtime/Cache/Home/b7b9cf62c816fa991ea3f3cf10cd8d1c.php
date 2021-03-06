<?php if (!defined('THINK_PATH')) exit();?>                        <div class="clear"></div>
                        <div class="tb-r-filter-bar">
                            <ul class=" tb-taglist am-avg-sm-4">
                                <li class="tb-taglist-li tb-taglist-li-current">
                                    <div class="comment-info">
                                        <span>全部评价</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-1">
                                    <div class="comment-info">
                                        <span>好评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-0">
                                    <div class="comment-info">
                                        <span>中评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li--1">
                                    <div class="comment-info">
                                        <span>差评</span>
                                        <span class="tb-tbcr-num">(32)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                        <!-- 用户评论选项卡 -->

                        <ul class="am-comments-list am-comments-list-flip">
                            <?php if(is_array($list)): foreach($list as $key=>$val): ?><li class="am-comment">
                            <!-- 评论容器 -->
                            <a href="">
                                <img class="am-comment-avatar" src="<?php echo ($val['head']); ?>" />
                                <!-- 评论者头像 -->
                            </a>

                            <div class="am-comment-main">
                                <!-- 评论内容容器 -->
                                <header class="am-comment-hd">
                                    <!--<h3 class="am-comment-title">评论标题</h3>-->
                                    <div class="am-comment-meta">
                                        <!-- 评论元数据 -->
                                        <a href="#link-to-user" class="am-comment-author"><?php echo ($val['username']); ?></a>
                                        <!-- 评论者 -->
                                        评论于
                                        <time datetime=""><?php echo ($val['addtime']); ?></time>
                                    </div>
                                </header>

                                <div class="am-comment-bd">
                                    <div class="tb-rev-item " data-id="255776406962">
                                        <div class="J_TbcRate_ReviewContent tb-tbcr-content " id="user_comment"><?php echo ($val['content']); ?></div>
                                        <div class="tb-r-act-bar">
                                            口味：<?php echo ($val['taste']); ?>
                                        </div>
                                    </div>

                                </div>
                                <!-- 评论内容 -->
                            </div>
                        </li><?php endforeach; endif; ?>
                        </ul>

                        <div class="clear"></div>
                        <div id="paging">
                            <!--分页 -->
                            <div class="pagination" >
                                <ul>
                                    <?php echo ($btn); ?>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="tb-reviewsft">
                            <div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
                        </div>