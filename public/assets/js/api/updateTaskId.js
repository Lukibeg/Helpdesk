document.addEventListener('DOMContentLoaded', function () {
    const updateTaskButton = document.querySelectorAll('.update-task-button');
    updateTaskButton.forEach(button => {
        button.addEventListener('click', function () {
            const title = document.getElementById('title').value;
            const description = document.getElementById('description').value;
            const status = document.getElementById('status').value;
            const user_name = document.getElementById('user_name').value;
            const id = this.getAttribute('data-id');
            fetch(`/admin/tickets/${id}`, {
                method: 'PUT',
                body: JSON.stringify({
                    id,
                    title,
                    description,
                    status,
                    user_name,
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status === 'success') {
                        window.location.href = '/admin/tickets';
                    }
                }).catch(error => {
                    console.log(error);
                })
        })
    })
})