import './bootstrap';
import { createApp } from 'vue';

// create the app
const app = createApp();

// expose it globally for blade scripts
window.app = app;

// make available for the scripts (like <scipt type=module>)
export default app;
