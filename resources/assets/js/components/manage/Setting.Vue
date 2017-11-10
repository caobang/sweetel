<template>
    <div>
        系统设置111
        <el-button type="primary" @click="addCustomTab">addTab</el-button>
        <input />
    </div>
</template>

<script>
  import Vue from 'vue'
  import Dashboard from './Dashboard'
  import bus from '../../bus'
  export default {
    data() {
		  return {
            
            
		  }
    },
    methods:{
        addCustomTab:function(){
          //bus.$emit('addTab',{tabIcon:'el-icon-fa-user',tabTitle:'公司信息1',tabContent:'<Dashboard>1</Dashboard>',tabClosable:true})
          bus.$emit('addTab',{tabIcon:'el-icon-fa-user',tabTitle:'Dashboard',tabContent:'<Dashboard>1</Dashboard>',tabComponent:Dashboard,tabClosable:true},true)
          
        }
    },
    mounted:function(){
        //bus.$emit('addTab',{tabIcon:'el-icon-fa-user',tabTitle:'公司信息1',tabContent:'<Dashboard>1</Dashboard>',tabClosable:true})
    },
    //components:{Dashboard}
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>


</style>