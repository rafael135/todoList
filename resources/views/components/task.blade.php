<div data-task-id="{{$task->id}}" class="task-instance border-b border-slate-700 flex flex-row hover:bg-gray-900">
    <div class="task-status w-20 border-r border-slate-600">
        <div class="h-full flex items-center justify-center">
            <input id="checkbox-table-search-1" data-task-id="{{$task->id}}" type="checkbox" onclick="updateStatus(this)" {{$task->is_done == 1 ? "checked" : ""}} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
        </div>
    </div>

    <div class="task-title py-3 flex-1 text-center text-base border-r border-slate-600">
        @php
            use App\Models\Category;

            $category = Category::find($task->category_id);
        @endphp
        <div class="relative h-full flex justify-start items-center" data-tooltip-target="category{{$category->id}}-tooltip" data-tooltip-placement="bottom" data-tooltip-trigger="hover">
            <div class=" w-1/6 flex justify-center items-center">
                <span class="inline-flex z-20 w-3.5 h-3.5 bg-red-600 rounded-full border border-solid border-slate-900" style="background-color: {{$category->color}}"></span>
            </div>
            
            <div class="absolute w-full h-full my-auto flex text-center justify-center items-center truncate hover:text-clip hover:cursor-default">{{$task->title}}</div>
        </div>
    </div>
    <div id="category{{$category->id}}-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{$category->title}}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>



    <div class="task-created_at py-3 flex-1 text-center text-base border-r border-slate-600 hover:cursor-default hidden md:block">
        {{$task->created_at}}
    </div>

    <div class="task-due_date py-3 flex-1 text-center text-base border-r border-slate-600 hover:cursor-default hidden md:block">
        {{$task->due_date}}
    </div>

    <div class="task-actions py-2 w-40 text-center font-bold text-lg flex justify-center items-center">
        <div class="w-full flex justify-evenly items-center">
            <!-- Modal Edit Toggle -->
            <a href="#" type="button" data-modal-target="editTaskModal" data-modal-show="editTaskModal" data-task-id="{{$task->id}}" onclick="showTaskEditData(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <svg class="w-7 h-7 fill-slate-100 hover:fill-green-400 active:fill-green-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
            <a href="#" type="button" data-task-id="{{$task->id}}" data-modal-target="deleteTaskModal" data-modal-toggle="deleteTaskModal" onclick="setDeleteId(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <svg class="w-7 h-7 fill-slate-100 hover:fill-red-600 active:fill-red-800" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg>
            </a>
            <a href="#" type="button" data-task-id="{{$task->id}}" data-modal-target="showTask-modal" data-modal-show="showTask-modal" onclick="getTaskView(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" data-tooltip-target="showTask-tooltip" data-tooltip-placement="bottom" data-tooltip-trigger="hover">
                <svg class="w-7 h-7 fill-slate-100 hover:fill-teal-500 active:fill-teal-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                  </svg>
            </a>
        </div>
    </div>
</div>