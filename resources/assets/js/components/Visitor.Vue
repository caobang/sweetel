<template>
    <el-container>
        <el-aside width="250px" style="margin-left:15px;">
            <el-tabs type="border-card">
                <el-tab-pane label="当前会话">
                    <div v-if="!visitor.end" class="visitor" :class="{current:currentVisitor==visitor.id}" v-for="visitor in visitors" :key="visitor.id" @click="selectChat(visitor)">
                        <el-badge class="badge" :is-dot="visitor.new">
                            <i :class="{'el-icon-fa-tv':visitor.source==1,'el-icon-fa-tablet':visitor.source==2}"></i>
                        </el-badge>
                        <span style="padding-left:10px;">{{visitor.name}}</span>
                        
                        
                        <span style="float:right;position:relative">
                            {{visitor.lasttime}}
                            <i v-if="visitor.star" class="el-icon-star-on" style="color:#EB9E05;position:absolute;right:0;bottom:10px;"></i>
                        </span>
                    </div>
                </el-table>
                </el-tab-pane>
                <el-tab-pane label="历史记录">
                
                    <div v-if="visitor.end" class="visitor" :class="{current:currentVisitor==visitor.id}" v-for="visitor in visitors" :key="visitor.id" @click="selectChat(visitor)">
                        <el-badge class="badge" :is-dot="visitor.new">
                            <i :class="{'el-icon-fa-television':visitor.source==1}"></i>
                        </el-badge>
                        <span style="padding-left:10px;">{{visitor.name}}</span>
                        <span style="float:right;">{{visitor.lasttime}}</span>
                    </div>
                    
                </el-tab-pane>
            </el-tabs>
            
            
        </el-aside>
        <el-container style="width:0;">
            <el-main>
                <div style="border:1px solid #d8dce5;height:600px;">dsd
                </div>
                <el-button @click="setCurrent()">取消选择</el-button>
                
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
                visitors:[
                    {id:1,source:1,name:'江西南昌用户',lasttime:'21:22:34',new:true,end:false,star:true},
                    {id:2,source:1,name:'江西南昌用户',lasttime:'21:22:34',new:false,end:true,star:true},
                    {id:3,source:1,name:'江西南昌用户',lasttime:'21:22:34',new:true,end:true},
                    {id:4,source:2,name:'江西南昌南用户',lasttime:'21:22:34',new:true,star:true},
                    {id:5,source:1,name:'江西九江用户',lasttime:'21:22:34',new:true},
                    {id:6,source:2,name:'江西南昌用户',lasttime:'21:22:34',new:true,star:true},
                    {id:7,source:1,name:'江西南昌用户',lasttime:'21:22:34',new:true},
                    {id:8,source:1,name:'江西南昌用户',lasttime:'21:22:34',new:true},
                    {id:9,source:1,name:'江西南昌用户',lasttime:'21:22:34',new:true},
                ],
                currentVisitor:0
            }
        },
        computed: {
            
            
        },
        methods: {
            setCurrent(){
                let msgid=6
                let v = this.visitors.find(v=>v.id===msgid)
                if(v){
                    if(this.currentVisitor===msgid){

                    }
                    else{
                        v.new = true

                    }
                }
                //this.$refs.table.setCurrentRow()
            },
            selectChat(visitor){
                visitor.new=false
                this.currentVisitor=visitor.id
            }
        },
        mounted() {
                
        }
    }
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.el-main{
    padding-top:0;
}
.el-tab-pane{
    min-height:500px;
    max-height:800px;
    overflow:auto;
}
.visitor{
    height:70px;
    border-bottom:1px solid #D8DCE5;
    line-height:70px;
    padding:0 15px;
    color:#5a5e66;
    font-size:14px;
    cursor:pointer;
}
.visitor:hover{
    background-color:#ecf5ff;
}
.visitor.current{
    background-color:#ecf5ff;
}
.badge{
    display:inline-block;
    line-height:35px;
    text-align:center;
    height:35px;
    width:35px;
    background-color:#409EFF;
    border-radius:50%;
    color:#fff;
}
</style>
