<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditModalTask">Редактирование задания</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="task_id">
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="class_name">Класс задания</label>
                        <input class="form-control" id="class_name" placeholder="WHMCS\Module\Addon\TaskManager\Cron\MyTask">
                    </div>
                    <div class="form-group">
                        <label for="priority">Приоритет</label>
                        <input class="form-control" type="number" id="priority">
                    </div>
                    <div class="form-group">
                        <label for="frequency">Частота повторения (Минуты)</label>
                        <input class="form-control" type="number" id="frequency">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" id="description" maxlength="400" rows="6"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button id="saveTask" type="button" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
            </div>
        </div>
    </div>
</div>