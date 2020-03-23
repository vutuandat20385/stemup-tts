function checklength() {
    code = $('#class_code').val();
    console.log(code);
    if (code.length == 0) {
        document.getElementById("errorr").innerHTML = "<i>Không được để trống mã lớp</i>";
    } else {
        dt = JSON.stringify({
            'code': code,
        })
        $.ajax({
            type: "POST",
            url: site_url + '/home_user/join_class',
            data: dt,
            contentType: 'application/json',
            success: function (data) {
                if (data['status'] == 0) {
                    document.getElementById("errorr").innerHTML = "<i>Mã lớp không tồn tại</i>";
                } else {
                    alert(data['mess']);
                    window.location.href = site_url + '/home_user/manage_class';
                }
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        })
    }
}
function checklengthtab(evt, code) {
    if (evt.keyCode == 13) {
        if (code.length == 0) {
            document.getElementById("errorr").innerHTML = "<i>Không được để trống mã lớp</i>";
        } else {
            dt = JSON.stringify({
                'code': code,
            })
            $.ajax({
                type: "POST",
                url: site_url + '/home_user/join_class',
                data: dt,
                contentType: 'application/json',
                success: function (data) {
                    if (data['status'] == 0) {
                        document.getElementById("errorr").innerHTML = "<i>Mã lớp không tồn tại</i>";
                    } else {
                        alert(data['mess']);
                        window.location.href = site_url + '/home_user/manage_class';
                    }
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            })
        }
    }
}
/*$(document).ready(function(){
    var submit = $("#btjoinclass");
    submit.click(function(){
        var code = $("#class_code").val();
        console.log(code);
        if(code == ''){
            document.getElementById("error").innerHTML = "<i>Không được để trống mã lớp</i>";
            return false;
        }else{

        }
        $.ajax({
            type:"POST",
            url:site_url + '/home_user/join_class',
            data:{class_code:code},
            success:function(data){
                // /
                if(data['status']==1){
                    $('#joinClassModal').modal("hide");
                    alert(data['mess']);
                }else{
                    document.getElementById("error").innerHTML = data['mess'];
                }
            },
            error:function(data){
                console.log(data);
            }
            
        })
    })
})*/