$(function () {
    //全选
    $(document).on('click','.all',function () {
        $(':checkbox').prop('checked',true);
    });

    //反选
    $(document).on('click','.noall',function () {
        $(':checkbox').prop('checked',function(i,v){
            return !v;
        })
    });

    //返回
    $(document).on('click','.back',function () {
        history.go(-1);
    })

    //多个删除
    // $(document).on('click','.del',function () {
    //     var res=window.confirm('你确定要删除吗');
    //     if(res){
    //         $(":checkbox").each(function(){
    //             if(this.checked){
    //                 $(this).parents('tr').remove();
    //             };
    //         })
    //     }
    // });

    // //单个删除
    // $(document).on('click','.delone',function(){
    //     var res=window.confirm('你确定要删除吗');
    //     if(res){
    //         $(this).parents('tr').remove();
    //     }
    // })

})