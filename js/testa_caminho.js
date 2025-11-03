// ===================================
// Documentação: Módulo de Verificação de Caminho
// Ficheiro: js/testa_caminho.js
// ===================================

// URL da página de construção (assumindo que está na raiz do projeto)
const TELA_DE_CONSTRUCAO = 'construcao.html';

/**
 * Função assíncrona para verificar a disponibilidade de um URL e redirecionar em caso de falha.
 *
 * @param {string} urlParaTestar O link (URL) a ser verificado.
 * @returns {Promise<boolean>} Retorna true se o link for OK, false se falhar (antes de redirecionar).
 */
export async function verificarLinkERedirecionar(urlParaTestar) {
    // A página de erro já é tratada internamente para manter o módulo encapsulado
    const paginaErro = TELA_DE_CONSTRUCAO; 
    
    // Ignorar links vazios, de âncora (#) ou JavaScript
    if (!urlParaTestar || urlParaTestar.startsWith('#') || urlParaTestar.toLowerCase().startsWith('javascript:')) {
        return true; 
    }
    
    // Não redireciona para a página de erro se já estiver a ir para lá
    if (urlParaTestar.endsWith(paginaErro)) {
        return true; 
    }

    try {
        const resposta = await fetch(urlParaTestar, { 
            method: 'HEAD',
            cache: 'no-cache' 
        });

        if (!resposta.ok) {
            console.error(`❌ Erro HTTP ${resposta.status} para o link ${urlParaTestar}. Redirecionando...`);
            window.location.href = paginaErro;
            return false;
        }

        return true; 

    } catch (erro) {
        console.error(`❌ Erro de rede/acesso para o link ${urlParaTestar}. Redirecionando...`, erro);
        window.location.href = paginaErro;
        return false;
    }
}


/**
 * Interceta todos os cliques em links na página e aplica o teste de verificação.
 */
export function interceptarCliques() {
    document.addEventListener('click', async (event) => {
        const linkElemento = event.target.closest('a');

        if (linkElemento) {
            const urlDoLink = linkElemento.getAttribute('href');
            
            // Ignorar links sem href, links para outras janelas, ou links que contêm ':' (protocolo)
            if (!urlDoLink || linkElemento.getAttribute('target') === '_blank' || urlDoLink.includes(':')) {
                return; 
            }

            // Previne a ação padrão (impede o navegador de navegar imediatamente)
            event.preventDefault();

            // Executa o teste de verificação
            const linkOK = await verificarLinkERedirecionar(urlDoLink);

            // Se o teste retornar TRUE (linkOK), redireciona manualmente
            if (linkOK) {
                console.log(`Link válido: a redirecionar para ${urlDoLink}`);
                window.location.href = urlDoLink;
            }
        }
    });
}