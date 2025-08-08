// public/assets/js/api/userApi.js
document.getElementById('listar-usuarios').addEventListener('click', function () {
    let button = this;
    let usersContainer = document.getElementById('users');
    let errorContainer = document.getElementById('error');
    
    errorContainer.textContent = '';
    
    button.disabled = true;
    button.textContent = 'Carregando...';
    
    fetch('/api/v1/usuarios')
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            
            if (data.success === true) {
                
                usersContainer.innerHTML = '';
                data.data.forEach(user => {
                    let li = document.createElement('li');
                    li.textContent = user.username;
                    usersContainer.appendChild(li);
                });
            } else {
                errorContainer.textContent = data.error || 'Erro desconhecido';
                errorContainer.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Erro ao listar usuários:', error);
            errorContainer.textContent = 'Erro de conexão. Tente novamente.';
            errorContainer.style.color = 'red';
        })
        .finally(() => {
            button.disabled = false;
            button.textContent = 'Clique aqui para listar os usuários';
        });
});