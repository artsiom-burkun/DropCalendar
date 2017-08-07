    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label class='control-label'>Имя события</label>
                <input class='form-control' type='text' name='title' value='" + calEvent.title + "'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label class='control-label'>Время начала:</label>
                <input class='form-control' value='" + calEvent.start.format("YYYY-MM-DD HH:mm") + "' type='text' name='start'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label class='control-label'>Место проведения:</label>
                <input class='form-control' value='" + calEvent.mesto + "' type='text' name='mesto'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label class='control-label'>Конец:</label>
                <input class='form-control' value='" + calEvent.end.format("YYYY-MM-DD HH:mm") + "' type='text' name='end'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label class='control-label'>Примечание:</label>
                <input class='form-control' value='" + calEvent.prim + "' type='text' name='prim'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label class='control-label'>Сайт:</label>
                <input class='form-control' value='" + calEvent.site + "' type='text' name='site'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <label class='control-label'>Цвет события:</label>
                <select class='form-control' name='category'>
                    <option value='label-green'>Зеленый</option>
                    <option value='label-default'>Синий</option>
                    <option value='label-purple'>Фиолетовый</option>
                    <option value='label-orange'>Оранжевый</option>
                    <option value='label-yellow'>Желтый</option>
                    <option value='label-teal'>Пурпурный</option>
                    <option value='label-beige'>Бежевый</option>
                </select>
            </div>
        </div>
    </div>

    <span class='input-group-btn'>
            <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> Сохранить изменения</button>
        </span>