<div data-category-id="{{$category->id}}" class="category-instance border-b border-slate-700 flex flex-row hover:bg-gray-900">
    <div class="category-color w-20 py-3 border-r border-slate-600">
        <div class="w-full h-full flex items-center justify-center">
            <span class="inline-flex w-4 h-4 bg-red-600 rounded-full border border-solid border-slate-900" style="background-color: {{$category->color}}"></span>
        </div>
    </div>

    <div class="category-title py-3 flex-1 text-center text-base border-r border-slate-600">
        {{$category->title}}
    </div>

    @php
        use Illuminate\Support\Facades\DB;

        $categoryId = $category->id;

        $tasksCount = DB::table("tasks")->select()->where("category_id", "=", $categoryId)->get()->count();
    @endphp

    <div class="category-instances py-3 flex-1 text-center text-base border-r border-slate-600">
        {{$tasksCount}}
    </div>

    <div class="category-actions py-2 w-36 text-center font-bold text-lg flex justify-center items-center">
        <div class="w-full flex justify-evenly items-center">
            <!-- Modal Edit Toggle -->
            <a href="#" type="button" data-modal-target="editCategoryModal" data-modal-show="editCategoryModal" data-category-id="{{$category->id}}" onclick="getCategoryData(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <svg class="w-7 h-7 fill-slate-100 hover:fill-green-400 active:fill-green-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
            <a href="#" type="button" data-modal-target="deleteCategoryModal" data-modal-toggle="deleteCategoryModal" data-category-id="{{$category->id}}" onclick="setDeleteId(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <svg class="w-7 h-7 fill-slate-100 hover:fill-red-600 active:fill-red-800" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg>
            </a>
        </div>
    </div>
</div>