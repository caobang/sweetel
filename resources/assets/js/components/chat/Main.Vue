<template>
    <el-container>
        <el-aside width="250px" style="margin-left:15px;">
            <el-tabs type="border-card">
                <el-tab-pane label="当前会话">
                    <div class="chatli" style="line-height:70px;padding:0 10px;color:#5a5e66;font-size:14px;cursor:pointer;" >
                        <div style="display:inline-block;line-height:35px;text-align:center;height:35px;width:35px;background-color:#409EFF; border-radius:50%;color:#fff;"><i class="el-icon-fa-television"></i></div>
                        <!--<i class="el-icon-fa-television" style="height:30px;width:30px;background-color:#409EFF; border-radius:50%;color:#fff;"></i>
                        -->南昌用户
                        <span style="float:right;">11:22:45</span>
                    </div>
                    
                    <div class="chatli current" style="line-height:70px;padding:0 10px;color:#5a5e66;font-size:14px;cursor:pointer;" >
                        <div style="display:inline-block;line-height:35px;text-align:center;height:35px;width:35px;background-color:#409EFF; border-radius:50%;color:#fff;"><i class="el-icon-fa-television"></i></div>
                        南昌用户
                        <span style="float:right;">11:22:45</span>
                    </div>
                <!--<el-table ref="table" v-loading="userLoading" @sort-change="sortChange" :default-sort="defaultSort" highlight-current-row 
                    :data="userData.list" style="" :show-header="false" :row-style="{'height':'70px'}">
                    <el-table-column align="left">
                        <template slot-scope="scope">
                            <i class="el-icon-fa-television"></i>
                            <el-badge :value="10" :max="99" class="item">
                            <el-button >评论</el-button> 
                            </el-badge>
                            <el-button size="mini" type="primary" @click="openUserDialog(scope.row)">编辑</el-button>
                            <el-button size="mini" type="danger" @click="delUser(scope.row.id)">删除</el-button>
                        </template>
                    </el-table-column>-->
                </el-table>
                </el-tab-pane>
                <el-tab-pane label="历史记录">
                历史会话<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />历史记录<br />
                </el-tab-pane>
            </el-tabs>
            
            
        </el-aside>
        <el-container style="width:0;">
            <el-main>
                
    <el-button @click="setCurrent()">取消选择</el-button>
                
            </el-main>
        </el-container>
    </el-container>
</template>

