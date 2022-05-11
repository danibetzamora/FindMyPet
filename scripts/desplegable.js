desplegable = document.getElementById('selector-image');
aside = document.getElementById('aside');
opened = false;

desplegable.addEventListener("click", ()=>{
    if (!opened) {
        aside.style.display = "flex";
        opened = true;
    } else {
        aside.style.display = "none";
        opened = false;
    }
})