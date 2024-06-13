  //Função de Preço
  function formatarPreco(input) {
    // Remove tudo que não for número
    let valor = input.value.replace(/\D/g, '');

    // Formata o valor em reais
    valor = (valor / 100).toFixed(2) + '';
    valor = valor.replace('.', ',');
    valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');

    // Adiciona o símbolo de reais
    input.value = 'R$ ' + valor;
}