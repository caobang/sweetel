<template>
    <el-container class="main">
        <el-aside>
            <el-menu :collapse='collapsed' router default-active="/" @select="selectNode" background-color="#2D2F33" text-color="#fff" active-text-color="#409EFF">
                <div class="userhead">
                    <img :src="userheadlink" />
                    <el-dropdown @command="toggleStatus" style="display:block;padding-top:10px;">
                        <span class="el-dropdown-status">
                            <i class="el-icon-fa-circle" :class="{online:userStatus==1,leave:userStatus==2,stealth:userStatus==3,offline:userStatus==0}"></i>
                        </span>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item command="1">在线</el-dropdown-item>
                            <el-dropdown-item command="2">离开</el-dropdown-item>
                            <el-dropdown-item command="3">隐身</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </div>

                <div @click.prevent="toggleMenu" class="collapse-btn">
                    <i class="el-icon-fa-navicon" ></i>
                </div>
                    
                <template v-for="(item,index) in menus">
                    <el-submenu v-if="item.children" :index="item.path" :key="item.path" >
                        <template slot="title"><i :class="item.icon"></i><span slot="title">{{item.title}}</span>
                        </template>
                        <el-menu-item v-for="child in item.children" :index="child.path" :key="child.path">{{child.title}}</el-menu-item>
                    </el-submenu>
                    <el-menu-item v-if="!item.children" :index="item.path" :key="item.path" ><i :class="item.icon"></i><span slot="title">{{item.title}}</span></el-menu-item>
                </template>
            </el-menu>
        </el-aside>
        <el-container>
            <el-main>
                <el-tabs type="card" v-model="activeTabName" @tab-remove="removeTab">
                    <el-tab-pane v-for="(item,index) in tabs" :closable="item.tabClosable" :name="String(index)" :key="item.guid">
                        <span slot="label">
                            <i v-if="item.tabIcon" :class="item.tabIcon"></i>
                            {{item.tabTitle}}
                        </span>
                        <transition v-if="index===0" name="fade" mode="out-in"><router-view/></transition>
                        <div v-if="index>0" :id="'tab'+ String(index)" v-html="item.tabContent"></div>
                    </el-tab-pane>
                </el-tabs>
                <div class='useroperation'>
                    <el-dropdown>
                        <span class="el-dropdown-link">
                            {{userinfo.name}}<i class="el-icon-caret-bottom el-icon--right"></i>
                        </span>
                            <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item command="1">个人中心</el-dropdown-item>
                            <el-dropdown-item command="2">重置密码</el-dropdown-item>
                            <el-dropdown-item command="3">锁定屏幕</el-dropdown-item>
                            <el-dropdown-item command="4">退出登录</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </div>
            </el-main>
        </el-container>
    </el-container>
</template>
<script>
import Vue from 'vue'
import bus from '../bus'
import util from '../util'
import { mapState } from 'vuex'

export default {
    data() {
		return {
            collapsed:false,
            activeTabName:"0",
            tabs:[{tabIcon:'',tabTitle:'',tabClosable:false}]
		}
    },
    computed: {
        ...mapState([
            'menus',
            'userinfo'
        ]),
        userStatus(){
            return this.userinfo.status
        },
        userheadlink(){
	        let userhead = this.userinfo.userhead
            return userhead?userhead:require('../../img/userhead.jpg')
        }

    },
    methods:{
        toggleMenu:function(){
            this.collapsed=!this.collapsed;
        },
        toggleStatus:function(command){
            //this.userStatus=command;
        },
        selectNode:function(index){
            let nav = this.menus.find(n=>n.path===index);
            this.tabs[0].tabIcon=nav.icon;
            this.tabs[0].tabTitle=nav.title;
            this.activeTabName = "0";
        },
        removeTab:function(tabName){
            let num = Number(tabName);
            let activenum = Number(this.activeTabName);
            this.tabs.splice(num,1);
            this.activeTabName = activenum>num?String(activenum - 1):activenum===num&&num>this.tabs.length-1?String(num-1):String(activenum);
        }
    },
    mounted:function(){
        this.$store.dispatch('initApp').then(() => {
            var curIndex = this.$router.currentRoute.path
            this.selectNode(curIndex)
        })
    },
    created:function(){
        bus.$on('addTab', (tab,open) => {
            tab = tab || {};
            tab.guid = util.guid();
            tab.tabTitle = tab.tabTitle || '标签页';
            this.tabs.push(tab);
            let tabName = String(this.tabs.length - 1);
            if(tab.tabComponent){
                this.$nextTick(function () {
                    let c =new Vue({
                        render: h => h(tab.tabComponent)
                    }).$mount('#tab'+tabName);
                });
            }
            if(open){
                this.activeTabName = tabName;
            }
        })
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.main{
    position:absolute;
    bottom:0;
    top:0;
    left:0;
    right:0;
}
.el-aside{
    width:auto !important;
    overflow: inherit;
}
.el-menu{
    height:100%;
    border-right:none;
}
.el-menu:not(.el-menu--collapse){
    width:150px;
}
.el-main{
    padding:0px;
}
.collapse-btn{
    height:30px;
    line-height:30px;
    text-align:center;
    color:#878d99;
    cursor: pointer;
}
.collapse-btn:hover{
    background-color:#242629;
    color:#fff;
}
.el-menu .el-menu-item:not(.is-active):hover i,.el-menu .el-submenu:hover .el-submenu__title i{
    color: #fff;

}
.el-dropdown-link{
    cursor: pointer;
    color: #409EFF;
}
.el-dropdown-status{
    cursor: pointer;
    color: #fff;
    font-size: 12px;
}
.el-dropdown-status i.online{
    color: #67C23A;
}
.el-dropdown-status i.leave{
    color: #FA5555;
}
.el-dropdown-status i.stealth{
    color: #EB9E05;
}
.el-dropdown-status i.offline{
    color: #878D99;
}
.useroperation{
    position:absolute;
    right:10px;
    top:0px;
    height:50px;
    line-height:50px;
}
.useroperation .el-dropdown{
    display:block;
}
.userhead{
    padding:10px;
    text-align: center;
}
.userhead img{
    width:40px;
    height:40px;
    border-radius: 50%;
}
.fade-enter-active,.fade-leave-active {
	transition: all .2s ease;
}
.fade-enter,.fade-leave-active {
	opacity: 0;
}
</style>
