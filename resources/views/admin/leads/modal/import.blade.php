<div id="modalImport" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Importar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lead.import') }}" method="post" enctype="multipart/form-data" class="btn btn-light">
                    <label>Selecione um arquivo: </label>
                    <input type="file" name="file">
                    @csrf
                    <input class="btn btn-info" type="submit" value="Upload">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn btn-light" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>
