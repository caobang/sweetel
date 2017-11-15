<template>
    <el-container>
        <el-aside width="250px" style="border:1px solid #D8DCE5;margin-left:15px;">
            <div style="padding-left:15px;font-size:14px;font-weight:bold;color:#5a5e66;background-color:#f5f7fa;border-bottom:1px solid #D8DCE5;line-height:40px;" >用户分组</div>
            <el-input size="small" prefix-icon="el-icon-search" style="margin:15px 15px 0 15px ;width:auto;" placeholder="输入分组名称进行过滤" v-model="filterText" ></el-input>
            <el-tree node-key='id' :render-content="renderContent" style="padding:15px 0px 15px 0;min-height:400px;max-height:700px;overflow:auto;" highlight-current ref="tree" :data="userGroupsTreeData" :props="defaultProps" default-expand-all :filter-node-method="filterNode"></el-tree>

            <el-dialog :modal-append-to-body='false' :modal='true' width="500px" :title="groupDialogTitle" :visible.sync="groupDialogVisible">
                <el-form style="width:400px;" label-width="80px" size="small" :model="groupForm">
                    <el-form-item label="分组名称" >
                        <el-input v-model="groupForm.name"></el-input>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button size="small" @click="groupDialogVisible = false">取消</el-button>
                    <el-button size="small" type="primary" @click="saveGroup">确定</el-button>
                </div>
            </el-dialog>
            
        </el-aside>
        <el-container>
            <el-main>
                <el-form :inline="true" :model="searchForm" size="small">
                    <el-form-item>
                        <el-input placeholder="用户名" v-model="searchForm.username" ></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" icon="el-icon-search" @click="searchUser">查询</el-button>
                        <el-button type="primary" icon="el-icon-plus" @click="openUserDialog">添加</el-button>
                    </el-form-item>
                </el-form>
                <el-table v-loading="userLoading" @sort-change="sortChange" :default-sort="defaultSort" size="small" max-height='800' border :header-row-style="{'background-color':'#f5f7fa','color':'#5a5e66'}"
                    :data="userData.list" 
                    style="">
                    <el-table-column sortable="custom" prop="name" label="用户名" width="100">
                    </el-table-column>
                    <el-table-column sortable="custom" prop="email" label="登陆邮箱" width="200">
                    </el-table-column>
                    <el-table-column prop="groupname" label="用户组名" width="100">
                    </el-table-column>
                    <el-table-column prop="rolename" label="用户角色" width="100">
                    </el-table-column>
                    <el-table-column sortable="custom" prop="created_at" label="创建时间">
                    </el-table-column>
                </el-table>
                <el-pagination @current-change="currentChange" :small='false' class="pagination" :current-page.sync="currentPage" :page-size="paginationSize" layout="total, prev, pager, next" :total="userData.total"></el-pagination>
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
                defaultSort:{prop:'created_at',order:'descending'},
                paginationSize:10,
                currentPage:1,
                userLoading:false
            }
        },
        
        computed: {
            ...mapState({
                userGroups:state => state.user.userGroups,
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
            filterNode(value, data) {
                if (!value) return true;
                return data.name.indexOf(value) !== -1;
            },
            renderContent(h, { node, data, store }){
                var self = this
                console.log(node)
                return h('span', {attrs:{class:'el-tree-node__label'}},[
                            data.name,h('div',{attrs:{style:'position:absolute;top:0;right:15px;line-height:26px;'}},[
                                data.id>0?h('i',{attrs:{class:'el-icon-plus'},on:{click:function (event) {event.stopPropagation();self.openGroupDialog(data,true)}}}):'',
                                data.id>1?h('i',{attrs:{class:'el-icon-edit-outline'},on:{click:function (event) {event.stopPropagation();self.openGroupDialog(data)}}}):'',
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
                if(this.groupForm.name==='')
                    return
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
                    this.$store.dispatch('loadUserGroups')
                })
            },
            delGroup(id){
                this.$confirm('确认删除分组？', '提示').then(() => {
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
            currentChange(currentPage){
                this.currentPage=currentPage
                this.loadData()
            },
            sortChange({column, prop, order}){
                this.currentPage=1
                this.defaultSort.prop=prop
                this.defaultSort.order=order
                this.loadData()
            },
            loadData(){
                this.userLoading=true
                let params={
                    groupid:this.$refs.tree.getCurrentKey(),
                    name:this.searchForm.username,
                    size:this.paginationSize,
                    page:this.currentPage,
                    orderby:this.defaultSort.prop,
                    sort:this.defaultSort.order==='ascending'?'asc':'desc'
                }
                this.$store.dispatch('loadUserData',params).then(()=>{
                    this.userLoading=false
                })
            },
            searchUser(){
                this.currentPage=1
                this.loadData()
            },
            openUserDialog(){
                
            }
        },
        mounted() {
            this.$store.dispatch('loadUserGroups')
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
