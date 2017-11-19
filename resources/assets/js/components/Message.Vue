<template>
    <div style="padding:0 10px 10px 10px;overflow:hidden;">
        <div style="overflow:hidden;color:#B2B2B2;margin-bottom:2px;">
            <span :class="self?'msg-self':'msg'" style="word-break:normal;white-space:nowrap;max-width:150px;text-overflow:ellipsis;overflow:hidden;">{{username}}</span>
            <span :class="self?'msg-self':'msg'">&nbsp;</span>
            <span :class="self?'msg-self':'msg'">{{datetime}}</span>
        </div>
        <div :class="self?'content-self':'content'" style="max-width:80%;border-radius:3px;padding:10px;font-size:13px;line-height:18px;">
            {{content}}
        </div>
    </div>
      
        <!--<div style="height:20px;">{{username}} {{datetime}}</div>
        <div style="background-color:#fff;float:left;paddding:20px;border:1px solid 1px solid #f0f0f0;border-radius：3px;">{{content}}</div>
    -->
</template>
<script>

export default {
    props: ['username', 'datetime', 'content', 'self'],
    data () {
        return {
            
        }
    },
    methods:{
        
        
    },
    mounted:function(){
        
        
        
    }
    
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style >
.msg{
    float:left;
}
.msg-self{
    float:right;
}
.content{
    float:left;
    background-color:#fff;
    border:1px solid #ddd;
}
.content-self{
    float:right;
    background-color:#13C9CB;
    color:#fff;
    border:none;
}
</style>
