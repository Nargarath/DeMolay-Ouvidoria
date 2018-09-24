<template>
    <div>
        <Panel></Panel>
        <Chapters></Chapters>
        <Feedbacks></Feedbacks>
        <Users></Users>
    </div>
</template>
<script>
import Panel from "./admin/Panel.vue";
import Chapters from "./admin/Chapters.vue";
import Feedbacks from "./admin/Feedbacks.vue";
import Users from "./admin/Users.vue";


export default {
  name: "components",
  components: {
    Panel,
    Chapters,
    Feedbacks,
    Users
  },
    beforeRouteEnter (to, from, next) {
        var logged_in = window.sessionStorage.getItem('logged_in');
        if(logged_in==='true'){
            next()
        }else{
            next(false)
      }
    }
};
</script>
