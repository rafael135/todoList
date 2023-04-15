<label for="{{$name}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{$label}}</label>
<select id="{{$name}}" name="{{$name}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected disabled>Escolha uma categoria</option>
    @foreach ($items as $item)
        <option class="flex justify-evenly items-center" value="{{$item->id}}">
            <span class="inline-flex w-3 h-3 bg-red-600 rounded-full" style="background-color: {{$item->color}};"></span>
            {{$item->title}}
        </option>
    @endforeach
  
</select>
