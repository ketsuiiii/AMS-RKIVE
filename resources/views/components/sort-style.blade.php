<style>
    th.sortable {
        cursor: pointer;
    }

    th.sortable:hover {
        background-color: #7366FF;
    }

    th.sortable::after {
        content: '\25B4';
        color: #FF3364;
        font-size: 20px;
    }

    th.sorted-asc::after {
        content: '\25BE';
        color: #FF3364;
        font-size: 20px;

    }

    th.sorted-desc::after {
        content: '\25B4';
        font-size: 20px;
        color: #7366FF;
    }

    .table-container {
        height: 500px;
        overflow-y: scroll;
    }
</style>
