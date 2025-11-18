document.addEventListener('DOMContentLoaded', function() {
    // 1. Alterado o seletor para buscar a classe 'ver-todos-btn'
    const botoesVerTodos = document.querySelectorAll('.ver-todos-btn');

    botoesVerTodos.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // <-- Adicionado: Evita que o link # suba a página
            
            // O tipo é o atributo data-tipo que definimos no HTML
            const tipo = this.getAttribute('data-tipo');
            const containerId = `conteudo_${tipo.toLowerCase()}`;
            const container = document.getElementById(containerId);

            // 2. Corrigido o parâmetro 'limit' para '0', que o PHP usa para "sem limite"
            const url = `get_instituicoes_ajax.php?tipo=${tipo}&limit=0`; 
            
            // Opcional: Adicionar feedback visual de carregamento
            container.innerHTML = '<p class="text-center">Carregando todos os dados...</p>';


            // Faz a requisição AJAX para o novo endpoint
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    // Substitui o conteúdo do container
                    container.innerHTML = html;

                    // Oculta o botão 'Ver Todos'
                    // Como o botão está dentro de uma div com id="ver-todos-btn-u",
                    // vamos ocultar a div pai do botão.
                    const buttonContainer = this.parentNode; 
                    if (buttonContainer) {
                        buttonContainer.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar todos os dados:', error);
                    container.innerHTML = '<p class="text-center text-danger">Não foi possível carregar todos os dados.</p>';
                });
        });
    });
});