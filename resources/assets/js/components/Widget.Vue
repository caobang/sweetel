<template>
    <div style="position:fixed;z-index:2147483647;"
            :style="{
                'left':sysconfig.btnpos==='left'?sysconfig.btnsidemargin+'px':'',
                'right':sysconfig.btnpos==='right'?sysconfig.btnsidemargin+'px':'',
                'bottom':sysconfig.btnbottommargin+'px'}">
        <div style="position:absolute;height:60px;width:60px;top:-60px;border-radius:50%;background-repeat:no-repeat;box-shadow: rgba(15, 66, 76, 0.25) 0px 0px 14px 0px;"
        :style="{'left':sysconfig.btnpos==='left'?'':'-60px',
                'right':sysconfig.btnpos==='right'?'':'-60px',
                'background-image': 'url('+btnimg+')',
                'background-color':sysconfig.themecolor,
                'background-position':isopenwindow?'18px 28px':'18px -58px'}" @click="openWindow" @mouseenter ="togglebtntip(true)" @mouseleave ="togglebtntip(false)">
        </div>
        <div v-if="showbtntip&&!isopenwindow" style="height:30px;
            line-height:30px;
            position:absolute;
            border:1px solid rgb(235, 239, 240);
            color:#555556;
            white-space:nowrap;
            word-break:normal;
            top:-45px;
            box-shadow:rgba(107, 113, 114, 0.15) 0px 2px 4px 0px;
            padding:0 5px;
            border-radius:3px;
            background-color:#fff;"
            :style="{
                'left':sysconfig.btnpos==='left'?'70px':'',
                'right':sysconfig.btnpos==='right'?'70px':''}">
            <span v-text="sysconfig.btntip"></span>
        </div>
        <iframe v-show="isopenwindow" :src="iframesrc" style="position:absolute;
                    border:0;
                    bottom:70px;
                    width:350px;
                    height:500px;box-shadow:rgba(15, 66, 76, 0.25) 0px 0px 24px 0px;"
            :style="{
                'left':sysconfig.btnpos==='left'?'0px':'',
                'right':sysconfig.btnpos==='right'?'0px':''}"/>
        
    </div>
</template>

<script>
import util from '../util';
export default {
    data () {
        return {
            btnimg:"http://localhost:8000/img/widget/icon-btn.png",
            isopenwindow:false,
            showbtntip:false,
            clientinfo:{
                baseUrl:'/',
                sid:'',
                ismobile:false
            },
            sysconfig:{
                themecolor: '',
                btnpos:'',
                btnsidemargin:'',
                btnbottommargin:'',
                btntip:''
            }
        }
    },
    computed:{
        iframesrc:function(){
            let client=this.clientinfo.ismobile?'mobile':'pc'
            return `${this.clientinfo.baseUrl}chat/${client}?${this.clientinfo.sid}`
        }
    },
    methods:{
        openWindow:function(){
            this.isopenwindow=!this.isopenwindow;
        },
        togglebtntip:function(flag){
            this.showbtntip=flag;
        }
    },
    mounted:function(){
        let url = util.getCurrentScriptUrl()
        this.clientinfo.baseUrl=util.getBaseUrl(url)
        this.clientinfo.sid=util.getUrlParams(url)
        this.clientinfo.ismobile=util.isMobile()

        this.sysconfig.themecolor='#13C9CB';
        this.sysconfig.btnpos='right';
        this.sysconfig.btnsidemargin='20';
        this.sysconfig.btnbottommargin='10';
        this.sysconfig.btntip='咨询在线客服2';

        window.closeWindow=()=>{this.isopenwindow=false;}

        /*
        let vm=this;

        let callbackname= 'callback'+Date.now()
        window[callbackname] = (themecolor,btnpos,btnsidemargin,btnbottommargin,btntip)=>{
            vm.sysconfig.themecolor=themecolor
            vm.sysconfig.btnpos=btnpos
            vm.sysconfig.btnsidemargin=btnsidemargin
            vm.sysconfig.btnbottommargin=btnbottommargin
            vm.sysconfig.btntip=btntip
        }
        //let scriptUrl=this.clientinfo.baseUrl+'loadSystemConfig?sid='+this.clientinfo.sid+'&callback='+callbackname
        let scriptUrl = 'http://localhost:5000/loadSystemConfig?sid='+this.clientinfo.sid+'&callback='+callbackname
        util.loadScript(scriptUrl);
        */
    }
}
</script>
