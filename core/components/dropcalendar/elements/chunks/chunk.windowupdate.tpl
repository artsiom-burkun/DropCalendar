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
            <label class='control-label'>Категория</label>
            <select class='form-control' name='category'>
                <option value='label-green'>Тренировка</option>
                <option value='label-default'>Игра</option>
                <option value='label-purple'>Турнир</option>
                <option value='label-orange'>Вечеринка</option>
                <option value='label-yellow'>День рождения</option>
                <option value='label-teal'>Собрание родителей</option>
                <option value='label-beige'>Поездка</option>
            </select>
        </div>
    </div>
</div>

<span class='input-group-btn'>
        <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> Сохранить изменения</button>
    </span>