$(document).ready(function(){
	var start_time = {
		elem: '#start_time',
		format: 'YYYY-MM-DD hh:mm:ss',
		istime: true, //是否开启时间选择
        isclear: true, //是否显示清空
        istoday: true, //是否显示今天
		choose: function(datas){
			 end_time.min = datas; //开始日选好后，重置结束日的最小日期
			 end_time.start = datas //将结束日的初始值设定为开始日
		}
	};
	
	var end_time = {
		elem: '#end_time',
		format: 'YYYY-MM-DD hh:mm:ss',
		istime: true, //是否开启时间选择
        isclear: true, //是否显示清空
        istoday: true, //是否显示今天
		choose: function(datas){
			start_time.max = datas; //结束日选好后，重置开始日的最大日期
		}
	};

	laydate(start_time);
	laydate(end_time);
});
