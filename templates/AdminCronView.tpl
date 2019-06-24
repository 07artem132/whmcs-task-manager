<link rel="stylesheet" type="text/css" href="/modules/addons/TaskManager/templates/css/task_manager.css?{$smarty.now}">
<link rel="stylesheet" type="text/css" href="/modules/addons/TaskManager/templates/css/easy-alert.css">
<script type="text/javascript" src="/modules/addons/TaskManager/templates/js/jQuery.succinct.js"></script>
<script type="text/javascript" src="/modules/addons/TaskManager/templates/js/easy-alert.js"></script>
<script type="text/javascript" src="/modules/addons/TaskManager/templates/js/main.js?{$smarty.now}"></script>

{include file="AdminEditModal.tpl"}

<div class="col-sm-12">
    <div class="tab-content">
        <div id="tableBackground" class="tablebg">
            <table id="tableTaskList" width="100%" class="datatable no-margin">
                <thead>
                <tr>
                    <th style="width: 6%;">
                        Включено
                    </th>
                    <th style="width: 23%;">
                        Названия
                    </th>
                    <th style="width: 23%;">
                        Описание
                    </th>
                    <th style="width: 6%;">
                        Приоритет
                    </th>
                    <th style="width: 6%;">
                        Повторять
                    </th>
                    <th style="width: 6%;">
                        Частота повторения (Минуты)
                    </th>
                    <th style="width: 6%;">
                        Последний запускы
                    </th>
                    <th style="width: 2%;"></th>
                    <th style="width: 2%;"></th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$tasks item=task}
                    <tr class="product text-center">
                        <input type="hidden" name="task-class-{{$task->id}}" id="task-class-{{$task->id}}" value="{{$task->class_name}}" >
                        <td class="text-center">
                            <input type="checkbox" name="task-enable-{{$task->id}}"
                                   data-task_id="{{$task->id}}"
                                   title="Нажмите здесь включения/отключения задачи"
                                    {if $task->is_enabled}
                                        checked
                                    {/if}
                            >
                        </td>
                        <td class="text-left">
                            <a href="#" data-toggle="modal" data-target="#EditModal"
                               data-task_id="{{$task->id}}"
                               id="task_name_{{$task->id}}"
                               title="Нажмите для редактирования"
                            >
                                {{$task->name}}
                            </a>
                        </td>
                        <td class="text-left">
                            <a href="#" data-toggle="modal" data-target="#EditModal"
                               data-task_id="{{$task->id}}"
                               id="task_description_{{$task->id}}"
                               title="Нажмите для редактирования"
                            >
                                {{$task->description}}
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="#" data-toggle="modal" data-target="#EditModal"
                               data-task_id="{{$task->id}}"
                               id="task_priority_{{$task->id}}"
                               title="Нажмите для редактирования"
                            >
                                {{$task->priority}}
                            </a>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="task-periodic-{{$task->id}}"
                                   data-task_id="{{$task->id}}"
                                   title="Нажмите здесь включения/отключения повторения задачи"
                                    {if $task->is_periodic}
                                        checked
                                    {/if}
                            >
                        </td>
                        <td class="text-center">
                            <a href="#" data-toggle="modal" data-target="#EditModal"
                               data-task_id="{{$task->id}}"
                               id="task_frequency_{{$task->id}}"
                               title="Нажмите для редактирования"
                            >
                                {{$task->frequency}}
                            </a>
                        </td> <td class="text-center">

                                {{$task->status()->first()->last_run}}

                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#EditModal"
                               data-task_id="{{$task->id}}"
                               title="Нажмите для редактирования"
                            >
                                <img src="/{{$adminPath}}/images/edit.gif" border="0" alt="Нажмите для редактирования">
                            </a>
                        </td>
                        <td>
                            <a href="#"
                               onclick="deleteTask(this);return false"
                               data-task_id="{{$task->id}}"
                            >
                                <img src="/{{$adminPath}}/images/delete.gif" width="16" height="16" border="0"
                                     alt="Нажмите для удаления">
                            </a>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>
