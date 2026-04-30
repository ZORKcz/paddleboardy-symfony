// FAQ
const otazky = document.querySelectorAll('.faq-question');

otazky.forEach(otazka => {
    otazka.addEventListener('click', () => {
        // Připnu třídu active (pro animaci)
        otazka.classList.toggle('active');

        // Animace rozbalení odpovědi
        const odpoved = otazka.nextElementSibling;
        if (odpoved.style.maxHeight) {
            odpoved.style.maxHeight = null;
        } else {
            odpoved.style.maxHeight = odpoved.scrollHeight + "px";
        }
    });
});

// Hamburger Menu
const hamburger = document.querySelector('.hamburger');
const sidebar = document.querySelector('.sidebar');
const sidebarOverlay = document.querySelector('.sidebar-overlay');
const sidebarLinks = document.querySelectorAll('.sidebar-links a');

// Funkce pro přepnutí menu
function toggleSidebar() {
    hamburger.classList.toggle('active');
    sidebar.classList.toggle('active');
    sidebarOverlay.classList.toggle('active');
    //Zamezení scrollování stránky při otevřeném menu
    document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
}

// Event listeners
if (hamburger) {
    hamburger.addEventListener('click', toggleSidebar);
}

if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', toggleSidebar);
}

// Zavření sidebaru po kliknutí na odkaz
sidebarLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (sidebar.classList.contains('active')) {
            toggleSidebar();
        }
    });
});

// Zavření sidebaru při zvětšení okna (např. otočení telefonu)
window.addEventListener('resize', () => {
    if (sidebar && window.innerWidth > 992 && sidebar.classList.contains('active')) {
        toggleSidebar();
    }
});
