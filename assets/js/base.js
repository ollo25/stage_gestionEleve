document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.nav-item');
    const indicator = document.querySelector('.nav-indicator');

    items.forEach(item => {
        item.addEventListener('click', function() {
            // Met à jour les classes actives
            items.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            // Anime l'indicateur
            indicator.style.width = `${this.offsetWidth}px`;
            indicator.style.left = `${this.offsetLeft}px`;
        });
    });

    // Initialise avec l'élément actif par défaut
    const active = document.querySelector('.nav-item.active');
    if (active) {
        indicator.style.width = `${active.offsetWidth}px`;
        indicator.style.left = `${active.offsetLeft}px`;
    }
});
