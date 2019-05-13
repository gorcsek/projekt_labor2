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
                            <el-input type="textarea" v-if="q.textarea.visible" ></el-input>
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