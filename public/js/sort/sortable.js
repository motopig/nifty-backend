
$(function() {

    var placeholder = $('<li class="ui-state-default list-group-item empty"></li>');

    if($("#all >li").length ==0){
        $("#all").append(placeholder);
    }
    if($("#own >li").length ==0){
        $("#own").append(placeholder);
    }

    $( "#all, #own" ).sortable({
        connectWith: ".connectedSortable",
        placeholder: "ui-state-highlight",
        remove: function(event, ui) {
            if(!$('li', this).length) {
                if(this.id == 'all_permission')
                    $(this).append(placeholder);
                else
                    $(this).append(placeholder);
            }
        },
        receive: function(event, ui) {
            $('.empty', this).remove();
        }
    }).disableSelection();

    $('.saves').on('click', function(){

        // 处理li
        ps = Array();
        stop = 0;
        $("#own >li").each(function(i,e){
            if (! e.attributes.hasOwnProperty('pid')) {
                stop = 1;return false;
            }
            ps.push(e.attributes.pid.value)
        });

        if (stop) {
            layer.msg('请选择!!', {

            });
            return false;
        }

        $.ajax({
            url: $("#own").attr('url'),
            async: false,
            type: 'POST',
            dataType: 'json',
            data: {'_token':$("input[name='_token']").val(),'ps':ps},
            success: function (res) {
                layer.msg('保存成功!', {

                })
            },
            error: function (e) {
                layer.msg('保存失败!', {

                })
            }
        });
    })
});