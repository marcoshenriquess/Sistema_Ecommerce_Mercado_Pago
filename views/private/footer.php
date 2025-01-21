<?php

?>

</div>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../public/vendor/jquery/jquery.min.js"></script>
<script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../public/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../public/js/demo/chart-area-demo.js"></script>
<script src="../public/js/demo/chart-pie-demo.js"></script>

</body>
<script type="text/javascript">
    function mostraCatFilho(element) {
        var inputItems = document.querySelector('#catFilho');
        inputItems.removeAttribute("disabled");

        const catPai = element.value;

        $.ajax({
            url: '../../controller/CategoriaFilhoController.php',
            type: 'POST',
            data: {
                action: 'ListaCategorias',
                id: JSON.stringify(catPai) // or just `catPai` if it’s a simple value
            },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Should display the response from `ListaCategorias`

                const select = document.getElementById("catFilho");
                select.innerHTML = "";
                response.forEach(element => {
                    select.innerHTML += `<option value="${element.catFilho_id}">${element.catFilho_nome}</option>`    
                });
            },
            error: function(err) {
                console.error("Erro na requisição AJAX:", err);
            }
        });

    }
</script>

</html>