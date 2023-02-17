<!--DataTables CSS-->
<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css">
<link href="/libs/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/libs/datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="/libs/datatables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="/libs/datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

<!-- Layout config Js -->
<script src="/js/layout.js"></script>
<!-- Bootstrap Css -->
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="/css/app.min.css" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="/css/custom.min.css" rel="stylesheet" type="text/css" />
<!---<script src="/js/jquery-3.3.1.js"></script>-->

<script src="/libs/datatables/datatables/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<!-- Datatables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>-->
<script src="/libs/datatables/jszip/dist/jszip.min.js"></script>
<script src="/libs/datatables/datatables.net/js/jquery.dataTables.min.js"></script>
<!--<script src="/libs/datatables/datatables/datatables.min.js"></script>-->
<script src="/libs/datatables/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/libs/datatables/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/libs/datatables/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="/libs/datatables/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="/libs/datatables/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/libs/datatables/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/libs/datatables/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="/libs/datatables/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/libs/datatables/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/libs/datatables/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<style>
.dt-buttons{
    margin-top: 16px;
}

.btn-group-vertical > .btn, .btn-group > .btn {
    border-radius: 2px !important;
    color: #3577f1;
    background-color: rgba(53, 119, 241, 0.1);
    margin: 5px;
}


table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
  background-color: #fff;
}

tbody, td, tfoot, th, thead, tr {
  border-color: inherit !important;
  border-style: solid !important;
  border-width: 0 !important;
}


.dataTables_wrapper  td:first-child, .dataTables_wrapper  th:first-child {
  padding-left: 16px;
}
.table-nowrap td, .table-nowrap th {
  white-space: nowrap;
}
.dataTables_wrapper  th {
  font-weight: 600;
}

.table {
  --vz-table-color: var(--vz-body-color) !important;
  --vz-table-bg: transparent !important;
  --vz-table-border-color: var(--vz-border-color) !important;
  --vz-table-accent-bg: transparent !important;
  --vz-table-striped-color: var(--vz-body-color) !important;
  --vz-table-striped-bg: rgba(var(--vz-dark-rgb), 0.02) !important;
  --vz-table-active-color: var(--vz-body-color) !important;
  --vz-table-active-bg: rgba(var(--vz-light-rgb), 1) !important;
  --vz-table-hover-color: var(--vz-body-color) !important;
  --vz-table-hover-bg: rgba(var(--vz-light-rgb), 1) !important;
  width: 100% !important;
  margin-bottom: 1rem !important;
  color: var(--vz-table-color) !important;
  vertical-align: top !important;
  border-color: var(--vz-table-border-color) !important;
}


.table-card td:first-child, .table-card th:first-child {
  padding-left: 16px !important;
}
.table-nowrap td, .table-nowrap th {
  white-space: nowrap !important;
}
.table > :not(caption) > * > * {
  padding: .75rem .6rem !important;
    padding-left: 0.6rem !important;
  background-color: var(--vz-table-bg) !important;
  border-bottom-width: 1px !important;
  -webkit-box-shadow: inset 0 0 0 9999px var(--vz-table-accent-bg) !important;
  box-shadow: inset 0 0 0 9999px var(--vz-table-accent-bg) !important;
}

tbody, td, tfoot, th, thead, tr {
  border-color: inherit !important;
  border-style: solid !important;
  border-width: 0 !important;
    border-bottom-width: 0px !important;
}
</style>