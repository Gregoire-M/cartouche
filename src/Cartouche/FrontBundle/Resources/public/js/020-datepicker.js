var datize = function (elm) {
    $(elm).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNamesMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
        showAnim: "blind",
        prevText: "Prec.",
        nextText: "Suiv.",
        firstDay: 1
    });
};
