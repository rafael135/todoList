<header class="bg-slate-800 h-20 w-screen">
    <nav class=" w-full h-full flex flex-row px-4">
        <ul class="w-full list-none flex justify-between text-white items-center flex-row">
            <li>
                <a class="font-bold text-2xl" href="{{route("home")}}">
                    Lista de Tarefas
                </a>
            </li>

            <li class="">
                <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 relative rounded-full ring-2 ring-gray-400 p-1 overflow-hidden bg-gray-600 cursor-pointer" alt="User dropdown">
                    <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
            </li>

            @if($loggedUser == false)



            @else
                

            @endif
        </ul>
    </nav>
</header>

<!-- Dropdown menu usuario -->
<div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-600 dark:divide-gray-600">
    @if($loggedUser != false)
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            <div class="font-medium truncate">{{$loggedUser->name}}</div>
        </div>
        <ul class="py-2 text-sm text-gray-700 divide-y divide-gray-500 dark:divide-slate-400 dark:text-gray-200" aria-labelledby="avatarButton">
            <li>
                <a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">Tarefas</a>
            </li>
        </ul>
        <div class="py-1">
            <a href="{{route("user.logout")}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:hover:text-white">Sair</a>
        </div>
    
    @else

        <div class="py-1">
            <a href="{{route("user.login")}}" class="flex justify-center items-center px-4 py-2 text-sm md:text-base text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:hover:text-white">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
                <div class="flex-grow text-center">
                    Entrar
                </div>
                
            </a>
        </div>

    @endif
</div>