const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

    // js code to appear signup and login form
    signUp.addEventListener("click", ( )=>{
        container.classList.add("active");
    });
    login.addEventListener("click", ( )=>{
        container.classList.remove("active");
    });

    // Função para verificar se o e-mail tem um domínio válido
    function validateEmailDomain(email) {
        var validDomains = ["gmail.com", "yahoo.com", "hotmail.com"]; // Domínios válidos
        var domain = email.split('@')[1];
        return validDomains.includes(domain);
    }

    // Função para validar a senha
    function validatePassword(password) {
        var regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#])[A-Za-z\d!@#]{8,}$/; // Pelo menos 8 caracteres, uma letra maiúscula, um número e um caractere especial
        return regex.test(password);
    }

    // Máscaras de entrada para DDD e telefone
    $(document).ready(function() {
        $('#ddd').mask('00');
        $('#telefone').mask('00000-0000');
    });

    // Limitar tamanho de arquivo e formatos aceitos para a foto de perfil
    $(document).ready(function() {
        $('input[name="foto_perfil"]').change(function() {
            var file = this.files[0];
            var maxSize = 2 * 1024 * 1024; // 2 MB
            var validFormats = ['image/jpeg', 'image/png']; // Formatos válidos

            if (file.size > maxSize) {
                alert('O tamanho do arquivo excede o limite de 2MB.');
                this.value = null; // Limpa o campo de upload
            } else if (!validFormats.includes(file.type)) {
                alert('Formato de arquivo inválido. Apenas JPEG e PNG são permitidos.');
                this.value = null; // Limpa o campo de upload
            }
        });
    });

    // Função para validar o formulário antes do envio
    function validateForm() {
        var email = $('input[name="email"]').val();
        var password = $('input[name="password"]').val();

        if (!validateEmailDomain(email)) {
            alert('Por favor, insira um e-mail com domínio válido (gmail.com, yahoo.com, hotmail.com).');
            return false; // Impede o envio do formulário
        }

        if (!validatePassword(password)) {
            alert('A senha deve conter pelo menos 8 caracteres, uma letra maiúscula, um número e um caractere especial.');
            return false; // Impede o envio do formulário
        }

        return true; // Envio do formulário se todas as validações passarem
    }