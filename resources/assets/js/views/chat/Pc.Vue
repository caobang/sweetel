<template>
    <div>
        <div style="position:absolute;right:0;left:0;height:60px;background-color:#13C9CB;color:#fff;border-radius:0;">
            <div style="padding-top:10px;">
                <img style="margin:0 10px;float:left;background-color:#fff;width: 40px;height: 40px;border-radius: 20px;" src="/img/logo.png" />
                <div style="float:left;">
                    <div style="word-break:normal;white-space:nowrap;max-width:150px;display:block;margin:0;padding:0;text-overflow:ellipsis;overflow:hidden;">机器人小甜</div>
                    <div style="font-size:12px;word-break:normal;white-space:nowrap;max-width:200px;display:block;margin:0;padding:0;text-overflow:ellipsis;overflow:hidden;">小甜为你服务</div>
                </div>
                <div style="float:right;margin-right:10px;">
                    <i class="btn" style="background-position:-22px -89px;"></i><i class="btn" style="background-position:-22px -66px;" @click="hideWindow"></i>
                </div>
            </div>
        </div>
        <div ref="messageContainer" style="position:absolute;top:60px;bottom:120px;left:0px;right:0px;background-color:#FAFDFF;font-size:12px;padding-top:10px;overflow:auto;">
            <Message v-for ="msg in messages" :key="msg.id" :username="msg.username" :datetime="msg.datetime" :content="msg.content" :self="msg.self" />
            
        </div>
        <div style="font-size:12px;position:absolute;bottom:0;right:0;left:0;background-color:#FAFDFF;border-top:1px solid #ddd">
            <div style="height:40px;">
                <div style="padding:10px 10px 0px 10px;">
                    <i class="btn" style="background-position:0 0;"></i>
                    <i class="btn" style="background-position:0px -22px;"></i>
                    <span style="float:right;color:#13C9CB;cursor:pointer;">转人工服务</span>
                </div>
            </div>
            <div style="padding:0 10px;">
                <textarea v-model="inputcontent" placeholder="请简短描述您的问题" style="height:40px;border:0;padding:0;resize:none;display:inherit;outline:none;width:100%;background-color:transparent;"/>
            </div>
            <div style="height:40px;">
                <div style="padding:10px 0 0 10px;float:left;">
                    <span style="color:#ddd;">甜心客服提供软件服务</span>
                </div>
                <button :class="inputcontent.length>0?'sendmsg':'sendmsg-disabled'" style="float:right;height:30px;margin:5px 10px 0 0;border-radius:3px;outline:none;" @click="sendMessage">发送</button>
            </div>
            <!--<div style="padding:10px;height:20px;line-height:20px;">
                <i class="btn" style="background-position:0 0;"></i>
                <i class="btn" style="background-position:0px -22px;"></i>
                <span style="float:right;color:#13C9CB;cursor:pointer;">转人工服务</span>
            </div>
            <div style="height:30px;">
                <textarea style="height:28px;"/>
            </div>
            <div style="padding:10px;height:20px;line-height:20px;">
                <span style="color:#ddd;">甜心客服提供软件服务</span><button style="float:right;background-color:#ddd;color:#000">发送</button>
            </div>-->
        </div>
    </div>
</template>
<script>
import util from '../../util';
import Message from '../../components/Message'
import {apiwidget} from '../../api'
export default {
    
    sockets:{
        connect: function(){
            console.log('socket connected')
            this.messages.push({username:'小甜',datetime:Date.now(),content:'您好，请问您有什么问题',self:false})
                this.$nextTick(function () {
                    var mContainer = this.$refs.messageContainer
                    mContainer.scrollTop = mContainer.scrollHeight;
                })
        },
        message: function(content){
            console.log('this method was fired by the socket server. eg: io.emit("customEmit", data)')
            this.messages.push({username:'小甜',datetime:Date.now(),content:content,self:false})
                this.$nextTick(function () {
                    var mContainer = this.$refs.messageContainer
                    mContainer.scrollTop = mContainer.scrollHeight;
                })
        },
        info: function(content){
            console.log(content)
            this.socketid=content
            apiwidget.connection({socketid:content}).then((data)=>{
                this.chatid=data.chatid
            })
        }
    },
    data () {
        return {
            chatid:0,
            socketid:0,
            clientinfo:{
                sid:''
            },
            messages:[
               /* {msgid:1,username:'小萨芬分hi哦我还萨娜首付款挪威克朗方法是懦夫甜34234234234234',datetime:'12:33:43',content:'asas',self:true},
                {msgid:2,username:'小甜',datetime:'12:33:43',content:'我还萨娜首付款挪',self:false},
                {msgid:3,username:'小甜',datetime:'12:33:43',content:'我还萨娜首付款挪',self:true},
                {msgid:3,username:'小甜',datetime:'12:33:43',content:'我还萨娜首付款挪',self:true},
                {msgid:3,username:'小甜',datetime:'12:33:43',content:'我还萨娜首付款挪',self:true},
                {msgid:3,username:'小甜',datetime:'12:33:43',content:'我还萨娜首',self:false},
                {msgid:3,username:'小甜',datetime:'12:33:43',content:'我还萨娜首付款挪',self:true},
                {msgid:4,username:'小甜',datetime:'12:33:43',content:'我还萨娜首付款挪',self:false}*/
            ],
            inputcontent:''
        }
    },
    methods:{
        hideWindow:function(){
            window.opener=null;
            window.open('','_self');
            window.close();
            parent.closeWindow&&parent.closeWindow();
        },
        sendMessage:function(e){
            if(this.inputcontent.length>0){
                this.messages.push({username:'',datetime:'12:33:43',content:this.inputcontent,self:true})
                apiwidget.sendMessage({chatid:this.chatid,socketid:this.socketid,content:this.inputcontent})
                //this.$socket.send(this.inputcontent);
                this.inputcontent=''
                this.$nextTick(function () {
                    var mContainer = this.$refs.messageContainer
                    mContainer.scrollTop = mContainer.scrollHeight;
                })
            }
        }
    },
    mounted:function(){
        this.clientinfo.sid=util.getUrlParams(window.location.href)
        
    },
    components: { Message }
    
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style >
body {
    margin:0px;
    font-size:14px;
    line-height:18px;
}
.btn{
    background-image:url("/img/chat/icon-btn.png");
    cursor: pointer;
    background-repeat:no-repeat;
    display:inline-block;
    width:22px;
    height:22px;
    opacity:0.8;
}
.btn:hover{
    opacity:1;
}
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    #B2B2B2;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #B2B2B2;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #B2B2B2;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    #B2B2B2;
}
.sendmsg{
    cursor:pointer;
    background-color:#13C9CB;
    color:#fff;
    border:1px solid transparent;
}
.sendmsg-disabled{
    cursor:default;
    background-color:#ddd;
    color:#B2B2B2;
    border:1px solid #ddd;
}       
</style>
