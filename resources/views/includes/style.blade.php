<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net" />
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet" />





<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" />




<style>
    .dataTables_wrapper .dataTables_filter,
    .dataTables_length {
        display: none;
    }

    table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;
        /*border-b-1 border-gray-300*/
        margin-top: 0.75em;
        margin-bottom: 0.75em;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        border-bottom: 1px solid #e2e8f0;
        /*border-b-1 border-gray-300*/
        margin-top: 0.75em;
        margin-bottom: 0.75em;
    }

    .dataTables_wrapper {

        .row:nth-child(1),
        .row:nth-child(2) {
            display: none;
        }
    }

    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_desc {
        background-image: none;
    }

    .dt-buttons {
        display: none;
    }
</style>




@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/toast.js','resources/js/Handsontable-edit.js', 'resources/js/toast-error.js'])
