import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';

// create the app
const app = createApp();

// set axios globally
app.config.globalProperties.$axios = axios;

// also expose axios globally (optional)
window.axios = axios;

// expose it globally for blade scripts
window.app = app;

// make available for the scripts (like <scipt type=module>)
export default app;
