<div id="modalImport" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nova Função</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data" class="">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Label</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="label" value="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right float-right">
                            <button type="submit" class="btn btn-outline-info">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>
