function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            $("#img").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


$(".delete").on('click', function (e) {
    e.preventDefault();
    var url = $(this).data('remote');
    var id = $(this).data("id");
    Swal.fire({
        icon: "question",
        title: "Você tem certeza?",
        text: `Que deseja excluir esse registro?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: `Não`,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                data: {
                    "id": id
                },
                type: 'DELETE',
                success: function (response) {
                    Swal.fire(
                        "Sucesso!",
                        'O registro foi excluído com sucesso!',
                        'success'
                    )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function (err) {
                    console.log(err)
                    Swal.fire(
                        "Oops!",
                        'Ocorreu um erro!' + err,
                        'error'
                    )
                }
            });
        }
    })
});

$(".remove-item").on('click', function (e) {
    e.preventDefault();
    var url = $(this).data('remote');
    var id = $(this).data("id");
    Swal.fire({
        icon: "question",
        title: "Você tem certeza?",
        text: `Que deseja remover o item ?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: `Não`,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                data: {
                    "id": id
                },
                type: 'DELETE',
                success: function (response) {
                    Swal.fire(
                        "Sucesso!",
                        'O registro foi excluído com sucesso!',
                        'success'
                    )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function (err) {
                    console.log(err)
                    Swal.fire(
                        "Oops!",
                        'Ocorreu um erro!' + err,
                        'error'
                    )
                }
            });
        }
    })
});

$(".cancel-comanda").on('click', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var id = $(this).data("id");
    Swal.fire({
        icon: "question",
        title: "Você tem certeza?",
        text: `Que deseja cancelar a comanda ?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: `Não`,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                data: {
                    "id": id
                },
                type: 'POST',
                success: function (response) {
                    Swal.fire(
                        "Sucesso!",
                        'Comanda cancelada com sucesso!',
                        'success'
                    )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function (err) {
                    console.log(err)
                    Swal.fire(
                        "Oops!",
                        'Ocorreu um erro!' + err,
                        'error'
                    )
                }
            });
        }
    })
});

$(".disable").on('click', function (e) {
    e.preventDefault();
    var url = $(this).data('remote');
    var id = $(this).data("id");
    Swal.fire({
        icon: "question",
        title: "Você tem certeza?",
        text: `Que deseja desativar esse registro?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: `Não`,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                data: {
                    "id": id
                },
                type: 'PUT',
                success: function (response) {
                    Swal.fire(
                        "Sucesso!",
                        'O registro foi desativado com sucesso!',
                        'success'
                    )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function (err) {
                    console.log(err)
                    Swal.fire(
                        "Oops!",
                        'Ocorreu um erro!' + err,
                        'error'
                    )
                }
            });
        }
    })
});

$(".ativar").on('click', function (e) {
    e.preventDefault();
    var url = $(this).data('remote');
    var id = $(this).data("id");
    Swal.fire({
        icon: "question",
        title: "Você tem certeza?",
        text: `Que deseja ativar esse registro?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: `Não`,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                data: {
                    "id": id
                },
                type: 'PUT',
                success: function (response) {
                    Swal.fire(
                        "Sucesso!",
                        'O registro foi ativado com sucesso!',
                        'success'
                    )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function (err) {
                    console.log(err)
                    Swal.fire(
                        "Oops!",
                        'Ocorreu um erro!',
                        'error'
                    )
                }
            });
        }
    })
});

$(".dt").dataTable({
    responsive: true,
    "language": {
        "sProcessing": "Processando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "Nenhum dado encontrado, tente novamente...",
        "sEmptyTable": "Nenhum dado encontrado",
        "sInfo": "Mostrando _START_ &agrave; _END_ de _TOTAL_ resultados",
        "sInfoEmpty": "Sem resultados para exibir",
        "sInfoFiltered": "(filtrado um total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sInfoThousands": ",",
        "sLoadingRecords": "Carregando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Próximo",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
    // language: {
    //     processing: "Processando os dados...",
    //     search: "Busque um dado: ",
    //     lengthMenu: "Mostrando _MENU_ elementos",
    //     info: "Mostrando _START_ &agrave; _END_ de _TOTAL_ resultados",
    //     sInfoEmpty: "Sem resultados para exibir",
    //     zeroRecords: "Nenhum dado encontrado, tente novamente...",
    //     paginate: {
    //         first: "Primeira",
    //         previous: "Anterior",
    //         next: "Proxíma",
    //         last: "Última"
    //     }
    // },
    "order": [
        [1, 'asc']
    ],
});

$(".dt-desc").dataTable({
    responsive: true,
    "language": {
        "sProcessing": "Processando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "Nenhum dado encontrado, tente novamente...",
        "sEmptyTable": "Nenhum dado encontrado",
        "sInfo": "Mostrando _START_ &agrave; _END_ de _TOTAL_ resultados",
        "sInfoEmpty": "Sem resultados para exibir",
        "sInfoFiltered": "(filtrado um total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sInfoThousands": ",",
        "sLoadingRecords": "Carregando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Próximo",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
    // language: {
    //     processing: "Processando os dados...",
    //     search: "Busque um dado: ",
    //     lengthMenu: "Mostrando _MENU_ elementos",
    //     info: "Mostrando _START_ &agrave; _END_ de _TOTAL_ resultados",
    //     sInfoEmpty: "Sem resultados para exibir",
    //     zeroRecords: "Nenhum dado encontrado, tente novamente...",
    //     paginate: {
    //         first: "Primeira",
    //         previous: "Anterior",
    //         next: "Proxíma",
    //         last: "Última"
    //     }
    // },
    "order": [
        [0, 'desc']
    ],
});



$("#cep").blur(function () {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#endereco").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#estado").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#endereco").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#estado").val(dados.uf);
                } //end if.
                else {
                    $("#endereco").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#estado").val("");

                }
            });
        } //end if.

    } //end if.
});
