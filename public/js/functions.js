function copyText() {

    //Récupération du texte
    var copyText = document.getElementById("mailCopy")

    //Selection du champ de texte
    copyText.select();
    copyText.setSelectionRange(0,99999); //pour les mobiles

    //Copier le texte à l'intérieur de la div
    navigator.clipboard.writeText(copyText.p);

    //Alerter que le texte a été copié
    alert("Texte copié : " + copyText.p);
}