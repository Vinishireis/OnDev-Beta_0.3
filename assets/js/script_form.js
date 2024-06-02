$(document).ready(function(){
    // Máscara para o DDD
    $('#ddd').mask('00');

    // Máscara para o número de celular
    $('#telefone').mask('00000-0000');
});

$(document).ready(function() {
    // Função para formatar o CPF
    function formatCPF(cpf) {
        cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o traço
        return cpf;
    }

    // Quando o usuário digitar no campo de CPF
    $('input[name="cpf"]').on('input', function() {
        let cpfDigitado = $(this).val(); // Obtém o valor digitado
        let cpfFormatado = formatCPF(cpfDigitado); // Formata o CPF
        $(this).val(cpfFormatado); // Define o valor formatado de volta no campo
    });
});

const selectStates = document.querySelector('#states');
const selectCities = document.querySelector('#cities');

function populateStateSelect() {
    fetch('https://geoapibrasil.herokuapp.com/v1/states')
        .then(res => res.json())
        .then(states => {
            states.map(state => {
                const option = document.createElement('option');
                option.setAttribute('value', state.state);
                option.textContent = state.stateName;
                selectStates.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao obter estados:', error));
}

function populateCitySelect() {
    selectStates.addEventListener('change', () => {
        let state = selectStates.value;
        fetch(`https://geoapibrasil.herokuapp.com/v1/cities?state=${state}`)
            .then(res => res.json())
            .then(cities => {
                selectCities.innerHTML = '<option value="" disabled selected>Selecione uma cidade</option>';
                cities.map(city => {
                    const option = document.createElement('option');
                    option.textContent = city.name;
                    selectCities.appendChild(option);
                });
                selectCities.removeAttribute('disabled');
            })
            .catch(error => console.error('Erro ao obter cidades:', error));
    });
}

populateStateSelect();
populateCitySelect();

function formatCEP(cep) {
    const cleanedCEP = cep.replace(/\D/g, '');
    if (cleanedCEP.length === 8) {
        return cleanedCEP.replace(/(\d{5})(\d{3})/, '$1-$2');
    } else {
        return cleanedCEP;
    }
}

const handleZipCode = (event) => {
    let input = event.target
    input.value = zipCodeMask(input.value)
  }
  
  const zipCodeMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{5})(\d)/,'$1-$2')
    return value
  }

   // Seleciona o formulário e o elemento de alerta
   const form = document.getElementById('form');
   const alertElement = document.querySelector('.alert');

   // Adiciona um evento de escuta para o evento "submit" do formulário
   form.addEventListener('submit', function(event) {
       // Impede o comportamento padrão de enviar o formulário
       event.preventDefault();

       // Adiciona a classe "show" ao elemento de alerta para exibi-lo
       alertElement.classList.add('show');
   });

   // Adiciona um evento de escuta para o botão de fechar o alerta
   alertElement.querySelector('.alert--close').addEventListener('click', function() {
       // Remove a classe "show" para esconder o alerta
       alertElement.classList.remove('show');
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
// Verificar se a URL possui o parâmetro de sucesso (por exemplo, ?success=true)
const urlParams = new URLSearchParams(window.location.search);
const successParam = urlParams.get('success');

// Verificar se o parâmetro de sucesso é verdadeiro e mostrar o alerta
if (successParam === 'true') {
    document.getElementById('alerta_conta_criada').style.display = 'block';
}