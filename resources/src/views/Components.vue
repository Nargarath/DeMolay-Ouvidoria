<template>
    <div>
        <hero></hero>
        <TextSender></TextSender>
        <Footer></Footer>
    </div>
</template>
<script>
import {RotateSquare2} from 'vue-loading-spinner';
import Hero from "./components/Hero.vue";
import TextSender from "./components/TextSender.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "components",
  components: {
    RotateSquare2,
    Hero,
    TextSender,
    Footer
  }
};
</script>
