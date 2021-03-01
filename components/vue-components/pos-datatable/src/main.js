import Vue from 'vue';
import PosComponent from './components/PosComponent.vue';

Vue.config.productionTip = false;

new Vue({
  render: (h) => h(PosComponent),
}).$mount('#app');
