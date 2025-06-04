document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.nav-item');
    const indicator = document.querySelector('.nav-indicator');

    // Trouve l'élément actif (depuis Twig)
    const active = document.querySelector('.nav-item.active');
    if (active && indicator) {
        indicator.style.transition = 'none'; // pas d'animation
        indicator.style.width = `${active.offsetWidth}px`;
        indicator.style.left = `${active.offsetLeft}px`;
    }

    // (Optionnel) Pour une MAJ dynamique au clic
    items.forEach(item => {
        item.addEventListener('click', function () {
            items.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            indicator.style.transition = 'none';
            indicator.style.width = `${this.offsetWidth}px`;
            indicator.style.left = `${this.offsetLeft}px`;
        });
    });
});
