document.addEventListener("DOMContentLoaded", function(event){
    console.log("pagina cargada")
    document.getElementById("selectAnimales").addEventListener("change", function(event){
        console.log(event.srcElement.value);
        let animal = event.srcElement.value;
        let razas = fetch("../FindMyPet/json/razas.json");
        razas.then(function(response){console.log(response)})
    })
    
   
})