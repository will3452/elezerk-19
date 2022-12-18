import Card from './components/Card.vue'

import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/dist/style.css';

Nova.booting((app, store) => {

    // Setup plugin for defaults or `$screens` (optional)
    app.use(SetupCalendar, {})
    // Use the components
    app.component('Calendar', Calendar)
    app.component('DatePicker', DatePicker)
    app.component('calendar', Card)
})
