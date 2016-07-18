<?php if (!defined('THINK_PATH')) exit(); W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>
    
    
    <!--main-->
    <div id="main" class="clearfix">
	
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <!-- <td class="main_table_left" align="left" valign="top">
		
		    < ?php include('left_new.php');?>
        
        </td> -->
        <td class="main_table_right" align="left" valign="top">

        <!--right-->
        <div id="Right">
        
        
        
        
		
            <!--home_page_right_header-->

            <!--/home_page_right_header-->

<!-- 
上架商品
下架商品
回收站商品
库存报警
发布商品







会员总数
新增会员

最新评论列表 
-->


<!-- 快捷入口 -->
<div class="row mb20">
  <div class="col-md-3">
    <!-- 新订单 -->
    <div class="col_box col_box1">
      <a href="#" class="clearfix">
        <i class="icon-shopping-cart"></i>
        <div class="f_r">
          <span>8865</span>
          <strong>新订单</strong>
        </div>
      </a>
    </div>
    <!-- 新订单 -->
  </div>
  <div class="col-md-3">
    <!-- 新会员 -->
    <div class="col_box col_box2">
      <a href="#" class="clearfix">
        <i class="icon-user"></i>
        <div class="f_r">
          <span>8865</span>
          <strong>新会员</strong>
        </div>
      </a>
    </div>
    <!-- /新会员 -->
  </div>
  <div class="col-md-3">
    <!-- 商品管理 -->
    <div class="col_box col_box3">
      <a href="#" class="clearfix">
        <i class="icon-qrcode"></i>
        <div class="f_r">
          <span>8865</span>
          <strong>商品管理</strong>
        </div>
      </a>
    </div>
    <!-- /商品管理 -->
  </div>
  <div class="col-md-3">
    <!-- 售后订单 -->
    <div class="col_box col_box4">
      <a href="#" class="clearfix">
        <i class="icon-truck"></i>
        <div class="f_r">
          <span>8865</span>
          <strong>售后订单</strong>
        </div>
      </a>
    </div>
    <!-- /售后订单 -->
  </div>
</div>
<!-- /快捷入口 -->

<script type="text/javascript" src="/cyl/Public/Common/js/echarts-all.js"></script>
<!-- 统计报表 -->
<div class="row mb20">
  
  <div class="col-md-6">    
    <!-- count_box 1-->
    <div class="count_box">
      <div class="count_body clearfix">
      <div id="broken" class="contAiner" style="height:400px"></div>
      </div>
    </div>
    <!-- /count_box -->
  </div>

  <div class="col-md-6">
      <!-- count_box 2-->
      <div class="count_box">
        <div class="count_body clearfix">
        <div id="duidie" class="contAiner" style="height:400px"></div>
        </div>
      </div>
      <!-- /count_box -->
  </div>

  <div class="col-md-6">
    <!-- count_box 3-->
    <div class="count_box">
      <div class="count_body clearfix">
      <div id="map" class="contAiner" style="height:400px"></div>
      </div>
    </div>
    <!-- /count_box -->
  </div>

  <div class="col-md-6">
    <!-- count_box 4-->
    <div class="count_box">
      <div class="count_body clearfix">
      <div id="pie" class="contAiner" style="height:400px"></div>
      </div>
    </div>
    <!-- /count_box -->
  </div>


  

</div>


