import { verificarLinkERedirecionar, interceptarCliques } from './testa_caminho.js';

function loadNav() {
  // Faz fetch do novo arquivo menu.html
  fetch("includes/menu.html") 
    .then((response) => response.text())
    .then((data) => {
      // Injeta o HTML diretamente no placeholder da navegação
      document.getElementById("nav-placeholder").innerHTML = data;
      
      // Manipulação da Navegação (Se a navegação foi injetada)
      const navbar = document.getElementById("mainNav");
      if (navbar) {
        // Seu código para remover 'scrolled' e marcar link ativo (text-warning)
        navbar.classList.remove("scrolled"); 
        
        // Exemplo: Marca o link 'Contato' como ativo
        const navLinks = navbar.querySelectorAll(".nav-link");
        navLinks.forEach((link) => {
            if (link.getAttribute('href') === 'contato2.html') {
                link.classList.add("text-warning");
            } else {
                link.classList.add("text-light"); 
            }
        });
        
        initializeNavEvents();
      }
    })
    .catch((error) => console.error("Falha ao carregar a navegação.", error));
}

// NOVO: Função para carregar SOMENTE o Rodapé
function loadFooter() {
    // Faz fetch do novo arquivo rodape.html
    fetch("includes/rodape.html") 
        .then((response) => response.text())
        .then((data) => {
            // Injeta o HTML diretamente no placeholder do rodapé
            document.getElementById("footer-placeholder").innerHTML = data;
        })
        .catch((error) => console.error("Falha ao carregar o rodapé.", error));
}


// Função para inicializar os eventos do menu (mantida igual)
function initializeNavEvents() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const toggleBtn = document.getElementById("toggleBtn");
  const navbar = document.getElementById("mainNav");

  // ATENÇÃO: É VITAL que os IDs (sidebar, overlay, toggleBtn) existam no DOM
  // antes que esses event listeners sejam adicionados. Eles agora existem após o loadNav()!

  if (toggleBtn) {
    toggleBtn.addEventListener("click", () => {
      sidebar.classList.add("active");
      overlay.classList.add("active");
    });
  }
  
  if (overlay) {
    overlay.addEventListener("click", () => {
      sidebar.classList.remove("active");
      overlay.classList.remove("active");
    });
  }

  if (navbar) {
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });
  }
}

// Inicia o carregamento de AMBOS no DOMContentLoaded
document.addEventListener("DOMContentLoaded", () => {
  loadNav();    // Carrega o menu
  loadFooter(); // Carrega o rodapé
});