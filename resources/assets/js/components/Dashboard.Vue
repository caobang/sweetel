<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Component</div>

                    <div class="panel-body">
                        I'm an example component!
                        <el-button type="primary" @click="addCustomTab">addTab</el-button>
                        <input />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  import Vue from 'vue'
  import bus from '../bus'
    export default {
        methods:{
            addCustomTab:function(){
                

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
