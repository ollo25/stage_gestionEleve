document.addEventListener('DOMContentLoaded', () => {
    // 1. Sélection des éléments avec des IDs clairs
    const inputAdresse = document.getElementById('entreprise_form_adresse');
    const suggestionsContainer = document.getElementById('autocomplete-suggestions');
    const formContainer = document.querySelector('.form-container'); // Ajoutez cette classe à votre formulaire

    if (!inputAdresse) {
        console.error("Erreur: Champ input introuvable. Vérifiez l'ID 'autocomplete-input'");
        return;
    }

    if (!suggestionsContainer) {
        console.error("Erreur: Container des suggestions introuvable. Vérifiez l'ID 'autocomplete-suggestions'");
        return;
    }

    console.log("Initialisation de l'autocomplete avec succès");

    // 2. Fonctions utilitaires améliorées
    const clearSuggestions = () => {
        suggestionsContainer.innerHTML = '';
        suggestionsContainer.style.display = 'none';
    };

    const showSuggestions = (results) => {
        clearSuggestions();
        if (!results?.length) {
            console.debug("Aucun résultat trouvé");
            return;
        }

        suggestionsContainer.style.display = 'block';

        results.forEach(item => {
            const suggestion = document.createElement('div');
            suggestion.className = 'suggestion-item';

            // Meilleure présentation des résultats
            suggestion.innerHTML = `
                <div class="suggestion-main">${item.label}</div>
                ${item.postalCode ? `<div class="suggestion-detail">${item.postalCode} ${item.city || ''}</div>` : ''}
            `;

            suggestion.addEventListener('click', () => {
                inputAdresse.value = item.value;
                clearSuggestions();

                // Mise à jour des champs associés
                if (item.postalCode && document.getElementById('code_postal')) {
                    document.getElementById('code_postal').value = item.postalCode;
                }
                if (item.city && document.getElementById('ville')) {
                    document.getElementById('ville').value = item.city;
                }
            });

            suggestionsContainer.appendChild(suggestion);
        });
    };

    // 3. Debounce optimisé
    let timeout;
    const fetchSuggestions = async (query) => {
        try {
            const response = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`);
            if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);
            const data = await response.json();

            const results = data.features.map(feature => ({
                label: feature.properties.label,
                value: feature.properties.label,
                city: feature.properties.city,
                postalCode: feature.properties.postcode
            }));

            showSuggestions(results);
        } catch (error) {
            console.error("Erreur de fetch:", error);
            clearSuggestions();
        }
    };



    // 4. Gestion des événements
    inputAdresse.addEventListener('input', (e) => {
        const query = e.target.value.trim();
        clearTimeout(timeout);

        if (query.length < 3) {
            clearSuggestions();
            return;
        }

        timeout = setTimeout(() => fetchSuggestions(query), 3);
    });

    // Fermer les suggestions quand on clique ailleurs
    document.addEventListener('click', (e) => {
        if (!formContainer?.contains(e.target)) {
            clearSuggestions();
        }
    });

    // 5. Initialisation du style
    suggestionsContainer.style.width = `${inputAdresse.offsetWidth}px`;
});
