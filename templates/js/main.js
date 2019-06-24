var alreadyReady = false;
jQuery(document).ready(function () {
    var table = jQuery("#tableTaskList").DataTable({
        "dom": '<"listtable"fit>pl',
        "responsive": true,
        "oLanguage": {
            "sEmptyTable": "Записей не найдено",
            "sInfo": "Показано с _START_ по _END_ из _TOTAL_",
            "sInfoEmpty": "Показано с 0 по 0 из 0",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Показать _MENU_ записей",
            "sLoadingRecords": "Загрузка...",
            "sProcessing": "Обработка...",
            "sSearch": "",
            "sZeroRecords": "Записей не найдено",
            "oPaginate": {
                "sFirst": "Первая",
                "sLast": "Последняя",
                "sNext": "Вперед",
                "sPrevious": "Назад"
            }
        },
        "order": [
            [
                4, "asc"
            ]
        ],
        "pageLength": 100,
        "lengthMenu": [
            [
                50,
                100,
                500,
                -1
            ],
            [
                50,
                100,
                500,
                "Все"
            ]
        ], "stateSave": true
    });
    jQuery(".dataTables_filter input").attr("placeholder", "Условие для поиска...");

    // highlight remembered filter on page re-load
    var rememberedFilterTerm = table.state().columns[4].search.search;
    if (rememberedFilterTerm && !alreadyReady) {
        // This should only run on the first "ready" event.
        jQuery(".view-filter-btns a span").each(function (index) {
            if (jQuery(this).text().trim() == rememberedFilterTerm.replace(/\\|s\*/g, '')) {
                jQuery(this).parent('a').addClass('active');
                jQuery(this).parent('a').find('i').switchClass('fa-circle-o', 'fa-dot-circle-o', 0);
            }
        });
    }
    alreadyReady = true;
});

$(function () {
    $('#EditModal').on('shown.bs.modal', function (e) {
        var task_id = $(e.relatedTarget).data('task_id');

        $("#task_id").val(task_id);
        $('#EditModalTask').text("Редактирование задания \"" + $.trim($('#task_name_' + task_id).text()) + "\"");
        $('#name').val($.trim($('#task_name_' + task_id).text()));
        $('#class_name').val($.trim($('#task-class-' + task_id).val()));
        $('#priority').val($.trim($('#task_priority_' + task_id).text()));
        $('#frequency').val($.trim($('#task_frequency_' + task_id).text()));
        $('#description').val($.trim($('#task_description_' + task_id).text()));
    });

    $("#saveTask").click(function () {
        let task_id = $("#task_id").val();
        let task_name = $('#name').val();
        let class_name = $('#class_name').val();
        let priority = $('#priority').val();
        let frequency = $('#frequency').val();
        let description = $('#description').val();

        saveTask({
            task_id: task_id,
            name: task_name,
            class_name: class_name,
            priority: priority,
            frequency: frequency,
            description: description
        });

        $('#task_name_' + task_id).text(task_name);
        $('#task-class-' + task_id).val(class_name);
        $('#task_priority_' + task_id).text(priority);
        $('#task_frequency_' + task_id).text(frequency);
        $('#task_description_' + task_id).text(description);
    });

    $("input[name^=task-enable]").change(function () {
        saveTask({
            task_id: $(this).data('task_id'),
            enable: Number($(this).is(':checked'))
        })
    });

    $("input[name^=task-periodic]").change(function () {
        saveTask({
            task_id: $(this).data('task_id'),
            periodic: Number($(this).is(':checked'))
        })
    });


});

function deleteTask(element) {
    var task_id = $(element).data('task_id');
    var answer = confirm("Удалить задание \""+$.trim($('#task_name_' + task_id).text())+"\" ?");

    if (answer) {
        saveTask({
            task_id: $(element).data('task_id'),
            delete: null
        });
        $(element).closest('tr').remove();
    } else {
        alert("Действие отменено");
    }
}

function saveTask(data) {
    $.ajax({
        type: "POST",
        url: window.location.href,
        data: data,
        dataType: 'json',
        success: function (data) {
            if (data.status === 'error') {
                this.fail(data);
                return;
            }

            $.easyAlert({
                message: data.message,  //default message to be displayed
                alertType: 'success', //alert type (warning,info,danger,success)
                time: 3000, //the time to hide the alert if previous boolean is set to true in ms
                position: "t r", //preferred position
                showAnimation: 'slide', //preferred show animation if jQuery ui is included
                autoHide: true //set whether to automatically hide the alert after a period of time
            });
        },
        fail: function (data) {
            $.easyAlert({
                message: data.message,  //default message to be displayed
                alertType: 'danger', //alert type (warning,info,danger,success)
                time: 3000, //the time to hide the alert if previous boolean is set to true in ms
                position: "t r", //preferred position
                showAnimation: 'slide', //preferred show animation if jQuery ui is included
                autoHide: true //set whether to automatically hide the alert after a period of time
            });
        }
    });
}
