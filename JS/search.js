const searchInput = document.getElementById('searchBar');

searchInput.addEventListener('input', () => {//lorsque on click sur la barre de recherche 
  const contenuSearch = searchInput.value.toLowerCase();//on recupere se que l'utillisateur tape
  const allCards = document.querySelectorAll('.carte'); // on récupère toutes les cartes

  allCards.forEach(card => {
    const name = card.querySelector('.blaze')?.textContent.toLowerCase();//on va cherchez se que contient ma div avec la classe blaze 
    if (name && name.includes(contenuSearch)) {//on regarde si la div blaze contient se qui est ecrit par l'utillisateur et si y a quelque chose d'écrit 
      card.classList.remove('disapear'); // on affiche si ça match
    } else {
      card.classList.add('disapear'); // sinon on cache
    }
  });
});