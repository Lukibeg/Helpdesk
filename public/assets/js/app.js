//app.js

document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('title');
    const descriptionTextarea = document.getElementById('description');

    if (titleInput) {
        titleInput.addEventListener('input', function () {
            const maxLength = 100;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;

            // Atualizar hint
            const hint = this.parentNode.querySelector('.form-hint');
            if (hint) {
                hint.textContent = `${remaining} caracteres restantes`;
                hint.style.color = remaining < 10 ? '#dc3545' : '#6c757d';
            }

            if (remaining < 10) {
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#e9ecef';
            }
        });
    }

    if (descriptionTextarea) {
        descriptionTextarea.addEventListener('input', function () {
            const maxLength = 1000;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;

            const hint = this.parentNode.querySelector('.form-hint');
            if (hint) {
                hint.textContent = `${remaining} caracteres restantes`;
                hint.style.color = remaining < 50 ? '#dc3545' : '#6c757d';
            }

            if (remaining < 50) {
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#e9ecef';
            }
        });
    }

    const form = document.querySelector('.helpdesk-form');
    if (form) {
        form.addEventListener('submit', function (e) {
            const title = titleInput?.value.trim();
            const description = descriptionTextarea?.value.trim();

            if (!title || title.length < 5) {
                e.preventDefault();
                alert('O título deve ter pelo menos 5 caracteres.');
                titleInput?.focus();
                return;
            }

            if (!description || description.length < 10) {
                e.preventDefault();
                alert('A descrição deve ter pelo menos 10 caracteres.');
                descriptionTextarea?.focus();
                return;
            }
        });
    }
});

/* Função para esconder mensagem de sucesso após 3 segundos */

document.addEventListener('DOMContentLoaded', function () {
    const successMessage = document.querySelector('.success-message');
    if (successMessage) {
        setTimeout(function () {
            successMessage.style.display = 'none';
        }, 3000);
    }
});

/* Função para validar a senha do login */
if (document.getElementById('password')) {
    document.getElementById('password').addEventListener('input', function () {
        const password = this.value;
        if (password.length < 8) {
            const error = document.createElement('div');
            if (!document.getElementById('error')) {
                error.id = 'error';
                error.textContent = 'A senha deve ter pelo menos 8 caracteres';
                error.style.marginTop = '1rem';
                this.parentNode.appendChild(error, this);
            }
            this.style.outline = 'none';
            this.style.border = '1px solid #dc3545';
        } else {
            this.style.borderColor = '#e9ecef';
            if (document.getElementById('error')) {
                document.getElementById('error').remove();
            }
        }

        if (this.value.length === 0) {
            if (document.getElementById('error')) {
                document.getElementById('error').remove();
                this.style.outline = 'none';
                this.style.border = '1px solid #e9ecef';
            }
        }
    });
}


function tooltip(position, btnClass, text) {
    const btn = document.getElementsByClassName(btnClass);

    if (window.location.pathname === '/admin/tickets') {
        console.log(text);
        if (btn.length > 0) {

            Array.from(btn).forEach(btn => {
                btn.addEventListener('mouseover', function () {
                    let existing = this.parentNode.querySelector('.tooltip');
                    if (existing) return;
                    let div = document.createElement('div');
                    div.className = 'tooltip';
                    div.style.opacity = '0';
                    div.style.transition = 'opacity 0.5s ease-in-out';
                    div.style.position = 'absolute';
                    div.style.zIndex = 1;
                    div.style.backgroundColor = 'black';
                    div.style.color = 'white';
                    div.style.border = '1px solid white';
                    div.style.padding = '5px';
                    div.style.borderRadius = '5px';
                    div.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
                    div.style.bottom = '0px';
                    div.style.left = `${position}px`;
                    div.textContent = `${text}`;

                    this.parentNode.appendChild(div);

                    // animação de fade-in
                    requestAnimationFrame(() => {
                        div.style.opacity = '1';
                    });
                });
            });
            tooltipOut(btnClass);
        }
    }
}

function tooltipOut(btnClass) {
    const btn = document.getElementsByClassName(btnClass);

    Array.from(btn).forEach(btn => {
        btn.addEventListener('mouseout', function () {
            const div = this.parentNode.querySelector('.tooltip');
            if (div) {
                div.style.opacity = '0';
                console.log('entrou no mouseout');
                // espera a animação terminar antes de remover
                div.addEventListener('transitionend', () => {
                    console.log('entrou no transitionend');
                    div.remove();
                }, { once: true });
            }
        });
    });
}



// if (document.getElementsByClassName('update-task')) {
//     const btn = document.getElementsByClassName('update-task');

//     Array.from(btn).forEach(btn => {
//         console.log('botão atual: ', btn);
//         btn.addEventListener('mouseover', function () {
//             let div = document.createElement('div');
//             div.className = 'tooltip';
//             div.style.opacity = '0';
//             div.style.transition = 'opacity 0.5s ease-in-out';
//             div.style.position = 'absolute';
//             div.style.zIndex = 1;
//             div.style.backgroundColor = 'black';
//             div.style.color = 'white';
//             div.style.border = '1px solid white';
//             div.style.padding = '5px';
//             div.style.borderRadius = '5px';
//             div.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
//             div.style.bottom = '0px';
//             div.style.left = '45px';
//             div.textContent = 'Editar chamado';

//             this.parentNode.appendChild(div);

//             requestAnimationFrame(() => {
//                 div.style.opacity = '1';
//             });
//         });

//         btn.addEventListener('mouseout', function () {
//             const div = this.parentNode.querySelector('.tooltip');
//             if (div) {
//                 div.style.opacity = '0';

//                 div.addEventListener('transitionend', () => {
//                     div.remove();
//                 }, { once: true });
//             }
//         });
//     });
// }

// if (document.getElementsByClassName('delete-task')) {
//     const btn = document.getElementsByClassName('delete-task');

//     Array.from(btn).forEach(btn => {
//         btn.addEventListener('mouseover', function () {
//             let div = document.createElement('div');
//             div.className = 'tooltip';
//             div.style.opacity = '0';
//             div.style.transition = 'opacity 0.5s ease-in-out';
//             div.style.position = 'absolute';
//             div.style.zIndex = 1;
//             div.style.backgroundColor = 'black';
//             div.style.color = 'white';
//             div.style.border = '1px solid white';
//             div.style.padding = '5px';
//             div.style.borderRadius = '5px';
//             div.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
//             div.style.bottom = '0px';
//             div.style.left = '75px';
//             div.textContent = 'Deletar chamado';

//             this.parentNode.appendChild(div);

//             requestAnimationFrame(() => {
//                 div.style.opacity = '1';
//             });
//         });

//         btn.addEventListener('mouseout', function () {
//             const div = this.parentNode.querySelector('.tooltip');
//             if (div) {
//                 div.style.opacity = '0';

//                 div.addEventListener('transitionend', () => {
//                     div.remove();
//                 }, { once: true });
//             }
//         });
//     });
// } else {
//     console.log('Erro na linha 229 de app.js');
// }


// document.getElementById('edit-task').addEventListener('mouseover', function () {
//     const div = document.createElement('div');
//     div.className = 'tooltip';
//     div.textContent = 'Editar chamado';
//     this.parentNode.appendChild(div);
// });