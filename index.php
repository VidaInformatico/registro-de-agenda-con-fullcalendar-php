<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalEvento" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_evento">
                    <div class="mb-3">
                        <label for="" class="form-label">Titulo</label>
                        <input type="text" id="titulo" class="form-control" placeholder="Titulo" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Inicio</label>
                        <input type="date" id="fecha_inicio" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Fin</label>
                        <input type="date" id="fecha_fin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color</label>
                        <input type="color" id="color" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/index.global.min.js"></script>
    <script src="assets/js/es.global.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>