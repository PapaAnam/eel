Vue.component('inp', require('./../theme/bs4/form/inp.vue'))
require('./../layouts')
require('./layouts')
Vue.component('tags', require('./../theme/metro/form/tags.vue'))

// HRIS
Vue.component('hris', require('./index.vue'))
Vue.component('hris-header', require('./header.vue'))
Vue.component('mac', require('./mac.vue'))
Vue.component('mac-view', require('./../form/mac.vue'))
Vue.component('mac-preloader', require('./mac-preloader.vue'))
Vue.component('whats-new', require('./whats-new.vue'))
Vue.component('skin', require('./skin.vue'))
Vue.component('about-app', require('./about-app.vue'))

// TILES
Vue.component('hris-tiles', require('./tiles/all.vue'))
Vue.component('employees-tile', require('./tiles/employees.vue'))
Vue.component('departments-tile', require('./tiles/departments.vue'))
Vue.component('jobs-tile', require('./tiles/jobs.vue'))
Vue.component('attendances-tile', require('./tiles/attendances.vue'))
Vue.component('over-time-tile', require('./tiles/over-time.vue'))
Vue.component('mutations-tile', require('./tiles/mutations.vue'))
Vue.component('payroll-tile', require('./tiles/payroll.vue'))
Vue.component('special-day-tile', require('./tiles/special-day.vue'))
Vue.component('accounts-tile', require('./tiles/accounts.vue'))
Vue.component('official-travel-tile', require('./tiles/official-travel.vue'))
Vue.component('leave-period-tile', require('./tiles/leave-period.vue'))
Vue.component('salary-rules-tile', require('./tiles/salary-rules.vue'))

//MAC
Vue.component('mac-header', require('./../mac/header.vue'))

// FORM
Vue.component('filter-bar', require('./../form/FilterBar.vue'))
Vue.component('export-btn', require('./../form/button/export-btn.vue'))
Vue.component('simpan-btn', require('./../form/button/simpan-btn.vue'))
Vue.component('batal-btn', require('./../form/button/batal-btn.vue'))
Vue.component('edit-btn', require('./../form/button/edit-btn.vue'))
Vue.component('detail-btn', require('./../form/button/detail-btn.vue'))
Vue.component('print-btn', require('./../form/button/print-btn.vue'))
Vue.component('pdf-btn', require('./../form/button/pdf-btn.vue'))
Vue.component('excel-btn', require('./../form/button/excel-btn.vue'))
Vue.component('hapus-btn', require('./../form/button/hapus-btn.vue'))
Vue.component('btn-primary', require('./../form/button/btn-primary.vue'))
Vue.component('input-text', require('./../form/input/input-text.vue'))
Vue.component('input-number', require('./../form/input/input-number.vue'))
Vue.component('input-pass', require('./../form/input/input-pass.vue'))
Vue.component('input-tags', require('./../form/input/input-tags.vue'))
Vue.component('input-date', require('./../form/input/input-date.vue'))
Vue.component('input-datetime', require('./../form/input/input-datetime.vue'))
Vue.component('input-file', require('./../form/input/input-file.vue'))
Vue.component('datepicker', require('./../form/datepicker.vue'))
Vue.component('textar', require('./../form/textar.vue'))
Vue.component('select2', require('./../form/select2.vue'))
Vue.component('icheck', require('./../form/icheck.vue'))
Vue.component('iradio', require('./../form/iradio.vue'))

// DEPARTMENT MENU
Vue.component('department-view', require('./departments/view.vue'))
Vue.component('department-new', require('./departments/new.vue'))
Vue.component('department-edit', require('./departments/edit.vue'))
Vue.component('dep-sel', require('./departments/select.vue'))

// POSITION MENU
Vue.component('job-view', require('./jobs/view.vue'))
Vue.component('job-add', require('./jobs/add.vue'))
Vue.component('job-edit', require('./jobs/edit.vue'))
Vue.component('pos-sel', require('./jobs/select.vue'))

// EMPLOYEES MENU
Vue.component('employees-view', require('./employees/view.vue'))
Vue.component('biography', require('./employees/biography.vue'))
Vue.component('placement', require('./employees/placement.vue'))
Vue.component('family', require('./employees/family.vue'))
Vue.component('important-file', require('./employees/important-file.vue'))
Vue.component('educational-history', require('./employees/educational-history.vue'))
Vue.component('employees-select', require('./employees/select.vue'))
Vue.component('employees-non-activate', require('./employees/non-activate.vue'))
Vue.component('employees-non-active-view', require('./employees/non-active-view.vue'))

// ACCOUNTS MENU
Vue.component('accounts-view', require('./accounts/view.vue'))
Vue.component('accounts-authority', require('./accounts/authority.vue'))

// ATTENDANCES MENU
Vue.component('attendances-view', require('./attendances/view.vue'))
Vue.component('attendances-x100c-view', require('./attendances/x100c-view.vue'))

// SPECIAL DAY MENU
Vue.component('calendar', require('./special-day/calendar.vue'))
Vue.component('event-add', require('./special-day/add.vue'))
Vue.component('event-view', require('./special-day/view.vue'))
Vue.component('event-edit', require('./special-day/edit.vue'))

// SALARY RULES
Vue.component('salary-rules-view', require('./salary-rules/view.vue'))
Vue.component('salary-rules-new', require('./salary-rules/new.vue'))

// OFFICIAL TRAVEL
Vue.component('official-travel-view', require('./official-travel/view.vue'))