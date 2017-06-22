
$(function() {

    var placeholder = $('<li class="ui-state-default list-group-item empty"></li>');

    if($("#all_permission >li").length ==0){
        $("#all_permission").append(placeholder);
    }
    if($("#own_permission >li").length ==0){
        $("#own_permission").append(placeholder);
    }

    $( "#all_permission, #own_permission" ).sortable({
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

    $('.save-permission').on('click', function(){

        // 处理li
        ps = Array();
        $("#own_permission >li").each(function(i,e){
            ps.push(e.attributes.pid.value)
        });

        $.ajax({
            url: $("#own_permission").attr('url'),
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