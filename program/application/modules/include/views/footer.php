<div id="footer">
    <div class="container-fluid">
        <div class="span12">
            <p class="muted credit">Copyright &copy; 2013 <a href="#">Artajasa</a> Team. Designed by <a target="_blank" href="http://twitter.github.io/bootstrap">Twitter Bootstrap</a></p>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url()?>assets/backend/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend/js/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend/js/bootstrap-lightbox.min.js"></script>
<script type="text/javascript">
    if($('.set_tooltip').length){
        $('.set_tooltip').tooltip();
    }
    $(function() {
        if($( ".datepicker" ).length){
            $( ".datepicker" ).datepicker({
                    format:'yyyy-mm-dd'
            });
        }
    });
    if($('textarea.htmlarea').length > 0){
        tinymce.init({
            selector: "textarea.htmlarea",
            theme: "modern",
            height: 200,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor filemanager"
            ],
            //image_advtab: true,
            toolbar: "fontselect | fontsizeselect | undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor | image media"
        });
    }
    $(window).load(function(){
        resizeHeight();
    });
    $(window).resize(function() {
        resizeHeight();
    });

    function resizeHeight()
    {
        if($('.min-content').length > 0){
            $('.min-content').css({
                'min-height':($(window).height() - 150)
            });

            $('#footer').css({
                'position' : 'relative'
            });
        }
    }
</script>