<script>
$(function () {
  
  
    
    var myChart = echarts.init(document.getElementById('broken'));
    var myChart2 = echarts.init(document.getElementById('duidie'));
    var myChart3 = echarts.init(document.getElementById('map'));
    var myChart4 = echarts.init(document.getElementById('pie'));

        // 指定图表的配置项和数据
        var option = {
          color:['#4884b8'],
          title : {
              text: '访问量统计',
              textStyle:{
                fontWeight :'lighter'
              },
              left :'center'
          },
          tooltip : {
              trigger: 'axis',
              formatter :function (params, ticket, callback) {
                console.log(params[0]);
                 return params[0].seriesName+"："+params[0].value+"个";
             } 
          },
          toolbox: {
              show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
          },
          // grid:{
          //      left :40,
          //      right:40
          // },
          xAxis : [
              {
                  type : 'category',
                  boundaryGap : false,
                  data :  ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                   splitLine: {show: false},
              }
          ],
          yAxis : [
              {
                  type : 'value',
                  axisLabel : {
                      formatter:  function (value, index) {
                               console.log(typeof(value));
                             // 格式化成月/日，只在第一个刻度显示年份
                                var value_num = String(value/1000);
                               
                                return value_num+"K";
                            }
                   },
                   axisLine: {show: false},
                  axisTick: {show: false},
                 
              }
          ],
          series : [
              {
                  name:'访问统计',
                  type:'line',
                  data:[1000, 2000, 1001, 3000, 1500, 6000, 5500, 1000, 7000, 4500, 2003, 1001],
                  lineStyle:{
                    normal :{
                      color :'#4884b8'
                    }
                  },
                  symbol:"circle",
                  symbolSize :4
              }
          ],
      };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);

        // 图2
        var option2 = {
       color:['#FD2F47'],
       title: {
        text: '销售额统计', 
        textStyle:{
              fontWeight :'lighter'
            },
            left :'center'
    },

    tooltip : {
        trigger: 'axis',
        axisPointer:{
            type: 'line',
            lineStyle: {
                color: '#FD2F47',
                width: 2,
                type: 'solid'
            },
           
        },      
        formatter :function (params, ticket, callback) {
            console.log(params[0]);
             return params[0].seriesName+"："+params[0].value+"个";
         }  
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : ['111', '222', '333', '444', '555', '666'],
             axisLine:{
                  lineStyle:{
                    color: '#ddd',
                }   
                },
        }
    ],
    yAxis : [
        {
            type : 'value',
            min:0,
            max:12500,
            interval :2500,
            splitNumber :5,
            axisLabel : {
                      formatter:  function (value, index) {
                               console.log(typeof(value));
                             // 格式化成月/日，只在第一个刻度显示年份
                                var value_num = String(value/1000);
                               
                                return value_num+"K";
                            }
            },
              axisLine:{
                  lineStyle:{
                    color: '#ccc',
                }   
                },

        }
    ],
    series : [
        {
            name:'销售额统计',
            type:'line',
            stack: '总量',
            smooth:true,
            areaStyle: {normal: {}},
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data:[11000, 11000, 8000, 5100, 4000, 3000]
        },

    ]
};
myChart2.setOption(option2);

    // map   
    var option3 = {
    title : {
        text: '销量',
        subtext: '',
        x:'center'
    },
    tooltip : {
        trigger: 'item'
    },
    legend: {
        orient: 'vertical',
        x:'left',
        data:['iphone3','iphone4','iphone5']
    },
    dataRange: {
        min: 0,
        max: 2500,
        x: 'left',
        y: 'bottom',
        text:['高','低'],           // 文本，默认为数值文本
        calculable : true
    },
    toolbox: {
        show: true,
        orient : 'vertical',
        x: 'right',
        y: 'center',
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    roamController: {
        show: true,
        x: 'right',
        mapTypeControl: {
            'china': true
        }
    },
    series : [
        {
            name: 'iphone3',
            type: 'map',
            mapType: 'china',
            roam: false,
            itemStyle:{
                normal:{label:{show:true}},
                emphasis:{label:{show:true}}
            },
            data:[
                {name: '北京',value: Math.round(Math.random()*1000)},
                {name: '天津',value: Math.round(Math.random()*1000)},
                {name: '上海',value: Math.round(Math.random()*1000)},
                {name: '重庆',value: Math.round(Math.random()*1000)},
                {name: '河北',value: Math.round(Math.random()*1000)},
                {name: '河南',value: Math.round(Math.random()*1000)},
                {name: '云南',value: Math.round(Math.random()*1000)},
                {name: '辽宁',value: Math.round(Math.random()*1000)},
                {name: '黑龙江',value: Math.round(Math.random()*1000)},
                {name: '湖南',value: Math.round(Math.random()*1000)},
                {name: '安徽',value: Math.round(Math.random()*1000)},
                {name: '山东',value: Math.round(Math.random()*1000)},
                {name: '新疆',value: Math.round(Math.random()*1000)},
                {name: '江苏',value: Math.round(Math.random()*1000)},
                {name: '浙江',value: Math.round(Math.random()*1000)},
                {name: '江西',value: Math.round(Math.random()*1000)},
                {name: '湖北',value: Math.round(Math.random()*1000)},
                {name: '广西',value: Math.round(Math.random()*1000)},
                {name: '甘肃',value: Math.round(Math.random()*1000)},
                {name: '山西',value: Math.round(Math.random()*1000)},
                {name: '内蒙古',value: Math.round(Math.random()*1000)},
                {name: '陕西',value: Math.round(Math.random()*1000)},
                {name: '吉林',value: Math.round(Math.random()*1000)},
                {name: '福建',value: Math.round(Math.random()*1000)},
                {name: '贵州',value: Math.round(Math.random()*1000)},
                {name: '广东',value: Math.round(Math.random()*1000)},
                {name: '青海',value: Math.round(Math.random()*1000)},
                {name: '西藏',value: Math.round(Math.random()*1000)},
                {name: '四川',value: Math.round(Math.random()*1000)},
                {name: '宁夏',value: Math.round(Math.random()*1000)},
                {name: '海南',value: Math.round(Math.random()*1000)},
                {name: '台湾',value: Math.round(Math.random()*1000)},
                {name: '香港',value: Math.round(Math.random()*1000)},
                {name: '澳门',value: Math.round(Math.random()*1000)}
            ]
        },
        {
            name: 'iphone4',
            type: 'map',
            mapType: 'china',
            itemStyle:{
                normal:{label:{show:true}},
                emphasis:{label:{show:true}}
            },
            data:[
                {name: '北京',value: Math.round(Math.random()*1000)},
                {name: '天津',value: Math.round(Math.random()*1000)},
                {name: '上海',value: Math.round(Math.random()*1000)},
                {name: '重庆',value: Math.round(Math.random()*1000)},
                {name: '河北',value: Math.round(Math.random()*1000)},
                {name: '安徽',value: Math.round(Math.random()*1000)},
                {name: '新疆',value: Math.round(Math.random()*1000)},
                {name: '浙江',value: Math.round(Math.random()*1000)},
                {name: '江西',value: Math.round(Math.random()*1000)},
                {name: '山西',value: Math.round(Math.random()*1000)},
                {name: '内蒙古',value: Math.round(Math.random()*1000)},
                {name: '吉林',value: Math.round(Math.random()*1000)},
                {name: '福建',value: Math.round(Math.random()*1000)},
                {name: '广东',value: Math.round(Math.random()*1000)},
                {name: '西藏',value: Math.round(Math.random()*1000)},
                {name: '四川',value: Math.round(Math.random()*1000)},
                {name: '宁夏',value: Math.round(Math.random()*1000)},
                {name: '香港',value: Math.round(Math.random()*1000)},
                {name: '澳门',value: Math.round(Math.random()*1000)}
            ]
        },
        {
            name: 'iphone5',
            type: 'map',
            mapType: 'china',
            itemStyle:{
                normal:{label:{show:true}},
                emphasis:{label:{show:true}}
            },
            data:[
                {name: '北京',value: Math.round(Math.random()*1000)},
                {name: '天津',value: Math.round(Math.random()*1000)},
                {name: '上海',value: Math.round(Math.random()*1000)},
                {name: '广东',value: Math.round(Math.random()*1000)},
                {name: '台湾',value: Math.round(Math.random()*1000)},
                {name: '香港',value: Math.round(Math.random()*1000)},
                {name: '澳门',value: Math.round(Math.random()*1000)}
            ]
        }
    ]
};
                    
    myChart3.setOption(option3);

    // pie  
    var option4 = {
    title : {
        text: '站点用户访问来源',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'left',
                        max: 1548
                    }
                }
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'直接访问'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1548, name:'搜索引擎'}
            ]
        }
    ]
};
 myChart4.setOption(option4);
                    

                    
    
});
</script>
<!-- /统计报表 -->



