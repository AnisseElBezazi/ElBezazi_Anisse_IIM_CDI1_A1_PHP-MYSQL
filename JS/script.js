/*sideBar*/

let MenuMobile =document.querySelector(".tra") /* Bouton avec les 3 traits  */
let Depliant = document.querySelector(".Depliable")/*Menu depliant */

MenuMobile.addEventListener ("click",function(){ /* lorsque qu'on click sur les 3 traits  */
   Depliant.classList.toggle("menu-visible");/*On rajoute au menu depliant une class ccs lui permetant de passer l'opacité a 1 et changer sa position */
})

/*Modal echange*/
let PageEchange = document.querySelector(".echange-body") /*Page pour echanger dans le DOM */
let boutonEchange =document.querySelector(".echange-bouton")/*Bouton echanger en bas a droite du DOM */
let Croix = document.querySelector(".croix")/*Croix presente en haut a droite de ma page echanger dans le DOM */

boutonEchange.addEventListener('click', function() {/*Lorsque on click sur le bouton echanger */
    PageEchange.classList.add("apear")/*ajout d'une class CSS qui pour seul but d'ajouter un display Block */
});

Croix.addEventListener('click', function() {/*Lorsque on click sur la croix */
    PageEchange.classList.remove("apear");/*retire une class CSS qui pour seul but d'ajouter un display Block */
});

async function CartesPokemon() {
    const container = document.querySelector('.cartes2');
      const reponse = await fetch('https://pokeapi.co/api/v2/pokemon?limit=200');//J'envoie une requete a l'api pour avoir une reponse brute
      const Api1 = await reponse.json(); // Je met la reponse en json 
  
      for (const pokemon of Api1["results"]) { //pour chaque element de la liste results de l'Api je le stock dans la variable pokemon et fait les commande qui suivent 
        const Api2Rep = await fetch(pokemon["url"]);// requete de l'api du pokemon en allant cherchez sont url (Api dans l'Api)
        const Api2 = await Api2Rep.json();//Met la reponse en Json
        const image = Api2["sprites"]["versions"]["generation-v"]["black-white"]["animated"]["front_default"];//dans le json je vais cherchez l'url du gif de ma carte pokemon et le stock (c'est commme un chemin d'accés entre objet)
        const backupImage = Api2["sprites"]["other"]["official-artwork"]["front_default"];
        const type = Api2["types"][0]["type"]["name"];//meme principe sauf que sa commence avec une liste et je prends le premiere element da la liste
        const pv = Api2["stats"][0]["base_stat"];
        const nom = Api2["name"]; 

        //code pour la capacité 1 et pour avoir la description en anglais 
        const capa1 = Api2["abilities"][0]["ability"]["name"];
        const urlCapa1 = Api2["abilities"][0]["ability"]["url"];
        const repCap1 = await fetch(urlCapa1);
        const dataCap1 = await repCap1.json();
        

        dataCap1["effect_entries"].forEach(effect => { //pour chaque element de la liste effect_entries je regarde si la variable name contient bien en pour que sa soit bien en anglais
        if (effect.language.name === "en") {
            effect1 = effect.short_effect;
        }
        });

        let capa2 = "";
        let effect2 = ""; //vide les variable en rapport avec la capacité 2

        if (Api2["abilities"][1]) { //verifie si il existe bien une deuxieme competence
        capa2 = Api2["abilities"][1]["ability"]["name"];
        const urlCapa2 = Api2["abilities"][1]["ability"]["url"];

        const repCap2 = await fetch(urlCapa2);
        const dataCap2 = await repCap2.json();

        dataCap2.effect_entries.forEach(effect => { //pareille que pour la 1
            if (effect.language.name === "en") {
            effect2 = effect.short_effect;
            }
        });
        }

        let ImageFinal;
        if (image) {
          ImageFinal = image;
        } else {
          ImageFinal = backupImage;
        }

        // dans la division qui a la class cartes2 dans mon html je rajoute tout ces ligne qui permettent d'afficher les donné que j'ai stocker dans les variables
        container.innerHTML += `
            <div class="${type} carte">
            <div class="vie">${pv} PV</div>
            <div class="blaze">${nom}</div>
            <div class="PokeGif"><img src="${ImageFinal}" alt="${nom}"></div>
            <div class="Type">Type : ${type}</div>
            <div class="abilities"><strong>${capa1}</strong></div>
            <div class="Detabilities">${effect1}</div>
            <div class="abilities"><strong>${capa2}</strong></div>
            <div class="Detabilities">${effect2}</div>
            <div class="non-favoris"><img src="image/coeur-vide.png" alt="coeur-vide"></div>
            </div>
        `;

        /*Favoris*/

const cartes=document.querySelectorAll('.carte');

cartes.forEach(carte => {
  const nonFavoris = carte.querySelector('.non-favoris img'); /*Pour chaque carte on selectionne l'image de la class non-favoris */

  nonFavoris.addEventListener('click', function(e) { /*Lorsqu'on click sur un coeur  */
    e.stopPropagation();
      if (nonFavoris.getAttribute('src') === 'image/coeur-vide.png') {/*Si le src de ma class nonFavoris est l'image de coeur vide */
          nonFavoris.setAttribute('src', 'image/coeur-plein.png'); /*Alors je modifie le src de ma class par une image de coeur plein   */
          nonFavoris.classList.add('opaciterMax'); /*et je met l'opacité au max pour que celui ci ne soit pas affecter par le hover */
      } else {
          nonFavoris.setAttribute('src', 'image/coeur-vide.png');  /*sinon je remplace le src par une image de coeur vide */
          nonFavoris.classList.remove('opaciterMax');/*j'enleve l'opacité au max par default pour que le coeur vide apparait seulement quand on passe au dessus d'une carte */
      }
  });
  
});


}

activerPopup()
}

