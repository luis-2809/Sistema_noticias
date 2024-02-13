<footer class=" py-3 my-4 border-top">

  <div class="row">
    <div class="col-lg-6 d-flex justify-content-center">
      <div class="d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
          <svg class="bi" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">© 2023 GPM tu canal <a href="">www.GPMtucanal.com</a> .Todos los
          derechos reservados.</span>
      </div>

    </div>
    <div class="col-lg-6 d-flex justify-content-center">
      <ul class="nav list-unstyled d-flex text-center">
        <li class="ms-3"><a class="text-body-secondary" href="http://fb.me/gpmtucanal" target="_blank"><i class="bi bi-facebook"></i></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="https://wa.me/522223494596" target="_blank"><i class="bi bi-whatsapp"></i></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="https://www.instagram.com/gpm_tucanal/" target="_blank"><i class="bi bi-instagram"></i></a></li>
      </ul>
    </div>

  </div>

</footer>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
  integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="<?php echo JS . 'functions_ajax.js'; ?>"></script>
<script src="<?php echo JS . 'validationform.js'; ?>"></script>
<script src="<?php echo JS . 'formRequests.js'; ?>"></script>
<script src="<?php echo JS . 'generalRequests.js'; ?>"></script>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Buscar noticias</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerr"></button>
      </div>
      <div class="modal-body">


        <form class="DocSearch-Form "><label class="DocSearch-MagnifierLabel w-100" for="docsearch-input"
            id="docsearch-label">
            <div class="input-group mb-3">
              <i class="bi bi-search input-group-text" id="basic-addon1"></i>
              <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar"
                aria-describedby="basic-addon1" id="buscar" style="outline: none; box-shadow: none;">
            </div>
        </form>
        <div class=" overflow-auto " style=" max-height:220px; " id="busqueda">
        </div>
        <script>
          $("#buscar").on('input', function () {


            var searchTerm = $(this).val();
            // Crear un objeto FormData y agregar el valor del campo de búsqueda
            var formData = new FormData();
            formData.append('buscar', searchTerm);
            console.log(searchTerm);

            var baseUrl = window.location.origin;
            var searchUrl = baseUrl + '/framework/home/buscar';

            const method = {
              method: {
                element: 'busqueda',
                url: searchUrl,
                form: formData
              }
            }
            CrudAjaxHelper.processRequest(method)

            return false;
          })


          $("#cerr").on('click', function () {
            document.getElementById('buscar').value = ""
            document.getElementById('busqueda').innerHTML = ""
            return false;
          })


        </script>


      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


</body>

</html>