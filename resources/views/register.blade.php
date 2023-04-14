@include("partials.header")

@include("partials.navbar", ["loggedUser" => $loggedUser])

@component("partials.body")
    <form class="form-auth rounded-xl shadow-lg bg-slate-800 pb-4 pt-0 bg-opacity-95" method="POST" action="{{route("user.registerAction")}}">
        @csrf

        <h1 class="text-4xl text-center text-slate-100 bg-slate-700 py-4 rounded-t-xl mb-4 border-b-slate-400 shadow-sm">
            Registre-se
        </h1>

        <div class="mb-4 mx-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
            <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>

        <div class="mb-4 mx-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
            <input type="email" name="email" autocomplete="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-4 mx-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
            <input type="password" name="password" autocomplete="new-password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-4 mx-6">
            <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repita a senha</label>
            <input type="password" name="repeat-password" autocomplete="new-password" id="repeat-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        

        <div class="flex mb-2 mx-6">
            <button type="submit" class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar-se</button>
        </div>

        <a href="{{route("user.login")}}" class="flex justify-center items-center text-base text-white hover:underline hover:text-slate-300 mx-6">Já possui conta? Clique aqui!</a>

    </form>

    
@endcomponent

@include("partials.footer")