$(document).ready(function() {
    $('#kt_dataTable').DataTable({
        "createdRow": function(row, data, dataIndex) {
            const promotionAnnee = parseInt(data[3]); // colonne "Année"
            const anneeActuelle = new Date().getFullYear();

            if (promotionAnnee <= (anneeActuelle - 2)) {
                $(row).css('background-color', '#f8d7da'); // rouge clair
                $(row).css('color', '#842029'); // texte rouge foncé
            }
        }
    });
});
