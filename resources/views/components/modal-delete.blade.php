<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa-solid fa-trash-can"></i> Удаление</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Вы уверены что хотите удалить данную запись</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
                <form method="post" class="delete-form">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Да</button>
                </form>
            </div>
        </div>
    </div>
</div>
