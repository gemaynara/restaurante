$(".telefone").mask("(99) 99999-9999")
$(".num_porcao").mask("999")
$(".valor").mask("#####.##", {reverse: true})
$(".estoque").mask("####", {reverse: false})
$(".cep").mask("#####-###", {reverse: false})
$(".cnpj").mask('00.000.000/0000-00')
$(".cpf").mask('000.000.000-00')
$(".taxa").mask("###.00", {reverse: true})
$(".qnt").mask("999999")
$(".dec_estoque").mask("9999.999")

$(".time").mask("HH:Mm:Ss", {
    translation: {
        'H': {
            pattern: /([0-1][0-9]{1}|2[0-3])/,
            optional: false
        },
        'M': {
            pattern: /[0-5]/,
            optional: false
        },
        'm': {
            pattern: /[0-9]/,
            optional: false
        },
        'S': {
            pattern: /[0-5]/,
            optional: false
        },
        's': {
            pattern: /[0-9]/,
            optional: false
        }
    }
});
