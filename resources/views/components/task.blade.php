<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-opacity-95">
    <td class="w-4 p-3">
        <div class="flex items-center justify-center">
            <input id="checkbox-table-search-1" data-task-id="{{$task["id"]}}" type="checkbox" onclick="updateStatus(this)" {{$task["is_done"] == 1 ? "checked" : ""}} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        </div>
    </td>
    <td class="px-5 py-3 text-base">
        @php
            use App\Models\Category;

            $category = Category::find($task["category_id"]);
        @endphp
        <div class="flex justify-center items-center">
            <span class="inline-flex w-3 h-3 bg-red-600 rounded-full" style="background-color: {{$category->color}}"></span>
            <div class="inline-flex mx-auto">{{$category->title}}</div>
        </div>
    </td>
    <th scope="row" class="flex items-center justify-center text-base px-5 py-3 text-gray-900 whitespace-nowrap dark:text-white">
        {{$task["title"]}}
    </th>
    <!--<td class="px-6 py-4 text-center break-normal text-base">
        {`{$task["description"]}}
    </td>-->
    <td class="px-5 py-3 max-w-max text-center text-base">
        {{$task["created_at"]}}
    </td>
    <td class="px-5 py-3 text-center text-base">
        {{$task["due_date"]}}
    </td>
    <td class="px-5 py-3">
        <div class="flex justify-around items-center">
            <!-- Modal Edit Toggle -->
            <a href="#" type="button" data-modal-target="editTaskModal" data-modal-show="editTaskModal" data-task-id="{{$task["id"]}}" onclick="getTaskData(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <svg class=" w-6 h-6 fill-slate-100 hover:fill-green-400 active:fill-green-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
            <a href="#" type="button" data-task-id="{{$task["id"]}}" onclick="deleteTask(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <svg class=" w-6 h-6 fill-slate-100 hover:fill-red-600 active:fill-red-800" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg>
            </a>
        </div>
    </td>
</tr>