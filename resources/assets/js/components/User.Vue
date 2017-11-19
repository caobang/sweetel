<template>
    <el-container>
        <el-aside width="250px" style="border:1px solid #D8DCE5;margin-left:15px;">
            <div style="padding-left:15px;font-size:14px;font-weight:bold;color:#5a5e66;background-color:#f5f7fa;border-bottom:1px solid #D8DCE5;line-height:40px;" >
                用户分组
                <span style="float:right;margin-right:10px;"><i style="cursor:pointer;" class="el-icon-plus" @click="openGroupDialog({id:0},true)"></i></span>
            </div>
            <el-input size="small" prefix-icon="el-icon-search" style="margin:15px 15px 0 15px ;width:auto;" placeholder="输入分组名称进行过滤" v-model="filterText" ></el-input>
            <el-tree node-key='id' @node-click="nodeClick" :render-content="renderContent" style="padding:15px 0px 15px 0;min-height:400px;max-height:700px;overflow:auto;" highlight-current ref="tree" :data="userGroupsTreeData" :props="defaultProps" default-expand-all :filter-node-method="filterNode"></el-tree>

            <el-dialog :modal-append-to-body='false' :modal='true' width="500px" :title="groupDialogTitle" :visible.sync="groupDialogVisible">
                <el-form ref="groupForm" style="width:400px;" label-width="100px" size="small" :model="groupForm" :rules="groupFormRules">
                    <el-form-item label="分组名称" prop="name">
                        <el-input v-model="groupForm.name"></el-input>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button size="small" @click="groupDialogVisible = false">取消</el-button>
                    <el-button size="small" type="primary" @click="saveGroup">确定</el-button>
                </div>
            </el-dialog>
            
        </el-aside>
        <el-container style="width:0;">
            <el-main>
                <el-dialog :modal-append-to-body='false' width="500px" :title="userDialogTitle" :visible.sync="userDialogVisible">
                    <el-form ref="userForm" style="width:400px;" label-width="100px" size="small" :model="userForm" :rules="userFormRules">
                        <el-form-item label="用户名" prop="name">
                            <el-input v-model="userForm.name"></el-input>
                        </el-form-item>
                        <el-form-item label="登陆邮箱" prop="email">
                            <el-input v-model="userForm.email"></el-input>
                        </el-form-item>
                        <el-form-item label="用户组" prop="groupid">
                            <el-select style="display:block;" v-model="userForm.groupid" placeholder="请选择">
                                <el-option v-for="item in userGroups" :key="item.id" :value="item.id" :label="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="用户角色" prop="roleid">
                            <el-select style="display:block;" v-model="userForm.roleid" placeholder="请选择">
                                <el-option v-for="item in roles" :key="item.id" :value="item.id" :label="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-form>
                    <div slot="footer" class="dialog-footer">
                        <el-button size="small" @click="userDialogVisible = false">取消</el-button>
                        <el-button size="small" type="primary" @click="saveUser">确定</el-button>
                    </div>
                </el-dialog>
                <el-form :inline="true" :model="searchForm" size="small">
                    <el-form-item>
                        <el-input placeholder="用户名" v-model="searchForm.username" ></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" icon="el-icon-search" @click="searchUser">查询</el-button>
                        <el-button type="primary" icon="el-icon-plus" @click="openUserDialog({},true)">添加</el-button>
                    </el-form-item>
                </el-form>
                <el-table ref="table" v-loading="userLoading" @sort-change="sortChange" :default-sort="defaultSort" size="small" max-height='800' border :header-row-style="{'background-color':'#f5f7fa','color':'#5a5e66'}"
                    :data="userData.list" style="">
                    <el-table-column sortable="custom" prop="name" label="用户名" width="100">
                    </el-table-column>
                    <el-table-column sortable="custom" prop="email" label="登陆邮箱" min-width="150">
                    </el-table-column>
                    <el-table-column prop="groupname" label="用户组" width="100">
                    </el-table-column>
                    <el-table-column prop="rolename" label="用户角色" width="100">
                    </el-table-column>
                    <el-table-column sortable="custom" prop="created_at" label="创建时间" width="200">
                    </el-table-column>
                    <el-table-column align="center" label="操作" width="150">
                        <template slot-scope="scope">
                            <el-button size="mini" type="primary" @click="openUserDialog(scope.row)">编辑</el-button><el-button size="mini" type="danger" @click="delUser(scope.row.id)">删除</el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <el-pagination @current-change="currentChange" :small='false' class="pagination" :current-page.sync="currentPage" :page-size="paginationSize" layout="total, prev, pager, next" :total="userData.total"></el-pagination>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>

    import util from '../util'
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
                userForm:{id:0,name:'',email:'',groupid:null,roleid:1},
                userFormRules: {
                    name: [
                        { required: true, message: '请输入用户名' }
                    ],
                    email: [
                        { required: true, type: 'email',message: '请输入登录邮箱' }
                    ],
                    groupid: [
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
                let treeData=[{id:0,name:'全部'}].concat(this.userGroups);
                return treeData
                // return util.toTreeData(this.userGroups,'parent_id')
            },
        },
        watch: {
            filterText(val) {
                this.$refs.tree.filter(val);
            }
        },
        methods: {
            filterNode(value, data) {
                if (!value) return true;
                return data.name.indexOf(value) !== -1;
            },
            renderContent(h, { node, data, store }){
                var self = this
                return h('span', {attrs:{class:'el-tree-node__label'}},[
                            data.name,h('div',{attrs:{style:'position:absolute;top:0;right:15px;line-height:26px;'}},[
                                //h('i',{attrs:{class:'el-icon-plus'},on:{click:function (event) {event.stopPropagation();self.openGroupDialog(data,true)}}}),
                                data.id>0?h('i',{attrs:{class:'el-icon-edit-outline'},on:{click:function (event) {event.stopPropagation();self.openGroupDialog(data)}}}):'',
                                node.isLeaf&&data.id>0?h('i',{attrs:{class:'el-icon-delete'},on:{click:function (event) {event.stopPropagation();self.delGroup(data.id)}}}):''
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
                    groupid:this.$refs.tree.getCurrentKey(),
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
                    this.userForm.groupid=null
                    //this.userFormGroupOptions=[1]
                    this.userForm.roleid=1

                }else{
                    this.userDialogTitle="编辑用户"
                    this.userForm.id=user.id
                    this.userForm.name=user.name
                    this.userForm.email=user.email
                    this.userForm.groupid=user.group_id
                    //this.userFormGroupOptions=util.getParentKeys(this.userGroups,'parent_id',user.usergroup_id)
                    this.userForm.roleid=user.role_id
                }
                this.userDialogVisible = true;
            },
            //groupChange(val){
            //    this.userForm.usergroupid=this.userFormGroupOptions[this.userFormGroupOptions.length - 1]
            //},
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
            this.$store.dispatch('loadUserGroups')
            this.$store.dispatch('loadRoles')
        }
    }
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.el-main{
    padding-top:0;
}
.pagination{
    float:right;
    margin:5px 20px 0 0;
}
.el-table--border, .el-table--group{
    border-color:#D8DCE5;
}
.el-table--border::after, .el-table--group::after, .el-table::before{
    background-color:#D8DCE5;
}
</style>
