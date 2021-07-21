<!-- MODAL CALL -->
<div class="modal fade" id="call-me" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<form method="post" action="envia-contato.php">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h2 class="text-center">Vamos bater um papo?</h2>
    </div>
    <div class="modal-body">

    <input type="hidden" name="interesse" id="interesse" value="Site" />

    <div class="row">

        <div class="col-sm-6">

        <div class="input-group">
            <label>Qual é o seu nome?</label>
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
            <input name="nome" type="text" class="form-control required" />
        </div>

        <div class="input-group">
            <label for="">Como prefere ser contatado?</label>
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
            <select name="meio" class="form-control" onchange="$('.verify').removeClass('required'); $('input[name='+this.value+']').addClass('required');">
            <option selected></option>
            <option value="email">Email</option>
            <option value="telefone">WhatsApp</option>
            </select>
        </div>

        </div>

        <div class="col-sm-6">

        <div class="input-group">
            <label for="">Qual seu email?</label>
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
            <input name="email" type="text" class="form-control required"/>
            </div>

        <div class="input-group">
            <label for="">Qual seu telefone?</label>
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-earphone"></span></span>
            <input name="telefone" type="text" class="form-control phone verify" />

            
        </div>

        </div>

        </div>
        <input name="acao" type="hidden" class="form-control phone verify" value="envia-form-contato" />
        <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-comment"></span></span>
        <label for="">Poderia nos fornecer detalhes de sua necessidade?</label>
        <textarea name="mensagem" class="form-control" rows="7" ></textarea>
        </div>

    </div>

    <div class="modal-footer text-center">
        <button type="button" class="btn btn-lg btn-link" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-lg btn-border">Enviar</button>
    </div>

    </form>
    </div>
</div>
</div>


<!-- MODAL PAINEL -->
<div class="modal fade" id="client-area" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    <form method="post" action="/clientes/autentica">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Área do Cliente</h4>
        </div>
        <div class="modal-body">
            <input name="redir" type="hidden" value="/clientes" />
            <input name="login" type="text" class="form-control" placeholder="usu&aacute;rio"/>
        <input name="senha" type="password" class="form-control" placeholder="senha"/>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-link" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-lg btn-border">Entrar</button>
        </div>
        </form>
    </div>
    </div>
</div>

</body>

<script> var __PATH__ = '/';</script>
<script src="//code.jquery.com/jquery-3.2.0.min.js"></script>
<!--<script src="/js/jquery-2.1.4.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollto.min.js"></script>
<!--[if lt IE 9]>
    <script src="/js/respond.min.js"></script>
    <script src="/js/html5shiv.js"></script>
<![endif]-->

<script type="text/javascript">
    function requestBudget(form){
        var title = 'Pedido de Or&ccedil;amento';
        var type = BootstrapDialog.TYPE_DANGER;
        if(validaForm(form, true)){
        $(form).ajaxSubmit({
            url: __PATH__+'ajax/send-budget/',
            type: "POST",
            dataType: "json",
            beforeSend: function() {
                blockUi();
            },
            success: function(data, textStatus, jqXHR)
            {
                    unblockUi();
                    blockUiMsg(data['data'],5000,"location='/planos-criacao-sites';");
                    if (data['ok']) {
                        form.reset();

                        if (typeof(fbq_enabled) !== 'undefined') {
                            fbq('track', 'Lead');
                        }
                    }

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                unblockUi();
                msg = 'Ocorreu um erro: ' + errorThrown;
                showMessage(title, msg, type, []);
                return false;
            }
            });

        }
        return false;
    }
    
    function sendCallMe(form){
        var title = 'Me ligue';
        var type = BootstrapDialog.TYPE_DANGER;
        if(validaForm(form, true)){
            $(form).ajaxSubmit({
                url: __PATH__+'ajax/call-me/',
                type: "POST",
                dataType: "json",
                beforeSend: function() {
                    blockUi();
                },
                success: function(data, textStatus, jqXHR)
                {
                    unblockUi();
                    blockUiMsg(data['data']);
                    form.reset();
                    fbq('track', 'Lead');
                    ga('send', 'event', 'Formulario', '-Orcamento');
                }

            });

        }
        return false;
    }

</script>
<script>
$(function () {

$(window).scroll(function (event) {
if($(window).scrollTop() > 200){
    $('.btn-gotop').removeClass('hidden');
}else{
    $('.btn-gotop').addClass('hidden');
}
});
$(".input-group input,textarea,select").focus(function() {
    $(".input-group").removeClass("active")
    $(this).parent().addClass("active");
});
$(".input-group input,textarea,select").blur(function() {
if(this.value.replace(/[^0-9a-zA-Z]/,'') == ""){
    $(this).parent().removeClass("filled");	
}else{
    $(this).parent().addClass("filled");
}
});
$('.proposal-page-group ul li label input[type="checkbox"]').click(function() {
if($(this).prop("checked")){
    $(this).parent().addClass("active");	
}else{
    $(this).parent().removeClass("active");
}
});

});
</script>                    