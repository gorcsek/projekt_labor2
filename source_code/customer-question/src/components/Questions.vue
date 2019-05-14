<template>
  <div class="questions-content">
    <div>
      <el-row>
        <el-col>
          <h3 class="subtitle">1. Mennyire ért egyet az alábbi kijelentésekkel?</h3>
        </el-col>
        <el-col class="header">
          <el-col :span="8">&nbsp</el-col>
          <el-col v-for="a,id in answers1" :key="id" :span="3">
            <span class="header-answer"><strong>{{a}}</strong></span>
          </el-col>
        </el-col>
        <el-col v-for="q,id in questions1" :key="id" class="q-row">
          <el-col :span="6" class="ql-header">{{q.question}}</el-col>
          <el-col :span="18" class="q-answers">
            <el-radio-group v-model="q.answer">
              <el-radio v-for="a,id in answers1" :label="a" :key="id" v-on:click=""></el-radio>
            </el-radio-group>
          </el-col>
        </el-col>
      </el-row>
      <el-row>
        <el-col v-for="q,id in questions_2" :key="id">
          <el-col>
            <h3 class="subtitle">{{q.question}}</h3>
          </el-col>
          <el-col :span="12" :push="6">
            <el-radio-group v-model="q.answer">
              <el-radio v-for="a,id in q.answers" :label="a" :key="id" v-on:click=""></el-radio>
            </el-radio-group>
            <el-col v-if="q.textarea">
              <h4>{{q.textarea.label}}</h4>
              <el-input v-model="q.textarea.value" type="textarea" v-if="q.textarea.visible" ></el-input>
            </el-col>
          </el-col>
        </el-col>
      </el-row>
      <el-row>
        <el-col>
          <br>
          <p>
            Köszönjük hogy kitöltötte kérdőívünket!
          </p>
        </el-col>
        <el-col>
          <el-button v-on:click="save">Küldés</el-button>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'Questions',
  data: function(){
    return {
      act: false,
      title: "Title",
      status: 1,
      ifsend: false,
      qc: 0,
      answers: [],
      cmsg: "",
      resp: "",
      answers1: ["Igen", "Részben", "Igen is meg nem is", "Nem minden esteben", "Nem"],
      questions1: 
        [
          {question: 'Kollégáinkkal jó a munkakapcsolat', 
            answer: null},
          {question: 'Munkatársaink szaktudása megfelelő', 
            answer: null},
          {question: 'Az aáltalunk javasolt megoldások megfelelnek elképzeléseinek', 
            answer: null},
          {question: 'Megfelelő segítséget nyújtunk a projekt tervezésésben.', 
            answer: null},
          {question: 'Megfelelően diagnosztizáljuk a felmerült hibákat', 
            answer: null},
          {question: 'Megfelelő rendelkezésre állást biztosítunk', 
            answer: null},
          {question: 'Betartjuk a vállalt határidőket', 
            answer: null},
          {question: 'Megfelelően dokumentáljuk, és prezentáljuk az elvégzett munkáinkat.', 
            answer: null},
          {question: 'Kommunikációnk közérthető', 
            answer: null},
          {question: 'Gyorsan és megfelelően reagálunk a kérésekre, kérdésekre', 
            answer: null},
          {question: 'Átgondolt struktúra mentén végezzük munkánkat', 
            answer: null},
          {question: 'Megfelelő tájékoztatást kap az elvégzett munkákról', 
            answer: null},
          {question: 'Proaktívan végezzük tevékenységünket', 
            answer: null},
          {question: 'Megfelelően kezeljük az egyéni, egyedi kéréseket.', 
            answer: null},
          {question: 'Tisztában vagyunk az Ön cégének tevékenységével és annak specifikumaival.', 
            answer: null},
          {question: 'Kollégáinkkal', 
            answer: null},
        ],
        questions_2: [
            {question: 'Amennyiben volt reklamációja felénk megfelelő választ kapott?', 
              answers: ["Igen", "Nem",],
              textarea: {visible: true, label: 'Megjegyzés' ,value:""}},
            {question: 'Szívesen ajánlaná a termékeinket, szolgáltatásainkat másoknak is?', 
              answers: ["Igen", "Nem"],
              textarea: {visible: true, label: 'Megjegyzés',value:""}},
            {question: 'Kérjük írja meg, hogy miben javíthatnánk, fejlődhetnénk, hogy a későbbiekben még inkább elégedett legyen cégünkkel és termékeinkkel.', 
              answers: [],
              textarea: {visible: true,value:""}},
            {question: 'Hozzájárult, hogy cégünk honlapján, referenciái között, feltüntesse az Ön cégét?', 
              answers: ["Igen", "Nem"]},
            {question: 'Cégnév', 
              textarea: {visible: true,value:""},
              answers: []},
            {question: 'Név', 
              textarea: {visible: true,value:""},
              answers: []},
         ]
    }
  },
  methods:{
    radioClicked: function(q,a){
      console.log(q,a);
     // this.answers.push({'question':q, 'answer':a})
    },
    onCheck: function(){
      this.ifsend=true;
      if(this.act >= 0 && this.act == this.questions[this.qc].result){
        this.result++;
        this.cmsg = false;
      }else{
        this.cmsg = "A megadott válasz rossz";
        //this.cmsg = this.questions[this.qc].answers[this.questions[this.qc].result];
      }
      this.axios.post("/customers/save-result",{name:this.resp, questions: this.questions[this.qc].question, answer: this.questions[this.qc].answers[this.act] }).then((response) => {
        console.log(response.data)
      })
    },
    onNext: function(){
      this.qc++;
      if(this.qc == this.questions.length){
        this.status++;
        this.save();
      }
      this.act=false;
      this.ifsend=false;
      this.cmsg = "";
    },
    start: function(){
      this.status=1;
    },
    log: function(l){
      console.log(l)
    },
    save(){
      console.log("save")
      this.axios.post("/customers/save-result",{customer: this.questions_2, results: this.questions1 }).then((response) => {
        console.log(response.data)
      })
      //this.axios.post("/customers/save-result",{name:this.resp, result: "Végeredmény: " + this.result + ' / ' + this.questions.length }).then((response) => {
      //  console.log(response.data)
      //})
    }

  },
  props: {
    msg: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.result{
  text-align: center;
}
.result h2{
  color: red;
}
.result a{
  font-weight: bold;
  color: #000;

}
.qimage{
  width: 70%;
  height: auto;
  margin: 40px;
}
.sign{
  text-align: center;
}
.questions-content{
  min-height: 700px;
}
.add-name h4{
  margin-top: 10px;
}
.add-name .el-row{
  margin-top: 50px;
}
.responder{
  text-align: left;
}
.answer{
  display: block;
  text-align:left;
}
.header-answer{
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
}
.el-radio {
    font-weight: 1000;
    line-height: 1;
    font-size: 30px !important;
    color: #000000 !important;
    margin-bottom: 15px;
}
.questions-content >>> .el-row{
  margin-left: 20px;
  margin-right: 20px;
}
.q-answers >>> .el-radio__input{
  width: 10vw;
}
.q-answers >>> .el-radio__label{
  display: none;
}
.ql-header{
  margin-top: 10px;
  text-align: left;
}
.q-row{
  margin-top: 5px;
  margin-bottom: 5px;
  border-bottom: 1px solid #f6f6f6;
}
.subtitle{
  text-align: left;
}
h2{
  color: #000;
}
</style>
