document.addEventListener('DOMContentLoaded', function () {
    let helpdesk = document.getElementById('helpdesk');
   
    fetch('/api/v1/helpdesk')
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Erro ao buscar chamados:', error);
        });
});