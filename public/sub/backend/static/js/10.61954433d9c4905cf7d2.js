webpackJsonp([10],{531:function(t,e,n){var a=n(0)(n(565),n(566),null,null,null);t.exports=a.exports},565:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={components:{Notification:Notification},data:function(){return{edited:{text:"",translate:""},puzzles:[],isComponentModalActive:!1}},mounted:function(){this.load()},methods:{load:function(){var t=this;this.$http.get("/admin/puzzle").then(function(e){t.puzzles=e.body},function(t){console.log(t)})},add:function(t){var e=this;this.$http.post("/admin/puzzle",this.edited).then(function(t){t.body.success?(e.load(),e.$snackbar.open("Загружено!"),e.closeSettingsModal()):e.$snackbar.open("Ошибка!")},function(t){console.log(t)})},remove:function(t){var e=this;confirm("удалить?")&&this.$http.delete("/admin/puzzle/"+t.id).then(function(t){e.load()},function(t){console.log(t)})},showSettingsModal:function(){this.isComponentModalActive=!0},closeSettingsModal:function(){this.isComponentModalActive=!1}}}},566:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"tile is-ancestor"},[n("div",{staticClass:"tile is-parent"},[n("article",{staticClass:"tile is-child box"},[n("h4",{staticClass:"title text-center"},[t._v("Паззлы")]),t._v(" "),n("b-field",[n("p",{staticClass:"control"},[n("button",{staticClass:"button is-success",on:{click:t.showSettingsModal}},[t._v("Добавить")])])]),t._v(" "),n("b-table",{attrs:{data:t.puzzles,paginated:"",narrowed:"",loading:t.loading,"per-page":"10"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("b-table-column",{attrs:{field:"id",label:"ID",width:"40",sortable:"",numeric:""}},[t._v("\n                            "+t._s(e.row.id)+"\n                        ")]),t._v(" "),n("b-table-column",{attrs:{field:"text",label:"Text",sortable:""}},[t._v("\n                            "+t._s(e.row.text)+"\n                        ")]),t._v(" "),n("b-table-column",{attrs:{field:"translate",label:"translate",sortable:""}},[t._v("\n                            "+t._s(e.row.translate)+"\n                        ")]),t._v(" "),n("b-table-column",{attrs:{"custom-key":"actions"}},[n("button",{staticClass:"button  is-warning",on:{click:function(n){t.edit(e.row)}}},[n("b-icon",{attrs:{icon:"account-edit",size:"is-small"}})],1),t._v(" "),n("button",{staticClass:"button  is-danger",on:{click:function(n){t.remove(e.row)}}},[n("b-icon",{attrs:{icon:"account-remove",size:"is-small"}})],1)])]}}])})],1)])]),t._v(" "),n("b-modal",{attrs:{active:t.isComponentModalActive,"has-modal-card":""},on:{"update:active":function(e){t.isComponentModalActive=e}}},[n("form",{attrs:{action:""}},[n("div",{staticClass:"modal-card",staticStyle:{width:"400px"}},[n("section",{staticClass:"modal-card-body"},[n("b-field",{attrs:{label:"На русском"}},[n("b-input",{attrs:{type:"textarea"},model:{value:t.edited.text,callback:function(e){t.$set(t.edited,"text",e)},expression:"edited.text"}})],1)],1),t._v(" "),n("section",{staticClass:"modal-card-body"},[n("b-field",{attrs:{label:"На нерусском"}},[n("b-input",{attrs:{type:"textarea"},model:{value:t.edited.translate,callback:function(e){t.$set(t.edited,"translate",e)},expression:"edited.translate"}})],1)],1),t._v(" "),n("footer",{staticClass:"modal-card-foot"},[n("button",{staticClass:"button",attrs:{type:"button"},on:{click:function(e){t.isComponentModalActive=!1}}},[t._v("Закрыть")]),t._v(" "),n("button",{staticClass:"button is-primary",on:{click:t.add}},[t._v("Сохранить")])])])])])],1)},staticRenderFns:[]}}});
//# sourceMappingURL=10.61954433d9c4905cf7d2.js.map