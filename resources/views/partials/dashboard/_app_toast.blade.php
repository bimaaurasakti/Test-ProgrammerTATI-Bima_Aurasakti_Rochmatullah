<script type="text/javascript">
    {{-- Success Message --}}
    @if (Session::has('success'))
        $('#toast-message .toast-title').html('Congratulations');
        $('#toast-message .toast-body').html('{{ Session::get("success") }}');
        $('#toast-message').addClass('show').delay(5000).queue(function(next){
            $(this).removeClass("show");
            $(this).addClass("hide");
            next();
        });
    @endif

    {{-- Errors Message --}}
    @if (Session::has('error'))
        $('#toast-message .toast-title').html('Opps!!!');
        $('#toast-message .toast-body').html('{{ Session::get("error") }}');
        $('#toast-message').addClass('show').delay(5000).queue(function(next){
            $(this).removeClass("show");
            $(this).addClass("hide");
            next();
        });
    @endif
    
    @if(Session::has('errors') || ( isset($errors) && is_array($errors) && $errors->any()))
        $('#toast-message .toast-title').html('Opps!!!');
        $('#toast-message .toast-body').html('{{ Session::get("errors")->first() }}');
        $('#toast-message').addClass('show').delay(5000).queue(function(next){
            $(this).removeClass("show");
            $(this).addClass("hide");
            next();
        });
    @endif
</script>

