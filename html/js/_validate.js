//1507
$(document).ready(function(){

    $('form').submit(function(event){

        let dadosFormulario = {

            '_nomeForm' : $('input[name=nome]'),
            '_telefoneForm' : $('input[name=telefone]'),
            '_contatoForm' : $('input[name=contato]')

        };
        event.preventDefault();
        console.log(dadosFormulario);
    });

});