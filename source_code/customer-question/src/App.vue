<template>
  <div id="app">
    <el-col class="app-header">
      <h2 class="center">Vevői Kérdőiv</h2>
    </el-col>
    <el-col class="app-content">
      <Questions/>
    </el-col>
    <el-col class="footer">
    </el-col>
  </div>
</template>

<script>
import Questions from './components/Questions.vue'

export default {
  name: 'app',
  components: {
    Questions
  }
}
</script>

<style>
body{
  margin:0px;
  padding: 0px;
  background-image: url('/img/bg.jpg');
  background-size: 100% auto;
  background-repeat: repeat, no-repeat;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  min-height: 300px;
}
.app-content{
  margin-top: 50px;
}
.app-header{
  border-bottom: 1px solid;
  position: fixed;
  background: white;
  z-index: 10;
}
.app-footer{
  height: 10px;
  background: white;
  z-index: 100;
  position: fixed;
  bottom: 0;
}
@media print { body { background: none; } }
</style>
