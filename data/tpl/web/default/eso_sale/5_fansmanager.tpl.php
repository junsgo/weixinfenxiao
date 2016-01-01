<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('fansmanager');?>">代理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'nocheck'));?>">非代理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'addbusiness'));?>">添加业务员</a></li>
</ul>
<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="eso_sale" />
                <input type="hidden" name="do" value="fansmanager" />
                <input type="hidden" name="op" value="sort" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">真实姓名</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="realname" type="text" value="<?php  echo $sort['realname'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">手机号码</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="mobile" type="text" value="<?php  echo $sort['mobile'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                    <div class=" col-xs-12 col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="stat">
        <div class="stat-div">
            <div class="navbar navbar-static-top">
                <div class="navbar-inner">
                    <span class="pull-right" style="color:red; padding:10px 10px 0 0;">总数：<?php  echo $total;?></span>
                    <span class="brand">名单</span>
                </div>
            </div>
            <div class="sub-item" id="table-list">
                <h4 class="sub-title" style="float:right;color:red;"><a href="">刷新</a></h4>
                <h4 class="sub-title">粉丝名单</h4>

                <div class="sub-content">
                    <table class="table table-hover">
                        <thead class="navbar-inner">
                        <tr><th class="row-hover">用户类型</th>
                            <th class="row-hover">真实姓名</th>
                            <th class="row-hover">手机号码</th>
                            <th class="row-hover">注册时间</th>
                            <th class="row-hover">状态</th>
                            <th class="row-hover">还需充值</th>
                            <th class="row-hover">积分</th>
                            <th class="row-hover">点击统计</th>
                            <th class="row-hover">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if(is_array($list)) { foreach($list as $v) { ?>
                        <tr>
                            <td><?php  if($v['agent']==0 ) { ?>业务员 <?php  } else if($v['agent'] == 1) { ?>医生<?php  } else { ?>普通用户<?php  } ?></td>
                            <td>
                                <?php  echo $v['realname'];?>
                            </td>
                            <td>
                                <?php  echo $v['mobile'];?>
                            </td>
                            <td>
                                <?php  echo date('Y-m-d',$v['createtime'])?>
                            </td>
                            <td>
                                <?php  if($v['status']==0) { ?>
                                <span class="label label-important">未审核</span>
                                <?php  } else { ?>
                                <span class="label label-success">已审核</span>
                                <?php  } ?>
                            </td>
                            <td>
                                <?php  if(empty($commission[$v['id']])) { ?>
                                0
                                <?php  } else { ?>
                                <?php  echo $commission[$v['id']]-$v['commission']?>
                                <?php  } ?>
                            </td>
                            <td>
                                <?php  echo $v['credit1'];?>
                            </td>
                            <td>
                                <?php  echo $v['clickcount'];?>
                            </td>
                            <td>
                                <a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'delete','id' => $v['id']));?>" onclick="return confirm('确定要删除该粉丝吗？');">删除</a>
                                <a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'detail','id' => $v['id']));?>">详情</a>
                                <a href="<?php  echo $this->createWebUrl('order',array('operation'=>'display','status'=>-1, 'shareid' => $v['id']));?>">推广订单</a>
                                <a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'recharge','id' => $v['id']));?>">充值</a>
                            </td>
                        </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
                <?php  echo $pager;?>
            </div>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>