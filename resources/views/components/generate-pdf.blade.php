@props(['fileName'])

<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js"></script>
<script>
    function printer() {
        var element = document.getElementById('letter-body');
        var opt = {
            margin: 0.5,
            filename: '{{ $fileName }}.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        html2pdf().set(opt).from(element).save();
    }

    function goBack() {
        window.history.back();
    }
</script>

