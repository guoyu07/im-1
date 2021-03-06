

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>发现</title>
    <link rel="stylesheet" href="{{asset('static/layui/css/layui.css')}}">
    <style type="text/css">
        .layui-find-list li img {
            position: absolute;
            left: 15px;
            top: 8px;
            width: 36px;
            height: 36px;
            border-radius: 100%;
        }
        .layui-find-list li {
            position: relative;
            height: 90px;;
            padding: 5px 15px 5px 60px;
            font-size: 0;
            cursor: pointer;
        }
        .layui-find-list li * {
            display: inline-block;
            vertical-align: top;
            font-size: 14px;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .layui-find-list li span {
            margin-top: 4px;
            max-width: 155px;
        }

        .layui-find-list li p {
            display: block;
            line-height: 18px;
            font-size: 12px;
            color: #999;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .back{
            cursor:pointer;
        }
        .lay_page{position: fixed;bottom: 0;margin-left: -15px;margin-bottom: 20px;background: #fff;width: 100%;}
        .layui-laypage{width: 105px;margin:0 auto;display: block}
    </style>
    <script src="{{asset('static/layui/layui.js')}}"></script>
    <script>
        layui.use([ 'layim','laypage','form'], function(){
            var layim = layui.layim
                , layer = layui.layer
                , laytpl = layui.laytpl
                ,form = layui.form
                ,$ = layui.jquery
                ,laypage = layui.laypage;
            // var url = '../../../../../../'+cache.base.getRecommend.url || {};  //获得URL参数。

            $(function(){getRecommend(); });
            function getRecommend(){
                //测试数据
                var data = {
                    "code": 0,
                    "msg": "",
                    "data": [
                        {
                            "memberIdx": "122",
                            "memberName": "1",
                            "signature": "",
                            "memberAge": "1",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/1570845.jpg'
                        },
                        {
                            "memberIdx": "3",
                            "memberName": "3",
                            "signature": "",
                            "memberAge": "3",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/1570845.jpg'
                        },
                        {
                            "memberIdx": "1",
                            "memberName": "11",
                            "signature": "",
                            "memberAge": "1",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/1570845.jpg'
                        },
                        {
                            "memberIdx": "910992",
                            "memberName": "清风",
                            "signature": "星光灿烂",
                            "memberAge": "23",
                            "memberSex": "1"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/910992.jpg'
                        },
                        {
                            "memberIdx": "12",
                            "memberName": "1",
                            "signature": "",
                            "memberAge": "1",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/1570845.jpg'
                        },
                        {
                            "memberIdx": "911088",
                            "memberName": "豆浆",
                            "signature": "本人是一个开朗的人",
                            "memberAge": "25",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/911088.jpg'
                        },
                        {
                            "memberIdx": "911067",
                            "memberName": "爱咋咋地",
                            "signature": "一个优秀的人",
                            "memberAge": "18",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/911067.jpg'
                        },
                        {
                            "memberIdx": "1570855",
                            "memberName": "回眸淡然笑",
                            "signature": "有钱的自由，没钱的幻想！",
                            "memberAge": "20",
                            "memberSex": "2"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/1570855.jpg'
                        },
                        {
                            "memberIdx": "911117",
                            "memberName": "美的不要不要的",
                            "signature": "The world makes way for the man who knows where he is going.",
                            "memberAge": "21",
                            "memberSex": "2"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/911117.jpg'
                        },
                        {
                            "memberIdx": "1570868",
                            "memberName": "圆圆",
                            "signature": "各有各的活法",
                            "memberAge": "40",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/empty2.jpg'
                        },
                        {
                            "memberIdx": "911085",
                            "memberName": "清晨",
                            "signature": "你不进步就在后退，不做温水里的癞疙宝",
                            "memberAge": "48",
                            "memberSex": "2"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/911085.jpg'
                        },
                        {
                            "memberIdx": "911100",
                            "memberName": "等待",
                            "signature": "陪伴是最长情的告白",
                            "memberAge": "19",
                            "memberSex": "2"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/911100.jpg'
                        },
                        {
                            "memberIdx": "911058",
                            "memberName": "实力派",
                            "signature": "善 是一个美好",
                            "memberAge": "30",
                            "memberSex": "1"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/911058.jpg'
                        },
                        {
                            "memberIdx": "1570845",
                            "memberName": "花海",
                            "signature": "我就不写签名< (ˉ^ˉ)>",
                            "memberAge": "20",
                            "memberSex": "1"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/1570845.jpg'
                        },
                        {
                            "memberIdx": "22",
                            "memberName": "2",
                            "signature": "",
                            "memberAge": "2",
                            "memberSex": "0"
                            ,"avatar": 'http://ossguoshan.oss-cn-shanghai.aliyuncs.com/1570845.jpg'
                        }
                    ]
                };
                // $.get(url,{type:'get'},function(res){
                // var data = eval('(' + res + ')');
                var html = laytpl(LAY_tpl.value).render({
                    data: data.data,
                    legend:'推荐好友',
                    type:'friend'
                });
                $('#LAY_view').html(html);
                // });
            }
            $('body').on('click', '.add', function () {//添加好友
                var othis = $(this), type = othis.data('type');
                //弹出添加好友框
                // parent.layui.im.addFriendGroup(othis,type);
            });
            //下一篇分享创建群的html
            // $('body').on('click', '.createGroup', function () {//创建群
            //     var othis = $(this);
            //     parent.layui.im.createGroup(othis);
            // });
            $('body').on('click', '.back', function () {//返回推荐好友
                getRecommend();
                $("#LAY_page").css("display","none");
            });

            $("body").keydown(function(event){
                if(event.keyCode==13){
                    $(".find").click();
                }
            });
            $('body').on('click', '.find', function () {
                $("#LAY_page").css("display","block");
                var othis = $(this),input = othis.parents('.layui-col-space3').find('input').val();
                var addType = $('input:radio:checked').val();
                console.log(input);
                // if (input) {
                //这里需要从服务器获取数据然后进行填充
                //以下为示例
                // 		var url = '../../../../../../'+cache.base.findFriendTotal.url || {};
                // $.get(url,{type:addType,value:input}, function(data){
                // 	var res = eval('(' + data + ')');
                // 	if(res.code != 0){
                // 	    return layer.msg(res.msg);
                // 	}
                // 	laypage.render({
                // 	  elem: 'LAY_page'
                // 	  ,count: res.data.count
                // 	  ,limit: res.data.limit
                // 	  ,prev: '<i class="layui-icon">&#58970;</i>'
                // 	  ,next: '<i class="layui-icon">&#xe65b;</i>'
                // 	  ,layout: ['prev', 'next']
                // 	  ,curr: res.data.limit
                // 	  ,jump: function(obj, first){
                // 	    //obj包含了当前分页的所有参数，比如：
                // 	    var url = '../../../../../../'+cache.base.findFriend.url || {};
                // 	    //首次不执行
                // 	    if(first){
                // 	      var page = res.data.limit;
                // 	    }else{
                // 	      var page = obj.curr;
                // 	    }
                // 		$.get(url,{type:addType,value:input,page: obj.curr || 1},function(res){
                // 		  	var data = eval('(' + res + ')');
                // 			var html = laytpl(LAY_tpl.value).render({
                // 			    data: data.data,
                // 			    legend:'<a class="back"><i class="layui-icon">&#xe65c;</>返回</a> 查找结果',
                // 			    type:addType
                // 			});
                // 			$('#LAY_view').html(html);
                // 	  	});
                // 	  }
                // 	});
                // });
                //      }
            });
        });
    </script>
</head>
<body>
<div class="layui-form">
    <div class="layui-container" style="padding:0">
        <div class="layui-row layui-col-space3">
            <div class="layui-col-xs7 mt15">
                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入会员号/昵称/手机号/邮箱" class="layui-input">
            </div>
            <div class="layui-col-xs1 mt15" >
                <button class="layui-btn btncolor find">查找</button>
            </div>

            <div class="layui-col-xs3 mt15">
                <input type="radio" name="add" value="friend" title="找人" checked="">
                <input type="radio" name="add" value="group" title="找群">
                <button class="layui-btn layui-btn-mini btncolor createGroup" >我要建群</button>
            </div>
        </div>
        <div id="LAY_view"></div>
        {{--<textarea title="消息模版" id="LAY_tpl" style="display:none;">--}}
			{{--<fieldset class="layui-elem-field layui-field-title">--}}
			  {{--<legend>{{ d.legend}}</legend>--}}
			{{--</fieldset>--}}
			{{--<div class="layui-row ">--}}
				{{--{{# if(d.type == 'friend'){ }}--}}
                {{--{{#  layui.each(d.data, function(index, item){ }}--}}
                {{--<div class="layui-col-xs3 layui-find-list">--}}
						{{--<li layim-event="add" data-type="friend" data-index="0" data-uid="{{ item.memberIdx }}" data-name="{{item.memberName}}">--}}
							{{--<img src="{{item.avatar}}">--}}
							{{--<span>{{item.memberName}}({{item.memberIdx}})</span>--}}
							{{--<p>{{item.signature}}  {{#  if(item.signature == ''){ }}我很懒，懒得写签名{{#  } }} </p>--}}
							{{--<button class="layui-btn layui-btn-mini btncolor add" data-type="friend"><i class="layui-icon">&#xe654;</i>加好友</button>--}}
						{{--</li>--}}
					{{--</div>--}}
                {{--{{#  }); }}--}}
                {{--{{# }else{ }}--}}
                {{--{{#  layui.each(d.data, function(index, item){ }}--}}
                {{--<div class="layui-col-xs3 layui-find-list">--}}
						{{--<li layim-event="add" data-type="group" data-approval="{{ item.approval }}" data-index="0" data-uid="{{ item.groupIdx }}" data-name="{{item.groupName}}">--}}
							{{--<img src="{{item.groupIdx}}.jpg">--}}
							{{--<span>{{item.groupName}}({{item.groupIdx}})</span>--}}
							{{--<p>{{item.des}}  {{#  if(item.des == ''){ }}无{{#  } }} </p>--}}
							{{--<button class="layui-btn layui-btn-mini btncolor add" data-type="group"><i class="layui-icon">&#xe654;</i>加群</button>--}}
						{{--</li>--}}
					{{--</div>--}}
                {{--{{#  }); }}--}}
                {{--{{# } }}--}}
			{{--</div>--}}
        {{--</textarea>--}}

        <div class="lay_page" id="LAY_page" ></div>
    </div>
</div>
</body>
</html>
