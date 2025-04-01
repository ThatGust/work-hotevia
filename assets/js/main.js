document.addEventListener('DOMContentLoaded', function() {
    // SWITCH ENTRE FILTROS
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            document.getElementById('filtro-puesto').style.display = this.dataset.target === 'filtro-puesto' ? 'block' : 'none';
            document.getElementById('filtro-lugar').style.display = this.dataset.target === 'filtro-lugar' ? 'block' : 'none';
        });
    });


    // TOGGLE DEL MENÚ DE PUESTO
    var toggleButton = document.getElementById('puesto-toggle');
    var dropdownMenu = document.getElementById('puesto-menu');
    var radios = dropdownMenu.querySelectorAll('input[type="radio"]');
    var selectedText = toggleButton.querySelector('span');

    toggleButton.addEventListener('click', function() {
        dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') ? 'block' : 'none';
    });

    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            selectedText.textContent = this.nextElementSibling.textContent;
            dropdownMenu.style.display = 'none';
        });
    });

    document.addEventListener('click', function(event) {
        if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
