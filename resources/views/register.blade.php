@include("partials.header")

@include("partials.navbar", ["loggedUser" => $loggedUser])

@component("partials.body")
    

    
@endcomponent

@include("partials.footer")