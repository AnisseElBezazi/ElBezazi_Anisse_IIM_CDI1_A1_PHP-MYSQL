/*sideBar*/

let MenuMobile =document.querySelector(".tra") /* Bouton avec les 3 traits  */
let Depliant = document.querySelector(".Depliable")/*Menu depliant */

MenuMobile.addEventListener ("click",function(){ /* lorsque qu'on click sur les 3 traits  */
   Depliant.classList.toggle("menu-visible");/*On rajoute au menu depliant une class ccs lui permetant de passer l'opacité a 1 et changer sa position */
})


/*dark mode*/
let BoutonDark= document.querySelector("#dark");
let Page= document.querySelector("body");
let Top = document. querySelector("header");
let Traits = document.querySelector(".tra");/*creation de variable qui appele ici la class tra dans le DOM pour ensuite l'utiliser dans mon code */
let TopLeft = document.querySelector(".traits");
// let filtre = document.querySelector(".filtre");
let sideBar = document.querySelector(".Depliable");

BoutonDark.addEventListener ("click",function(){ /*Lorsque le bouton darkmode est cliquer  */
  Page.classList.toggle('dark-back');/*on ajoute des class css a chaque element afin de changer l'image du background et la couleur des text */
  Top.classList.toggle('dark-haut');
  // filtre.classList.toggle('dark-filtre'); 
  TopLeft.classList.toggle('haut-gauche-dark');/*meme principe partout  */
  sideBar.classList.toggle('dark-side-bar'); 
});

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


/*filtre*/

let tabs = document.querySelectorAll('.tab');//crée une liste avec tout les bouton 

tabs.forEach(tab=>{//pour chaque bouton 
  tab.addEventListener('click',()=>{//si cliquer
    tabs.forEach(tab=>tab.classList.remove('active-filtre')); // je retire le background bleu a tout les bouton
    tab.classList.add('active-filtre');// Rajoute le fon
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








/*Slider*/

let indexcarte = 0; /* n'est pas vraiment affecter a une carte*/
function slider_de_carte() {
   const cartes= document.querySelectorAll('.carte'); /* creation d'une liste */
    const totalCartes=cartes.length;    
    const deplacement=-indexcarte *475 ; /*ici on calcule de deplacement necessaire avec une valeur negatif car l'index des carte est toujours positif et qu'on souhaite deplacer la carte vers la gauche   */
    document.querySelector('.cartes').style.transform = `translateX(${deplacement}px)`; /*change le style css pour deplacer les carte du slider de leur taille (500px + le gap entre elles ici 30) */
}
function moveSlide(direction){/*Parametre direction est soit -1 pour la gauche  soit 1 pour la droite */
const cartes=document.querySelectorAll('.carte'); /*Creation d'une Nodelist avec toutes les cartes  */
  const totalCartes=cartes.length -1; /*Le total de Cartes est ici egal au nombre de carte present dans la Nodelist crée precedement (-1 car c'est un slider de 3 cartes et il va trops loins sinon) */
    indexcarte= (indexcarte+direction+totalCartes)%totalCartes; /*(calcul le reste, met a jour l'index pour avoir un slider circulaire*/  
    slider_de_carte();/*appele la fonction slider pour deplacer les carte selon l'index calculer   */
}