<script>

    import util from '../../util'
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
                filterText:'',
                defaultProps:{children: 'children',label: 'name'},
                searchForm:{username:''},
                groupDialogTitle:'',
                groupDialogVisible:false,
                groupForm:{id:0,name:'',parentid:0},
                groupFormRules: {
                    name: [
                        { required: true, message: '请输入分组名称' }
                    ]
                },
                userDialogTitle:'',
                userDialogVisible:false,
                userFormGroupOptions:[1],
                userForm:{id:0,name:'',email:'',usergroupid:1,roleid:1},
                userFormRules: {
                    name: [
                        { required: true, message: '请输入用户名' }
                    ],
                    email: [
                        { required: true, type: 'email',message: '请输入登录邮箱' }
                    ],
                    usergroupid: [
                        { required: true, message: '请选择用户组' }
                    ],
                    roleid: [
                        { required: true, message: '请选择权限' }
                    ]
                },
                defaultSort:{prop:'created_at',order:'descending'},
                currentSort:{prop:null,order:null},
                paginationSize:10,
                currentPage:1,
                userLoading:false
            }
        },
        
        computed: {
            ...mapState({
                userGroups:state => state.user.userGroups,
                roles:state => state.user.roles,
                userData:state => state.user.userData
            }),
            userGroupsTreeData(){
                return util.toTreeData(this.userGroups,'parent_id')
            },
        },
        watch: {
            filterText(val) {
                this.$refs.tree.filter(val);
            }
        },
        methods: {
            setCurrent(){
                this.$refs.table.setCurrentRow()
            },
            filterNode(value, data) {
                if (!value) return true;
                return data.name.indexOf(value) !== -1;
            },
            renderContent(h, { node, data, store }){
                var self = this
                return h('span', {attrs:{class:'el-tree-node__label'}},[
                            data.name,h('div',{attrs:{style:'position:absolute;top:0;right:15px;line-height:26px;'}},[
                                h('i',{attrs:{class:'el-icon-plus'},on:{click:function (event) {event.stopPropagation();self.openGroupDialog(data,true)}}}),
                                data.team_id>0?h('i',{attrs:{class:'el-icon-edit-outline'},on:{click:function (event) {event.stopPropagation();self.openGroupDialog(data)}}}):'',
                                node.isLeaf&&data.team_id>0?h('i',{attrs:{class:'el-icon-delete'},on:{click:function (event) {event.stopPropagation();self.delGroup(data.id)}}}):''
                            ])
                        ])
            },
            openGroupDialog(group,add){
                if(add){
                    this.groupDialogTitle="添加分组"
                    this.groupForm.parentid=group.id
                    this.groupForm.id=0
                    this.groupForm.name=''

                }else{
                    this.groupDialogTitle="编辑分组"
                    this.groupForm.id=group.id
                    this.groupForm.name=group.name
                }
                this.groupDialogVisible = true
            },
            saveGroup(){
                this.$refs.groupForm.validate((valid) => {
                    if (valid) {
                        let actionName = this.groupForm.id===0?'addUserGroup':'editUserGroup'
                        this.$store.dispatch(actionName,this.groupForm).then((data)=>{
                            console.log(data)
                            this.groupDialogVisible = false
                            this.$message({
                                showClose: true,
                                message: '用户分组保存成功',
                                type: 'success'
                            });
                            this.filterText=''
                            let currerntKey=this.$refs.tree.getCurrentKey()
                            this.$store.dispatch('loadUserGroups').then(()=>{
                                this.$refs.tree.setCurrentKey(currerntKey)
                            })
                        })
                    }
                })
            },
            delGroup(id){
                this.$confirm('确认删除分组？', '提示',{type: 'warning'}).then(() => {
                    this.$store.dispatch('delUserGroup',id).then(()=>{
                        this.$message({
                            showClose: true,
                            message: '用户分组删除成功',
                            type: 'success'
                        });
                        this.filterText=''
                        this.$store.dispatch('loadUserGroups')
                    })
                })
            },
            nodeClick(data){
                this.currentPage=1
                this.$refs.table.clearSort()
                this.currentSort.prop=this.defaultSort.prop
                this.currentSort.order=this.defaultSort.order
                this.loadData()
            },
            currentChange(currentPage){
                this.currentPage=currentPage
                this.loadData()
            },
            sortChange({column, prop, order}){
                this.currentPage=1
                this.currentSort.prop=prop
                this.currentSort.order=order
                this.loadData()
            },
            loadData(){
                let prop=prop||this.currentSort.prop||this.defaultSort.prop
                let order=order||this.currentSort.order||this.defaultSort.order
                this.userLoading=true
                let params={
                    usergroupid:this.$refs.tree.getCurrentKey(),
                    name:this.searchForm.username,
                    size:this.paginationSize,
                    page:this.currentPage,
                    orderby:prop,
                    sort:order==='ascending'?'asc':'desc'
                }
                this.$store.dispatch('loadPagingUsers',params).then(()=>{
                    this.userLoading=false
                })
            },
            searchUser(){
                this.currentPage=1
                this.$refs.table.clearSort()
                this.currentSort.prop=this.defaultSort.prop
                this.currentSort.order=this.defaultSort.order
                this.loadData()
            },
            openUserDialog(user,add){
                if(add){
                    this.userDialogTitle="添加用户"
                    this.userForm.id=0
                    this.userForm.name=''
                    this.userForm.email=''
                    this.userFormGroupOptions=[1]
                    this.userForm.roleid=1

                }else{
                    this.userDialogTitle="编辑用户"
                    this.userForm.id=user.id
                    this.userForm.name=user.name
                    this.userForm.email=user.email
                    this.userFormGroupOptions=util.getParentKeys(this.userGroups,'parent_id',user.usergroup_id)
                    this.userForm.roleid=user.role_id
                }
                this.userDialogVisible = true;
            },
            groupChange(val){
                this.userForm.usergroupid=this.userFormGroupOptions[this.userFormGroupOptions.length - 1]
            },
            saveUser(){
                this.$refs.userForm.validate((valid) => {
                    if (valid) {
                        let actionName = this.userForm.id===0?'addUser':'editUser'
                        this.$store.dispatch(actionName,this.userForm).then((data)=>{
                            this.userDialogVisible = false
                            this.$message({
                                showClose: true,
                                message: '用户保存成功',
                                type: 'success'
                            });
                            this.currentPage=1
                            this.loadData()
                        })
                    }
                })
            },
            delUser(id){
                this.$confirm('确认删除用户？', '提示',{type: 'warning'}).then(() => {
                    this.$store.dispatch('delUser',id).then(()=>{
                        this.$message({
                            showClose: true,
                            message: '用户删除成功',
                            type: 'success'
                        });
                        this.currentPage=1
                        this.loadData()
                    })
                })
            }
        },
        mounted() {
                let prop=prop||this.currentSort.prop||this.defaultSort.prop
                let order=order||this.currentSort.order||this.defaultSort.order
            let params={
                    usergroupid:0,
                    name:'',
                    size:10,
                    page:1,
                    orderby:prop,
                    sort:order==='ascending'?'asc':'desc'
                }
                this.$store.dispatch('loadPagingUsers',params)
        }
    }
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.el-main{
    padding-top:;
}
.el-tab-pane{
    min-height:500px;
    max-height:800px;
    overflow:auto;
}
.chatli{
    height:70px;
    border-bottom:1px solid #D8DCE5;
}
.chatli:hover{
    background-color:#ecf5ff;
}
.chatli.current{
    background-color:#ecf5ff;
}
</style>
