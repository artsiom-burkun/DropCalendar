<div id="modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Событие:</p>
            <button class="delete" aria-label="close" onclick='closeModal()'></button>
        </header>
        <section class="modal-card-body">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">Заголовок события:</label>
                        <input class="input" type="text" id="form-title" name="form-title" >
                    </div>

                    <div class="field">
                        <table class="table m-b-5">
                            <thead>
                            <th>Дата:</th>
                            <th>Начало:</th>
                            <th>Конец:</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input class="input date" type="text" id="form-start" name="form-start">
                                </td>
                                <td>
                                    <input class="input time" type="text" id="form-start-time" placeholder="с">
                                </td>
                                <td>
                                    <input class="input time" type="text" id="form-end-time" placeholder="по">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <label class="checkbox">
                            <input type="checkbox" name="allDayForm" id="allDayForm">
                            Весь день
                        </label>
                    </div>

                    <div class="field">
                        <label class="label">Примечание:</label>
                        <textarea class="textarea" id="form-info" name="form-info" rows="2"></textarea>
                    </div>
                </div>

                <div class="column">
                    <div class="field">
                        <label class="label">Оформление:</label>

                        <div id="form-external-event" class="event-category" style="background-color: #3d9400" ><br>
                            <input id="form-background-color" type="hidden" value="#3d9400">
                            <input id="form-border-color" type="hidden" value="#3d9400">
                            <input id="form-text-color" type="hidden" value="#ffffff">
                        </div>

                        <table class="table colors" width="100%" id="modal-table">
                            <tr>
                                <td class="label-width">
                                    <div class="fc-color m-r-5" style="background-color: #3d9400; border: 1px solid; #3d9400; color: #ffffff" onclick="changeFormColor('#3d9400', '#3d9400', '#ffffff')">
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <span class="scout-names">Зелёный</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-width">
                                    <div class="fc-color m-r-5" style="background-color: #0a76f2; border: 1px solid; #0a76f2; color: #ffffff" onclick="changeFormColor('#0a76f2', '#0a76f2', '#ffffff')">
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <span class="scout-names">Синий</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-width">
                                    <div class="fc-color m-r-5" style="background-color: #f50a0a; border: 1px solid; #f50a0a; color: #000000" onclick="changeFormColor('#f50a0a', '#f50a0a', '#000000')">
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <span class="scout-names">Красный</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-width">
                                    <div class="fc-color m-r-5" style="background-color: #ffffff; border: 1px solid; #000000; color: #000000" onclick="changeFormColor('#ffffff', '#000000', '#000000')">
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <span class="scout-names">Белый</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-width">
                                    <div class="fc-color m-r-5" style="background-color: #fff648; border: 1px solid; #000000; color: #000000" onclick="changeFormColor('#fff648', '#000000', '#000000')">
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <span class="scout-names">Жёлтый</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-width">
                                    <div class="fc-color m-r-5" style="background-color: #080707; border: 1px solid; #080707; color: #ffffff" onclick="changeFormColor('#080707', '#080707', '#ffffff')">
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <span class="scout-names">Чёрный</span>
                                </td>
                            </tr>
                        </table>
                    </div>


                </div>
            </div>

        </section>
        <footer class="modal-card-foot">
            <button id="save-new" onclick="saveNewEvent()" class="button is-success">Сохранить</button>
            <button id="save-changes" onclick="updateCurrentEvent()" class="button is-success">Сохранить изменения</button>
            <button id="delete-button" onclick="deleteEvent()" class="button is-danger">Удалить</button>
            <button class="button" onclick='closeModal()'>Отмена</button>
        </footer>
    </div>
</div>