<script>
    window.addEventListener('notify', event => {
        var message = event.detail[0].message;
        var status = event.detail[0].status;

        $.notify({
            message: message
        }, {
            type: status,
            allow_dismiss: true,
            newest_on_top: true,
            mouse_over: false,
            showProgressbar: true,
            spacing: 10,
            timer: 1,
            placement: {
                from: 'bottom',
                align: 'right'
            },
            offset: {
                x: 30,
                y: 30
            },
            delay: 1,
            z_index: 10000,
            animate: {
                enter: 'animated bounce',
                exit: 'animated bounce'
            }
        });

    });
</script>
