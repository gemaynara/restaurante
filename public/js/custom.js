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

$(".active").on('click', function (e) {
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
        [0, 'asc']
    ],
});