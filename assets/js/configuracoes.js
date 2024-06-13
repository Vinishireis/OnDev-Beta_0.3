// Script para abrir e fechar os modais
document.getElementById('btnChangePassword').onclick = function() {
    document.getElementById('passwordModal').style.display = 'block';
}
document.getElementById('btnChangeEmail').onclick = function() {
    document.getElementById('emailModal').style.display = 'block';
}
document.getElementById('closePasswordModal').onclick = function() {
    document.getElementById('passwordModal').style.display = 'none';
}
document.getElementById('closeEmailModal').onclick = function() {
    document.getElementById('emailModal').style.display = 'none';
}
window.onclick = function(event) {
    if (event.target == document.getElementById('passwordModal')) {
        document.getElementById('passwordModal').style.display = 'none';
    }
    if (event.target == document.getElementById('emailModal')) {
        document.getElementById('emailModal').style.display = 'none';
    }
}

// ALTERAR SENHA
document.getElementById('updatePasswordForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Previne o envio padrão do formulário

    let form = event.target;
    let formData = new FormData(form);

    fetch('assets/php/process_password_change.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('passwordMessage').innerText = data.message;
            document.getElementById('passwordMessage').style.color = (data.status === 'success') ? 'green' : 'red';
            document.getElementById('passwordMessage').style.display = 'block';

            if (data.status === 'success') {
                // Limpa os campos de senha
                form.reset();
                // Opcional: Oculta o formulário e exibe apenas a mensagem
                form.style.display = 'none';
            }
        })
        .catch(error => {
            document.getElementById('passwordMessage').innerText = 'Erro na requisição.';
            document.getElementById('passwordMessage').style.color = 'red';
            document.getElementById('passwordMessage').style.display = 'block';
            console.error('Error:', error);
        });
});

// ALTERAR E-MAIL
document.getElementById('updateEmailForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Previne o envio padrão do formulário

    let form = event.target;
    let formData = new FormData(form);

    fetch('assets/php/process_email_change.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('emailMessage').innerText = data.message;
            document.getElementById('emailMessage').style.color = (data.status === 'success') ? 'green' : 'red';
            document.getElementById('emailMessage').style.display = 'block';

            if (data.status === 'success') {
                // Limpa os campos do formulário
                form.reset();
                // Oculta o formulário e exibe apenas a mensagem
                form.style.display = 'none';
            }
        })
        .catch(error => {
            document.getElementById('emailMessage').innerText = 'Erro na requisição.';
            document.getElementById('emailMessage').style.color = 'red';
            document.getElementById('emailMessage').style.display = 'block';
            console.error('Error:', error);
        });
});