CartesPokemon();

//afficher la carte 

function activerPopup() {
  const cartes = document.querySelectorAll('.carte');

  cartes.forEach(carte => {//pour chaque carte 
    carte.addEventListener('click', () => {//au click
      const popup = document.getElementById("popup");
      const popupContent = document.getElementById("popup-content");
      popupContent.innerHTML = '';//vide la division popupContent
      const clone = carte.cloneNode(true);//permet de cloner la carte 
      popupContent.appendChild(clone); //permet de rajouter en tant qu'enfant  l'html qu'on a cloner 
      popup.classList.remove("disapear");
    });
  });
}

document.addEventListener("click", function (e) {
  if (e.target.id === "popup-content" || e.target.id === "popup") {
    document.getElementById("popup").classList.add("disapear");
  }
});



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

  
/*filtre*/

let tabs = document.querySelectorAll('.tab');//crée une liste avec tout les bouton 

tabs.forEach(tab=>{//pour chaque bouton 
  tab.addEventListener('click',()=>{//si cliquer
    tabs.forEach(tab=>tab.classList.remove('active-filtre')); // je retire le background bleu a tout les bouton
    tab.classList.add('active-filtre');// Rajoute le fond bleu
    let type = tab.getAttribute('type');//je vais chercher se qui est stocker dans type dans le html pour le tab clicker
    const cartes = document.querySelectorAll('.carte'); //crée une liste avec toutes les cartes 
    cartes.forEach(carte=>{ 
      carte.classList.remove('disapear');//je fait apparaitre tout les cartes en enlevant le display none 
      if (type==='All') return;// si le tab cliquer est All j'arrete la boucle des cartes 

      if (!carte.classList.contains(type)) {//si la carte n'as pas la class correspondant au type bah je l'a fait disparaitre 
        carte.classList.add('disapear');
      }
    });
  });
});






/*dark mode*/
let BoutonDark= document.querySelector("#dark");
let Page= document.querySelector("body");
let Top = document. querySelector("header");
let Traits = document.querySelector(".tra");/*creation de variable qui appele ici la class tra dans le DOM pour ensuite l'utiliser dans mon code */
let TopLeft = document.querySelector(".traits");
let filtre = document.querySelector(".filtre");
let sideBar = document.querySelector(".Depliable");
let Recherche = document.querySelector("#searchBar");

BoutonDark.addEventListener ("click",function(){ /*Lorsque le bouton darkmode est cliquer  */
  Page.classList.toggle('dark-back');/*on ajoute des class css a chaque element afin de changer l'image du background et la couleur des text */
  Top.classList.toggle('dark-haut');
  Recherche.classList.toggle('Search');
  filtre.classList.toggle('dark-filtre'); 
  TopLeft.classList.toggle('haut-gauche-dark');/*meme principe partout  */
  sideBar.classList.toggle('dark-side-bar'); 
});

/*Slider*/

let indexcarte = 0; /* n'est pas vraiment affecter a une carte*/
function slider_de_carte() {
   const cartes= document.querySelectorAll('.carte2'); /* creation d'une liste */
    const totalCartes=cartes.length;    
    const deplacement=-indexcarte *500 ; /*ici on calcule de deplacement necessaire avec une valeur negatif car l'index des carte est toujours positif et qu'on souhaite deplacer la carte vers la gauche   */
    document.querySelector('.cartes').style.transform = `translateX(${deplacement}px)`; /*change le style css pour deplacer les carte du slider de leur taille (500px + le gap entre elles ici 30) */
}
function moveSlide(direction){/*Parametre direction est soit -1 pour la gauche  soit 1 pour la droite */
const cartes=document.querySelectorAll('.carte2'); /*Creation d'une Nodelist avec toutes les cartes  */
  const totalCartes=cartes.length -1; /*Le total de Cartes est ici egal au nombre de carte present dans la Nodelist crée precedement (-1 car c'est un slider de 3 cartes et il va trops loins sinon) */
    indexcarte= (indexcarte+direction+totalCartes)%totalCartes; /*(calcul le reste, met a jour l'index pour avoir un slider circulaire*/  
    slider_de_carte();/*appele la fonction slider pour deplacer les carte selon l'index calculer   */
}








