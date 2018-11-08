webpackJsonp([5,15],{520:function(t,e,a){var s=a(0)(a(539),a(540),null,null,null);t.exports=s.exports},521:function(t,e,a){var s=a(0)(a(541),a(542),null,null,null);t.exports=s.exports},539:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["item","index"],data:function(){return{}},methods:{}}},540:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"columns"},[a("div",{staticClass:"column is-6"},[a("p",{staticClass:"control content"},[a("textarea",{directives:[{name:"model",rawName:"v-model",value:t.item.text,expression:"item.text"}],staticClass:"textarea",attrs:{placeholder:"оригинал"},domProps:{value:t.item.text},on:{input:function(e){e.target.composing||t.$set(t.item,"text",e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"column is-5"},[a("p",{staticClass:"control content"},[a("textarea",{directives:[{name:"model",rawName:"v-model",value:t.item.value,expression:"item.value"}],staticClass:"textarea",attrs:{placeholder:"оригинал"},domProps:{value:t.item.value},on:{input:function(e){e.target.composing||t.$set(t.item,"value",e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"column is-1"},[a("a",{class:["button","is-danger","is-small"],on:{click:function(e){t.$emit("remove",t.index)}}},[t._m(0)])])])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("span",{staticClass:"icon"},[e("i",{staticClass:"fa fa-trash-o"})])}]}},541:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s,i=a(520),n=(s=i)&&s.__esModule?s:{default:s};e.default={data:function(){return{fileUploadFormData:new FormData,text:"",values:[],examples:[]}},components:{Example:n.default},props:["visible","card","index"],methods:{bindFile:function(t){t.preventDefault(),this.fileUploadFormData.append("audiofile",t.target.files[0]),this.fileUploadFormData.append("id",this.card.word.id)},close:function(){this.$emit("close")},updateAudio:function(){var t=this;this.$http.post("/admin/audio",this.fileUploadFormData).then(function(e){e.body.success&&t.$store.commit("changeAssetAudio",{index:t.index,url:e.body.url})},function(t){console.log(t)})},updateTranslate:function(){var t=this;this.$http.post("/admin/translate",{card_id:this.card.id,id:this.card.translate.id,text:this.text,examples:this.examples}).then(function(e){e.body.success&&t.$store.commit("changeAssetWord",{index:t.index,text:t.text}),t.close()},function(t){console.log(t)})},setActive:function(t){var e=this;this.$http.post("/admin/changeUsedTranslate",{card_id:this.card.id,word_id:this.card.word.id,translate_id:t.id}).then(function(a){if(a.body.success){for(var s in e.text=t.value,e.values)e.values[s].active=!1;t.active=!0,e.$store.commit("changeAssetTranslate",{index:e.index,translate:t}),e.close()}},function(t){console.log(t)})},play:function(){this.$refs.audio.play()},addExample:function(){this.examples.push({text:"",value:""})},removeExample:function(t){this.examples.splice(t,1)}},watch:{visible:function(t){var e=this;t&&(this.$http.get("/admin/values/"+this.card.word_id).then(function(t){for(var a in e.values=t.body.values,e.values)e.values[a].id===e.card.translate_id&&(e.values[a].active=!0)},function(t){console.log(t)}),this.$http.get("/admin/examples/"+this.card.id).then(function(t){e.examples=t.body.values},function(t){console.log(t)}))}},mounted:function(){this.text=this.card.translate?this.card.translate.value:""}}},542:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("b-modal",{attrs:{active:t.visible},on:{"update:active":function(e){t.visible=e},close:t.close}},[a("div",{staticClass:"box"},[a("div",{staticClass:"header"},[t._v(t._s(t.card.id)+" - "+t._s(t.card.word.word))]),t._v(" "),a("div",{staticClass:"translate-section"},[a("p",{staticClass:"control"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.text,expression:"text"}],staticClass:"input",staticStyle:{width:"490px"},attrs:{type:"text",placeholder:"text"},domProps:{value:t.card.word.word,value:t.text},on:{input:function(e){e.target.composing||(t.text=e.target.value)}}})]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"variants"},[a("h2",{staticClass:"subtitle is-5"},[t._v("Варианты перевода:")]),t._v(" "),a("ul",t._l(t.values,function(e){return a("li",{class:["variant",{"is-success":e.active}],on:{click:function(a){t.setActive(e)}}},[t._v("\n                        "+t._s(e.value)+"\n                    ")])}))])]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"example-section"},[a("h2",{staticClass:"subtitle is-5"},[t._v("\n                Примеры: "),a("span",{staticClass:"button is-success pull-right",on:{click:t.addExample}},[t._v("добавить")])]),t._v(" "),a("div",t._l(t.examples,function(e,s){return a("example",{key:e.id,attrs:{item:e,index:s},on:{remove:t.removeExample}})}))]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"audio-section"},[a("audio",{ref:"audio",attrs:{src:t.card.word.audio,preload:"auto"}}),t._v(" "),a("a",{class:["button","is-small"],on:{click:t.play}},[a("span",{staticClass:"icon"},[a("i",{staticClass:"fa fa-volume-up"})])]),t._v(" "),a("form",{ref:"audioform",attrs:{enctype:"multipart/form-data",action:"",method:"post",name:"addAudio"}},[a("input",{attrs:{type:"file",name:"audiofile"},on:{change:t.bindFile}}),t._v(" "),a("a",{staticClass:"button is-success",on:{click:t.updateAudio}},[t._v("Загрузить аудио")]),t._v(" "),a("a",{staticClass:"button is-success",on:{click:t.updateTranslate}},[t._v("Сохранить")]),t._v(" "),a("a",{staticClass:"button is-warning",on:{click:t.close}},[t._v("Отмена")])])])])])},staticRenderFns:[]}}});
//# sourceMappingURL=5.b0807df66ec97cc1ef08.js.map