openNavButton = document.getElementById('responsive-menu');
nav = document.getElementById('nav-responsive');
openedNav = false;

openNavButton.addEventListener("click", ()=>{
    if (!openedNav) {
        nav.style.display = "block";
        nav.style.animation= "aparecer 1s forwards";
        openedNav = true;
    } else {
        nav.style.animation= "desaparecer 1s forwards";
        nav.style.display = "none";
        openedNav = false;
    }
    
})