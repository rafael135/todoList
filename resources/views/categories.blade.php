@include("partials.header")

<!--@`include("partials.navbar", ["loggedUser" => $loggedUser])-->
@include("partials.sideMenu", ["loggedUser" => $loggedUser, "currentPage" => $currentPage])

@component("partials.body")


    
        <div class="relative w-full mt-3 shadow-md sm:rounded-lg">
            <div id="categories-table" class="bg-slate-800 w-full md:rounded-t-lg">
                <div class="flex flex-col md:flex-row p-3">
                    <div class="flex flex-row mb-2 md:mb-0">
                        <!-- Modal Create Toggle -->
                        <a href="#" type="button" data-tooltip-target="create-tooltip" data-tooltip-placement="right" data-tooltip-trigger="hover" id="createCategoryButton" data-modal-target="createCategoryModal" data-modal-show="createCategoryModal" class="flex items-center py-2 px-1 rounded-md font-medium text-blue-600 dark:text-slate-100 dark:hover:text-green-400 dark:bg-gray-600 dark:border-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:active:text-green-500 max-w-fit">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
                            <!--<div class="text-inherit">Criar Categoria</div>-->
                        </a>
                        <div id="create-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Criar Categoria
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    

                        <div class="flex-grow flex justify-center items-center md:ms-2">
                            <h2 class="text-white bg-transparent text-center text-xl font-bold uppercase">Categorias</h2>
                        </div>
                    </div>
    
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="md:ms-auto">
                        <form method="GET" action="{{route('user.categories')}}" class="flex items-center relative">
                            <div class="flex items-center pl-3 pointer-events-none absolute">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="hidden" name="page" value="{{$pagination['currentPage']}}" />
                            <input type="text" name="search" value="{{($search != false) ? $search : ''}}" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-full md:max-w-fit" placeholder="Procurar por Categorias">
                        </form>
                        
                    </div>
                </div>

                <div id="categories-head" class="flex bg-gray-700 text-gray-300 text-lg">
                    <div class="category-color w-20 py-2 text-center font-bold text-lg border-r border-slate-600">
                        Cor
                    </div>

                    <div class="category-title py-2 flex-1 text-center font-bold text-lg border-r border-slate-600">
                        Título
                    </div>

                    <div class="category-instances py-2 flex-1 text-center font-bold text-lg border-r border-slate-600">
                        Qte Tarefas
                    </div>

                    <div class="category-actions py-2 w-36 text-center font-bold text-lg">
                        Ações
                    </div>
                </div>

                <div id="categories-body" class="flex flex-col bg-gray-800 text-white">
                    @if(count($categories) > 0)
                        @foreach ($categories as $category)
                            <x-category :category=$category/>
                        @endforeach
                    @else

                        <div class="text-center py-6 text-xl font-bold">Nenhuma categoria encontrada!</div>

                    @endif
                </div>

                <div class="categories-pagination bg-slate-900 flex flex-col justify-center items-center pt-0 pb-4">
                    <hr class="h-px my-3 w-[95%] shadow-md bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="flex flex-col items-center">
                        <!-- Help text -->
                        <span class="text-sm text-gray-700 dark:text-gray-400">
                            Mostrando <span class="font-semibold text-gray-900 dark:text-white">{{$pagination["offsetItem"]}}</span> - <span class="font-semibold text-gray-900 dark:text-white">{{$pagination["showingItems"]}}</span> de <span class="font-semibold text-gray-900 dark:text-white">{{$pagination["categoriesCount"]}}</span> Categorias
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <!-- Buttons -->
                            <a href="{{$routePrev}}" class="pagination-previousBtn">
                                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                                Anterior
                            </a>
                            <a href="{{$routeNext}}" class="pagination-nextBtn">
                                Próximo
                                <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
  
                </div>
            </div>

            
            
        </div>

        <script type="text/javascript">
            let csrfToken = `{{csrf_token()}}`;
            let getCategoryDataRoute = `{{route("category.get")}}`
            let createCategoryRoute = `{{route("category.create")}}`;
            let editCategoryRoute = `{{route("category.edit")}}`;
            let deleteCategoryRoute = `{{route("category.delete")}}`;
            
        </script>

         <!-- Edit Category modal -->
         <div id="editCategoryModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <form action="{{route("category.edit")}}" method="POST" class="relative bg-white rounded-lg shadow dark:bg-slate-800 bg-gradient-to-b from-slate-800 from-70% to-slate-900">
                    @csrf

                    <input id="editCategory_id" name="id" type="hidden" value=""/>
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600 bg-gradient-to-r from-gray-900 from-70% to-gray-950">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Editar Categoria
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-red-600" data-modal-hide="editCategoryModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 md:col-span-3">
                                
                                <div class="pickr h-full w-full flex justify-center gap-3 items-center">
                                    <label for="editColor" class="inline-flex -mt-1 text-base font-medium text-gray-900 dark:text-white">Cor:</label>
                                    <input type="color" name="color" id="editColor" class="w-10 h-10 border-transparent bg-transparent">
                                </div>
                            </div>

                            <div class="col-span-6 md:col-span-3">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                                <input type="text" name="title" id="editTitle" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:bg-blue-900">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- Create Category modal -->
        <div id="createCategoryModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <form action="{{route("category.create")}}" method="POST" class="relative bg-white rounded-lg shadow dark:bg-slate-800 bg-gradient-to-b from-slate-800 from-70% to-slate-900">
                    @csrf

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600 bg-gradient-to-r from-gray-900 from-70% to-gray-950">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Criar nova Categoria
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-red-600" data-modal-hide="createCategoryModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 md:col-span-3">
                                <div class="pickr h-full w-full flex justify-center gap-3 items-center">
                                    <label for="editColor" class="inline-flex -mt-1 text-base font-medium text-gray-900 dark:text-white">Cor:</label>
                                    <input type="color" name="color" id="createColor" class="w-10 h-10 border-transparent bg-transparent">
                                </div>
                            </div>

                            <div class="col-span-6 md:col-span-3">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                                <input type="text" name="title" id="createTitle" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-800">Criar Categoria</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteCategoryModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative rounded-lg shadow bg-gradient-to-b from-gray-900 from-60% to-gray-950">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-red-600" data-modal-hide="deleteCategoryModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-200 w-14 h-14 dark:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-200">Confirmar a exclusão da Categoria?</h3>
                        <button data-modal-hide="deleteCategoryModal" type="button" onclick="deleteCategory()" class="text-white bg-red-600 hover:bg-red-800 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Sim
                        </button>
                        <button data-modal-hide="deleteCategoryModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:outline-none rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset("assets/js/categoryActions.js")}}"></script>

        @if($error != false)
            <div id="toast-danger" class="absolute bottom-0 right-4 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">{{$error["msg"]}}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Fechar</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif

        @if($success != false)
            <div id="toast-success" class="absolute bottom-0 right-4 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">{{$success["msg"]}}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif

@endcomponent

@include("partials.footer")