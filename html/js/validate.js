//2125
$(document).ready(function(){

    $('form').submit(function(event){
        
        let dadosFormulario = {

            '_nomeForm'     : $('input[name=nome]').val(),
            '_telefoneForm' : $('input[name=telefone]').val(),
            '_contatoForm'  : $('input[name=contato]').val(),
            '_anexoform'    : $('input[name=anexo').get().files

        };
        
        console.log(dadosFormulario);

        $.ajax({
            type    : 'POST',
            url     : 'anexa.php',
            data    : dadosFormulario,
            dataType: 'json',
            encode  : true
        })
        .done(function(data){
            console.log(data);
        });

        event.preventDefault();
    });

});