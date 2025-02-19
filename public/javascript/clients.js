const d = document;

const $botoveurer = d.querySelectorAll(".botoVeurer");


// Quan he agafat TOTS els botons, tinc que iterar el nodelist que em retorna


$botoveurer.forEach((boto)=>{


    boto.addEventListener("click",(e)=>{
        e.preventDefault();
        let url = boto.getAttribute('href'); // Almacenem la url a la que ens envia el boto
        const $posicio = d.querySelector(".contingut-veurer-client");
        const $modal = d.getElementById("clientModal");
        const modalInstance = new bootstrap.Modal($modal); // Aixo em vec obligat a ficar-ho per temes de bootstrap
    
        
        $.ajax({        // Aqui dic que es una solicitud ajax
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                let contingut = 
                    `<p><strong>Nom:</strong> ${data.nom}</p>
                    <p><strong>Cognoms:</strong> ${data.cognoms}</p>
                    <p><strong>Empresa:</strong> ${data.empresa ? data.empresa : '-'}</p>
                    <p><strong>Tipus Client:</strong> ${data.tipus_client}</p>
                    <p><strong>Adreça:</strong> ${data.adreça ? data.adreça : '-'}</p>
                    <p><strong>Telefon:</strong> ${data.telefon ? data.telefon : '-'}</p>
                    <p><strong>Correu Electrònic:</strong> ${data.correu_electronic}</p>
                    <p><strong>NIF:</strong> ${data.nif ? data.nif : '-'}</p>`;
    
                $posicio.innerHTML=contingut;
                modalInstance.show();
            },
            error: function(){
                alert('Error carregant els detalls del client.');
            }
        });
    });


})



const $botoEditar = d.querySelectorAll(".boto-Editar")


$botoEditar.forEach((boto)=>{
    boto.addEventListener("click",(e)=>{
        e.preventDefault();
        let url = boto.getAttribute('href'); // Almacenem la url a la que ens envia el boto
        const $contingut = document.querySelector(".contingut-editar-client");
        const $id = d.getElementById("clientEditModal");
        const modalInstance = new bootstrap.Modal($id);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                $contingut.innerHTML=response.html;
                modalInstance.show();
            },
            error: function(){
                alert('Error carregant el formulari d\'edició.');
            }
        });
    })
})






const $botoAfegir = d.querySelectorAll(".boto-Afegir")


$botoAfegir.forEach((boto)=>{
    boto.addEventListener("click",(e)=>{
        e.preventDefault();
        let url = boto.getAttribute('href'); // Almacenem la url a la que ens envia el boto
        const $contingut = document.querySelector(".contingut-afegir-client");
        const $id = d.getElementById("clientAddModal");
        const modalInstance = new bootstrap.Modal($id);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                $contingut.innerHTML=response.html;
                modalInstance.show();
            },
            error: function(){
                alert('Error carregant el formulari d\'edició.');
            }
        });
    })
})


const $buscar = d.querySelector("#btnCarregaFormBuscar");

$buscar.addEventListener("click", async (e) => {
    e.preventDefault();
    let url = $buscar.getAttribute("href");
    const $contingut = d.querySelector("#buscarModal .modal-body");
    const $id = d.querySelector("#buscarModal");
    const modalInstance = new bootstrap.Modal($id);

    // El await sol es fa servir cuan hi ha algo que retorna una promesa, para el codi, fa la promesa i retorna el resultat
    // si no el fico em retorna l'objecte promesa, NO el resultat

    try {

        $contingut.innerHTML = '<div class="spinner-border" role="status"></div>';

        let resposta = await fetch(url, {
            method: "GET",
            headers: { "Accept": "application/json" },
            // el headers vol dir que "prefereixo" json, pero al controlador tinc que dir que retorni json obligatoriament
        })

        

        

        if (!resposta.ok) {
            throw new Error(`Error al carregar la resposta. Error: ${resposta.status}` );
        }

        let dadesJSON = await resposta.json();

        $contingut.innerHTML=dadesJSON.codi;
        modalInstance.show();

        
    } catch (error) {
        console.error(error);
        alert(`Error: ${error}`)
        
    }
})