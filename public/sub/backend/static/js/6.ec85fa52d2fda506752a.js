webpackJsonp([6],{530:function(t,e,s){var a=s(0)(s(559),s(560),function(t){s(557)},null,null);t.exports=a.exports},557:function(t,e,s){var a=s(558);"string"==typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);s(524)("2ec93300",a,!0)},558:function(t,e,s){(t.exports=s(523)(!0)).push([t.i,"\n.modal-card, .modal-content {\n    width: 1100px;\n}\n","",{version:3,sources:["C:/OpenServer/domains/scandinaver/scandinaver/resources/assets/sub/backend/client/views/texts/Modal.vue"],names:[],mappings:";AACA;IACI,cAAc;CACjB",file:"Modal.vue",sourcesContent:["\n.modal-card, .modal-content {\n    width: 1100px;\n}\n"],sourceRoot:""}])},559:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:["visible"],data:function(){return{form:{title:"",origtext:"",translate:""}}},methods:{close:function(){this.$emit("close")}}}},560:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("b-modal",{attrs:{active:t.visible},on:{"update:active":function(e){t.visible=e},close:t.close}},[s("div",{staticClass:"box",staticStyle:{width:"1100px"}},[s("div",{staticClass:"columns"},[s("div",{staticClass:"column"},[s("p",{staticClass:"control"},[s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.title,expression:"form.title"}],staticClass:"input",attrs:{type:"text",placeholder:"Название"},domProps:{value:t.form.title},on:{input:function(e){e.target.composing||t.$set(t.form,"title",e.target.value)}}})])])]),t._v(" "),s("div",{staticClass:"columns"},[s("div",{staticClass:"column is-6"},[s("p",{staticClass:"control content"},[s("textarea",{directives:[{name:"model",rawName:"v-model",value:t.form.origtext,expression:"form.origtext"}],staticClass:"textarea",staticStyle:{height:"500px"},attrs:{placeholder:"оригинал"},domProps:{value:t.form.origtext},on:{input:function(e){e.target.composing||t.$set(t.form,"origtext",e.target.value)}}})])]),t._v(" "),s("div",{staticClass:"column is-6"},[s("p",{staticClass:"control content"},[s("textarea",{directives:[{name:"model",rawName:"v-model",value:t.form.translate,expression:"form.translate"}],staticClass:"textarea",staticStyle:{height:"500px"},attrs:{placeholder:"перевод"},domProps:{value:t.form.translate},on:{input:function(e){e.target.composing||t.$set(t.form,"translate",e.target.value)}}})])])]),t._v(" "),s("div",{staticClass:"columns"},[s("div",{staticClass:"column"},[s("button",{staticClass:"button is-succes",on:{click:function(e){t.$emit("save",t.form)}}},[t._v("Сохранить")])])])])])},staticRenderFns:[]}}});
//# sourceMappingURL=6.ec85fa52d2fda506752a.js.map