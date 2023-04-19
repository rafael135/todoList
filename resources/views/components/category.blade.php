<div class="category-instance border-b border-slate-700 flex flex-row hover:bg-gray-900">
    <div class="category-color w-24 py-3 border-r border-slate-600">
        <div class="w-full h-full flex items-center justify-center">
            <span class="inline-flex w-4 h-4 bg-red-600 rounded-full" style="background-color: {{$category["color"]}}"></span>
        </div>
    </div>

    <div class="category-title py-3 flex-1 text-center text-base border-r border-slate-600">
        {{$category["title"]}}
    </div>

    <div class="category-instance py-3 flex-1 text-center text-base">
        Qte Instancias
    </div>
</div>