<script>
$(function () {
  $('.dash_b ox2').slimScroll({
      height: '420px'
  });
});
</script>

<div class="row">
  <div class="col-md-6">
    
    <!-- count_box -->
    <div class="count_box">    
      <div class="count_head count_head2 clearfix">
        <h2>最新订单</h2>
        <a href="#">查看更多</a>
      </div>
      <div class="count_body clearfix">
        
        <div id="NewOrder" class="dash_box2 clearfix">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <td align="center">订单编号</td>
              <td align="center">订单商品</td>
              <td align="center">收货人</td>
              <td align="center">订单总额</td>
              <td align="center">下单时间</td>
              <td align="center">订单状态</td>
              <td align="center">操作</td>
            </tr>
          </thead>
          <tbody>

          <!--loop-->
          <?php for($i=1;$i<7;$i++){?>
          <tr>
          <td align="center" class="no_td1"><a href="http://www.gj519.com/order/order_detail/7412.html">104236843</a></td>
          <td align="center" class="no_td2">
          <div class="no_talist clearfix">
            <ul>
              <li><a href="#"><img src="http://www.gj519.com/upload/item/icon/2015/14455187313794.jpg" width="50" height="50"></a></li>
              <li><a href="#"><img src="http://www.gj519.com/upload/item/icon/2015/14455187313794.jpg" width="50" height="50"></a></li>
              <li><a href="#"><img src="http://www.gj519.com/upload/item/icon/2015/14455187313794.jpg" width="50" height="50"></a></li>
              <li><a href="#"><img src="http://www.gj519.com/upload/item/icon/2015/14455187313794.jpg" width="50" height="50"></a></li>
            </ul>
          </div>
          </td>
          <td align="center" class="no_td3">沈剑</td>
          <td align="center" class="no_td4">￥1296.00</td>
          <td align="center" class="no_td5">2015-07-03 10:42:36</td>
          <td align="center" class="no_td6">
            <span class="dark">已取消</span>
            <span class="success">已确认</span>
            <a href="http://www.gj519.com/order/order_detail/7412.html">详情</a>
          </td>
          <td align="center" class="no_td7">
            <button type="button" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i> 删除</button>
          </td>
          </tr>
          <?php } ?>
          <!--end-->

          </tbody>
          </table>

        </div>

      </div>
    </div>
    <!-- /count_box -->

  </div>
  <div class="col-md-3">
    
    <!-- count_box -->
    <div class="count_box">    
      <div class="count_head count_head2 clearfix">
        <h2>码动动态</h2>
        <a href="#">查看更多</a>
      </div>
      <div class="count_body clearfix">
        <div id="MDNews" class="dash_box2">
            
            <!-- newloop -->
            <div class="newloop">
              <h3><a href="#" target="_blank">小米在美开设在线商店 暂时不卖手机平板暂时不卖手机平板</a></h3>
              <span>2015-07-10</span>
              <small>2月13日消息，据国外媒体报道，小米今天在旧金山举行了一次新闻发布会，公司全球副总裁雨果-巴拉(Hugo Barra)宣布美版小米官网和在线商店将于不久之后正式上线</small>
            </div>
            <!-- /newloop -->

            <div class="newloop">
              <h3><a href="#" target="_blank">小米在美开设在线商店 暂时不卖手机平板</a></h3>
              <span>2015-07-10</span>
              <small>2月13日消息，据国外媒体报道，小米今天在旧金山举行了一次新闻发布会，公司全球副总裁雨果-巴拉(Hugo Barra)宣布美版小米官网和在线商店将于不久之后正式上线</small>
            </div>
            <div class="newloop">
              <h3><a href="#" target="_blank">做区域电商，强龙为什么压不过地头蛇？</a></h3>
              <span>2015-07-10</span>
            </div>
            <div class="newloop">
              <h3><a href="#" target="_blank">小米在美开设在线商店 暂时不卖手机平板暂时不卖手机平板暂时不卖手机平板</a></h3>
              <span>2015-07-10</span>
              <small>2月13日消息，据国外媒体报道，小米今天在旧金山举行了一次新闻发布会，公司全球副总裁雨果-巴拉(Hugo Barra)宣布美版小米官网和在线商店将于不久之后正式上线</small>
            </div>
            <div class="newloop">
              <h3><a href="#" target="_blank">线下零售企业的电商逆袭</a></h3>
              <span>2015-07-10</span>
              <small>2015年初，一组“是男人就放过1号店”的海报广泛流传</small>
            </div>

        </div>
      </div>
    </div>
    <!-- /count_box -->
    
  </div>
  <div class="col-md-3">
    
    <!-- count_box -->
    <div class="count_box">    
      <div class="count_head count_head2 clearfix">
        <h2>最新评论</h2>
        <a href="#">查看更多</a>
      </div>
      <div class="count_body clearfix">
        
        <div id="NewComm" class="dash_box2">
          
          <!--loop-->
          <?php for($i=1;$i<=5;$i++){?>
          <div class="commlooop clearfix">
            <div class="commlooop_face"><a href="#"><img src="/cyl/Public/Admin/images/test/face<?php echo $i;?>.jpg"></a></div>
            <div class="commlooop_right">
              <div class="commlooop_right_head">
                <h3><a href="#">JaCall Wong</a></h3>
                <small>2015-07-12</small>
              </div>
              <div class="commlooop_right_content">小米今天在旧金山举行了一次新闻发布会，公司全球副总裁雨果-巴拉(Hugo Barra)宣布美版小米官网和在线商店将于不久之后正式上线</div>
            </div>
          </div>
          <?php } ?>
          <!--end-->

        </div>

      </div>
    </div>
    <!-- /count_box -->
    
  </div>
</div>
        
        
        
        
        </div>
        <!--/right-->
        



        </td>
        </tr>
        </table>
    	
        
    
    </div>
    <!--/main-->


<?php W('Admin/foot');?>