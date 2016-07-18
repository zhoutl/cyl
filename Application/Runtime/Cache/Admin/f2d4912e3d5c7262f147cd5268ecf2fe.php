<?php if (!defined('THINK_PATH')) exit(); W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

    
    <!--main-->
    <div id="main" class="clearfix">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main_table_left" align="left" valign="top">

    	<?php W('Admin/menu',array(array('admin_user_id'=>$admin_user_id)));?>
        
        </td>
        <td class="main_table_right" align="left" valign="top">


        <!--right-->
        <div id="Right">
        
        
        
        
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

        
        
        
        
        </div>
        <!--/right-->
        



        </td>
        </tr>
        </table>
            
        
    
    </div>
    <!--/main-->


<?php W('Admin/foot');?>