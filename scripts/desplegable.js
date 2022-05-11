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

window.addEventListener("resize", ()=>{
    if (document.documentElement.clientWidth > 1250) {
        aside.style.display = "flex";
    }

    if (document.documentElement.clientWidth < 1250) {
        aside.style.display = "none";
    }
})