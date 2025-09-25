
async function TauxDevise() {


  
    const devise= document.querySelector('.Devise');
    const Fin= document.querySelector('.Fin');
    let nombre= document.querySelector('#nombre');
    let resfinal= document.querySelector('.resultat');
    let montant = parseFloat(nombre.value);
    const response = await fetch('https://v6.exchangerate-api.com/v6/8591ff1a7ff214e46bea68ea/latest/USD');
    const data = await response.json();
    console.log(data);

    for (let i in data.conversion_rates){
    devise.innerHTML += `<option value="${i}">${i}</option>`;
    }

    let Base = data;
    let choix2 = 'USD';


    devise.addEventListener('change', async (e) => {
        const choix = e.target.value;
        console.log(choix);
        const rep = await fetch(`https://v6.exchangerate-api.com/v6/8591ff1a7ff214e46bea68ea/latest/${choix}`)
        Base = await rep.json();
        console.log(Base);
        montant = parseFloat(nombre.value);
        resultat = montant* Base.conversion_rates[choix2];  
        resfinal.innerHTML = `<li class="text-center">${resultat} ${choix2}</li>`;    
    });

     for (let i in data.conversion_rates){
    Fin.innerHTML += `<option value="${i}">${i}</option>`;
    }

      Fin.addEventListener('change', async (e) => {
        choix2 = e.target.value;
        console.log(Base.conversion_rates[choix2]);
        montant = parseFloat(nombre.value);
        resultat = montant* Base.conversion_rates[choix2];  
        resfinal.innerHTML = `<li class="text-center">${resultat} ${choix2}</li>`;   
    })




     nombre.addEventListener('input', function() {
        montant = parseFloat(nombre.value);
        resultat = montant* Base.conversion_rates[choix2];
        console.log(Base.conversion_rates[choix2]);
        console.log(resultat);
        resfinal.innerHTML = `<li class="text-center">${resultat} ${choix2}</li>`;

    })
       
}

TauxDevise();

