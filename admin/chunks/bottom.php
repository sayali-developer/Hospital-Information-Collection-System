<?php if (isset($_SESSION["PAGE_INFO"])): ?>
    <div class="row">
        <div class="col s12">
            <div class="card <?= $_SESSION["TYPE"] ?> lighten-1">
                <div class="card-content white-text">
                    <p style="font-size: 18px"><?= $_SESSION["PAGE_INFO"] ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php clearPageInfo(); endif; ?>
</div>
<!--end container-->
</section>
<!-- END CONTENT -->
</div>
</div>
<!-- END MAIN -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START FOOTER -->
<footer class="page-footer gradient-45deg-light-blue-cyan">
    <div class="footer-copyright">
        <div class="container">

        </div>
    </div>
</footer>
<!-- END FOOTER -->
<!-- ================================================
Scripts
================================================ -->
<!-- jQuery Library -->

<!--materialize js-->
<script type="text/javascript" src="../assets/theme/js/materialize.min.js"></script>

<!-- dataTables -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/cr-1.5.2/fh-3.1.6/r-2.2.3/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $(".dataTable").DataTable({
            paging: false,
            responsive: true,
            colReorder: true,
            order: [],
            dom: 'Bfrtip',
            buttons: [
                'colvis',
                'excelHtml5',
                'csvHtml5',
                'print',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    });
</script>
<!--scrollbar-->
<script type="text/javascript" src="../assets/theme/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="../assets/theme/js/plugins.js"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="../assets/theme/js/custom-script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

</body>
</html>
