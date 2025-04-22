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
<!-- Datatables Library -->
<!-- dataTables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function () {
        $(".dataTable").DataTable({
            paging: false,
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
<!--materialize js-->
<script type="text/javascript" src="../assets/theme/js/materialize.min.js"></script>


<!--scrollbar-->
<script type="text/javascript" src="../assets/theme/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="../assets/theme/js/plugins.js"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="../assets/theme/js/custom-script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

</body>
</html>
