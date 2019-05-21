<script type="text/javascript">
jQuery(function(){
    NProgress.configure({
        showSpinner: false
    });

    NProgress.start();

    document.onreadystatechange = function() {
        "complete" == document.readyState && setTimeout(NProgress.done, 500);
    }
});
</script>