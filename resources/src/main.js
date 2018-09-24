import Vue from "vue";
import axios from "axios";
import App from "./App.vue";
import router from "./router";
import Argon from "./plugins/argon-kit";
import Vuetable from "vuetable-2/src/components/Vuetable.vue";
import VuetablePagination from "vuetable-2/src/components/VuetablePagination.vue";
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo.vue';
import VueEvents from 'vue-events';
import ActionsFeedback from './views/datatable/actionsFeedback.vue';
import ActionsChapter from './views/datatable/actionsChapter.vue';
import ActionsUser from './views/datatable/actionsUser.vue';

Vue.config.productionTip = false;
Vue.use(Argon);
Vue.use(axios);
Vue.use(VueEvents);


Vue.component("vuetable", Vuetable);
Vue.component("vuetable-pagination", VuetablePagination);
Vue.component("vuetable-pagination-info", VuetablePaginationInfo);

Vue.component("feedback-actions", ActionsFeedback);
Vue.component("chapter-actions", ActionsChapter);
Vue.component("user-actions", ActionsUser);

var vm = new Vue({
  data: {
    base_url: null,
    user:{}
  },
  created() {
    this.base_url = document.querySelector("meta[name='base_url']").getAttribute("content");;  
  },
  router,
  render: h => h(App)
}).$mount("#app");
