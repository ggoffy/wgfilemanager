<!-- ----------------------------- -->
<!-- Start code for printing files -->
<!-- ----------------------------- -->
<script>
    function printFile(url) {
        const iframe = document.createElement('iframe');
        iframe.src = url;
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        // Use onload to make pdf preview work on firefox
        //iframe.onload = () => {
            //iframe.contentWindow.focus();
            //iframe.contentWindow.print();
        //};
    }
</script>
<style>
    @media print,
        @print {
            .navigation {
                visibility: hidden;
            }
            @page
            {
                size: auto;
                margin: 0;
            }
            @page :footer {
                display: none
            }
            @page :header {
                display: none
            }
        }
</style>
<!-- End code for printing files -->
