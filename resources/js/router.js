 import VueRouter from "vue-router";
 import Vue from "vue";
 import Index from "./views/Index.vue";

 Vue.use(VueRouter);

 const routes = [
     {
         path: '/',
         component: Index
     }
 ];

 export default new VueRouter({
    mode: "history",
    routes
 });
