<template>
    <el-container class="main">
        <el-aside>
                <el-menu @select="selectNode" :collapse='collapsed' router default-active="/" background-color="#2D2F33" text-color="#fff" active-text-color="#409EFF">
                    
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
                    
                    <template v-for="(item,index) in $router.options.navs">
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
                    <el-tabs type="card" v-model="activeTabName">
                        <el-tab-pane name="0">
                        <span slot="label">
                            <i :class="activaIcon"></i>
                            {{activaMenu}}
                        </span>
                        <transition name="fade" mode="out-in">
                            <router-view/>
                        </transition>
                        </el-tab-pane>
                    </el-tabs>
                <div class='useroperation'>
                    <el-dropdown>
                        <span class="el-dropdown-link">
                            小甜<i class="el-icon-caret-bottom el-icon--right"></i>
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
import userhead from '../../img/userhead.jpg'
export default {
    data() {
		return {
            collapsed:false,
            userheadlink:userhead,
            activeTabName:0,
            activaIcon:'',
            activaMenu:'',
            userStatus:0
		}
    },
    methods:{
        toggleMenu:function(){
            this.collapsed=!this.collapsed;
        },
        selectNode:function(index){
            let nav = this.$router.options.navs.find(n=>n.path===index);
            this.activaIcon=nav.icon;
            this.activaMenu=nav.title;
        },
        toggleStatus:function(command){
            this.userStatus=command;
        }
    },
    mounted:function(){
        var curIndex = this.$router.currentRoute.path;
        this.selectNode(curIndex);
        this.userStatus = 1;
    }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
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
}
.el-menu:not(.el-menu--collapse){
    width:140px;
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
	transition: all .5s ease;
}
.fade-enter,.fade-leave-active {
	opacity: 0;
}
.el-tabs .el-tabs__nav{
    margin-top:10px;
    margin-left:10px;
}
</style>
