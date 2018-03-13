<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
<link href="{{ asset('css/new-metro.css') }}" rel="stylesheet">
<link href="{{ asset('metro/build/css/metro-icons.css') }}" rel="stylesheet">
<link href="{{ asset('metro/build/css/metro-schemes.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/font-awesome-animation/font-awesome-animation.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
{{-- <link href="{{ asset('css/ven.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('metro/build/transition_effects.min.css') }}" rel="stylesheet">
<link href="{{ asset('metro/build/new_preloader.min.css') }}" rel="stylesheet">
<style type="text/css">
  /*
 * Component: Form
 * ---------------
 */
 .form-control {
  border-radius: 0;
  box-shadow: none;
  border-color: #d2d6de;
}
.form-control:focus {
  border-color: #3c8dbc;
  box-shadow: none;
}
.form-control::-moz-placeholder,
.form-control:-ms-input-placeholder,
.form-control::-webkit-input-placeholder {
  color: #bbb;
  opacity: 1;
}
.form-control:p(select) {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
.form-group.has-success label {
  color: #00a65a;
}
.form-group.has-success .form-control,
.form-group.has-success .input-group-addon {
  border-color: #00a65a;
  box-shadow: none;
}
.form-group.has-success .help-block {
  color: #00a65a;
}
.form-group.has-warning label {
  color: #f39c12;
}
.form-group.has-warning .form-control,
.form-group.has-warning .input-group-addon {
  border-color: #f39c12;
  box-shadow: none;
}
.form-group.has-warning .help-block {
  color: #f39c12;
}
.form-group.has-error label {
  color: #dd4b39;
}
.form-group.has-error .form-control,
.form-group.has-error .input-group-addon {
  border-color: #dd4b39;
  box-shadow: none;
}
.form-group.has-error .help-block {
  color: #dd4b39;
}
/* POPUP */
.float-right{
  float: right;
}
.float-left{
  float: left;
}
.box-shadow{
  box-shadow: 10px 10px 10px #dddddd;
  /*border: 2px solid black;*/
}
.mac {
  position: fixed;
  width: 90%;
  height: 90%;
  top: 5%;
  left: 5%;
  background-color: #cccccc;
  z-index: 2;
  display: none;
}
.mac-small{
  width: 50%;
  height: auto;
  left: 25%;
}
.mac-very-small{
  width: 30%;
  height: auto;
  left: 35%;
}
.mac-preloader{
  position: fixed;
  width: 90%;
  height: 90%;
  top: 5%;
  left: 5%;
  background-color: #cccccc;
  z-index: 3;
  display: none;
}
.mac-loader{
  position: absolute;
  top: 60%;
  left: 50%;
  margin-left: -33px;
  margin-top: -33px;
  display: none;
}
.mac-module-icon{
  position: absolute;
  top: 35%;
  left: 50%;
  margin-left: -50px;
  margin-top: -50px;
  font-size: 100px;
  color: #fff;
}
.mac-header{
  width: 100%;
  background-color: black;
  height: 30px;
  color: #fff;
}
.mac-icon{
  height: 100%;
  padding: 7px 10px;
  margin-left: 2px;
}
.mac-title{
  height: 100%;
  padding: 7px 10px;
}
.mac-close{
  padding: 5px 20px;
  height: 90%;
  margin-right: 2px;
  cursor: pointer;
}
.mac-close:hover{
  background-color: #f00;
}
.mac-content{
  height: calc(100% - 50px);
  max-height: calc(100% - 50px);
  background-color: white;
  padding: 10px 10px;
  overflow-y: auto;
  overflow-x: hidden;
}
.mac-footer{
  height: 20px;
  background-color: #ffffff;
}
.please-wait{
  position: fixed;
  top: 50%;
  left: 50%;
  font-size: 100px;
  color: white;
  background-color: blue;
  padding: 20px;
  margin-top: -60px;
  margin-left: -60px;
  display: none;
}
.save-button{
  padding: 5px 10px;
  line-height: 32px;
}
.margin-top-10{
  margin-top: 10px;
}

.tile, .tile-small, .tile-sqaure, .tile-wide, .tile-large, .tile-big, .tile-super {
  opacity: 0;
  -webkit-transform: scale(.8);
  transform: scale(.8);
}

#charmSettings .button {
  margin: 5px;
}

.no-border{
  border: none;
}
.margin5-left-right{
  margin: 0 5px;
}
.image-container .frame{
  background: transparent;
}
.select2-dropdown, .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--multiple .select2-selection__choice, .select2-container--classic .select2-selection--single, .select2-container--classic .select2-selection--multiple, .select2-container--classic .select2-selection--multiple .select2-selection__choice  {

  border-radius: 0;
}
.loader{
  top: 40%;
  left: 50%;
  margin-top: -33px;
  margin-left: -33px;
  position: absolute;
  z-index: 1;
  display: none;
}
.loader h3{
  margin-top: 20px;
  color: white;
}
@stack('style')
</style>