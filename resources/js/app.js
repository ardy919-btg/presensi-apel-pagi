import './bootstrap';

import Alpine from 'alpinejs';
import { registerToastStore, registerConfirmModalStore } from './toast';

window.Alpine = Alpine;

registerToastStore(Alpine);
registerConfirmModalStore(Alpine);

Alpine.start();
