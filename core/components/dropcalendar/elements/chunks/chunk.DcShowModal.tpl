<div id="modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Событие:</p>
            <button class="delete" aria-label="close" onclick='closeModal()'></button>
        </header>

        <section class="modal-card-body">
            <div class="content">
                <p id='modal-title' class='title is-4'></p>
                <p id='modal-time' class='subtitle is-6'></p>
                <p id='modal-content'></p>
            </div>
        </section>

        <footer class="modal-card-foot">
            <button class="button" onclick='closeModal()'>Отмена</button>
        </footer>
    </div>
</div>