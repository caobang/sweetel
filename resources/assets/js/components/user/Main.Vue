<template>
    <el-container>
        <el-aside width="250px" style="border:1px solid #dfe4ed;border-left:0;">
            <div style="padding-left:15px;font-size:16px;color:#2d2f33;background-color:#eef1f6;border-bottom:1px solid #dfe4ed;line-height:40px;" >用户分组</div>
            <el-input size="small" prefix-icon="el-icon-search" style="margin:15px 15px 0 15px ;width:auto;" placeholder="输入分组名称进行过滤" v-model="filterText" ></el-input>
            <el-tree node-key='id' :render-content="renderContent" style="padding:15px 0px 15px 0;max-height:700px;overflow:auto;" highlight-current ref="tree" :data="usergroups" :props="defaultprops" default-expand-all :filter-node-method="filterNode"></el-tree>
        </el-aside>
        <el-container>
            <el-main>
                <el-form :inline="true" :model="searchform" size="small">
                    <el-form-item>
                        <el-input placeholder="用户名" v-model="searchform.username" ></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" >查询</el-button>
                        <el-button type="primary" >添加</el-button>
                    </el-form-item>
                </el-form>
                <el-table max-height='800' border stripe :header-row-style="{'background-color':'#eef1f6','color':'#1f2d3d','font-size':'#14px'}"
                    :data="userdata" 
                    style="width: 100%">
                    <el-table-column sortable
                        prop="date"
                        label="日期"
                        width="180">
                    </el-table-column>
                    <el-table-column sortable
                        prop="name"
                        label="姓名"
                        width="180">
                    </el-table-column>
                    <el-table-column
                        prop="address"
                        label="地址">
                    </el-table-column>
                </el-table>
                <el-pagination class="pagination" :page-size="100" layout="total, prev, pager, next" :total="1000">
    </el-pagination>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
    export default {
        data() {
            return {
                filterText:'',
                usergroups:[{id: 110,label: '默认分组'},{id: 12,label: '一级'},{id: 13,label: '一级'},{id: 14,label: '一级'},{id: 2,label: '一级',children:[{id: 22,label: '一级'}]},{id: 3,label: '一级'}],
                defaultprops:{children: 'children',label: 'label'},
                searchform:{username:''},
                userdata:[{
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-04',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1517 弄'
                }, {
                    date: '2016-05-01',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1519 弄'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1516 弄'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1516 弄'
                }]
            }
        },
        watch: {
            filterText(val) {
                this.$refs.tree.filter(val);
            }
        },
        methods: {
            filterNode(value, data) {
                if (!value) return true;
                return data.label.indexOf(value) !== -1;
            },
            renderContent(h, { node, data, store }){
                var self = this
                return h('span', {attrs:{class:'el-tree-node__label'}},[
                            node.label,h('div',{attrs:{style:'position:absolute;top:0;right:15px;line-height:26px;'}},[
                                h('i',{attrs:{class:'el-icon-plus'},on:{click:function (event) {self.addGroup(data.id)}}}),
                                h('i',{attrs:{class:'el-icon-edit-outline'},on:{click:function (event) {self.editGroup(data.id)}}}),
                                h('i',{attrs:{class:'el-icon-delete'},on:{click:function (event) {self.delGroup(data.id)}}})
                            ])
                        ])
            },
            addGroup(id){
                console.log(id)
            },
            editGroup(id){
                console.log(id)
            },
            delGroup(id){
                console.log(id)
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.$refs.tree.setCurrentKey(0);
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
</style>
