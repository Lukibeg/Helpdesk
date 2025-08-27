document.addEventListener('DOMContentLoaded', function () {
    const deleteTaskButton = document.querySelectorAll('.delete-task-button');
    deleteTaskButton.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            if (confirm('Tem certeza que deseja deletar este chamado?')) {
                fetch(`/admin/tickets/${id}`, {
                    method: 'DELETE',
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            window.location.href = '/admin/tickets';
                        }
                    }).catch(error => {
                        console.error('Erro ao deletar chamado:', error);
                        console.log(error);
                    });
            }
        })
    })
})