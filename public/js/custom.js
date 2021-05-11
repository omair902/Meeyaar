$(document).ready(function()
{
    $('.remove').click(function()
    {
        var url=$(this).attr('data-url');
        $('.form').attr('action',url);
    });
});