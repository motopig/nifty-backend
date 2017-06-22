


$(window).on('load', function() {


    // ajax html 模态
    $('.modals-btn').on('click', function(){

        var url = $(this).attr('url');
        var title = $(this).attr('title');
        var method = $(this).attr('method');
        var module = '';

        $.ajax({
            url: url,
            async: false,
            type: method,
            dataType: 'html',
            data: '',  // todo
            success: function (res) {
                module = res;
            },
            error: function (e) {

            }
        });

        bootbox.dialog({
            title: title,
            message: module,
            buttons: {
                success: {
                    label: "保存",
                    className: "btn-purple",
                    callback: function() {

                        $.ajax({
                            url: $('.modals-form').attr('action'),
                            async: false,
                            type: $('.modals-form').attr('method'),
                            dataType: 'json',
                            data: $('.modals-form').serialize(),
                            success: function (ret) {
                                window.location.reload();
                            },
                            error: function (e) {

                            }
                        });

                        $.niftyNoty({
                            type: 'purple',
                            icon : 'fa fa-check',
                            message : "保存成功",
                            container : 'floating',
                            timer : 4000
                        });
                    }
                }
            },
            animateIn: 'rubberBand',
            animateOut : 'wobble'
        });

        // $(".demo-modal-radio").niftyCheck();
    });

    $('.del-confirm').on('click',function(){
        var that = this;
        layer.confirm('是否删除?',
            {
                icon: 3,
                title:'提示'
            }, function(index){

                $.ajax({
                    url: $(that).attr('url'),
                    async: false,
                    type: $(that).attr('method'),
                    dataType: 'json',
                    data: {},
                    success: function (ret) {
                        layer.msg('删除成功!');
                    },
                    error: function (e) {
                        layer.msg('删除失败!');
                    }
                });
                layer.close(index);
            }
        );

    });


});
