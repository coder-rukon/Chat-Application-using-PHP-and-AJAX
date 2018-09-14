function edit_profile_tmp(a,loc,which)
{
    var atm=a.files[0].type;
    var type5;
    type5=a.files[0].type.split('/');
    if(type5[0]=="image")
    {
        if(a.files && a.files[0])
        {
            var reader=new FileReader();
            reader.onload=function(e)
            {             
                if(which=="profile")
                {
                    $("#"+loc).attr('style',"background-image: url("+e.target.result+")");
                }else if(which == "cover"){
                    $("#"+loc).attr('style',"background: url("+e.target.result+") 40%;");
                }
            }
            reader.readAsDataURL(a.files[0]);
        }
    }
}
function block_unblock(tbl,path,status,id)
{
    if(status==1)
    {
        $(path).html("<i class='icon-thumbs-down' onclick="+"block_unblock('"+tbl+"','"+path+"',0,'"+id+"');"+" style='font-size: 15px;color: red;'>Block</i>");
        status=0;
    }else if(status==0){
        $(path).html("<i class='icon-thumbs-up' onclick="+"block_unblock('"+tbl+"','"+path+"',1,'"+id+"');"+" style='font-size: 15px;color: green;'>Unblock</i>");
        status=1;
    }
   
   
    $.ajax({
        url:"master_page/missing_setting.php?why=block_unblock&id="+id+"&status="+status+"&tbl="+tbl,
        type:"POST",
        success:function(data){
        }
    });
}

function attendance_present_absent(tbl,path,status,id)
{
    if(status==1)
    {
        $(path).html("<span  onclick=\"if(confirm('Are you sure want to update attendance ?')){attendance_present_absent('attendance_form','"+path+"',0,'"+id+"');} \" style='font-size: 14px;cursor: pointer;border-radius:100%;color: white;background: red;padding: 5px 7px;'>A</span>");
        status=0;
    }else if(status==0){
        $(path).html("<span  onclick=\"if(confirm('Are you sure want to update attendance ?')){attendance_present_absent('attendance_form','"+path+"',1,'"+id+"');} \" style='font-size: 14px;cursor: pointer;border-radius:100%;color: white;background: green;padding: 5px 7px;'>P</span>");
        status=1;
    }
   
    $.ajax({
        url:"master_page/missing_setting.php?why=attendance_present_absent&id="+id+"&status="+status+"&tbl="+tbl,
        type:"POST"
    });
}



function open_close_form(form,icon,status)
{
    if(status==0)
    {
        $(form).slideDown(500);
        $(icon).attr("onclick","open_close_form('#admin_form','#click_to_open_close_form',1)");
        $(icon).attr("class","icon-ei-minus");
        $(icon).attr("style","color: red;font-size: 50px;");  
    }
    else if(status==1){
        $(form).slideUp(500);
        $(icon).attr("onclick","open_close_form('#admin_form','#click_to_open_close_form',0)");
        $(icon).attr("class","icon-ei-plus");
        $(icon).attr("style","color: green;font-size: 50px;");
    }    
}


function atman(ope,tbl,id,idname)
{
    $.ajax({
        url:"master_page/missing_setting.php?why=atman&id="+id+"&tbl="+tbl+"&ope="+ope+"&idname="+idname,
        type:"POST",
        success:function(data){
        }
    });
}

/*
function atman_edit_display(page,div,id)
{  
    $.ajax({
        url:page+".php?ope=edit&id="+id,
        type:"POST",
        success:function(data){
            $(div).html(data);
        }
    });
}
*/
function global_load(page,div,id)
{      
    $.ajax({
        url:page+".php?id="+id,
        type:"POST",
        success:function(data){
            $(div).html(data);
        }
    });
}


function course_onchange_semster(div,courseid){
    $.ajax({
        url:"master_page/missing_setting.php?courseid="+courseid+"&why=display",
        type:"POST",
        success:function(data){
            $(div).html(data);
        }
    });
}
function semster_onchange_subject(div,courseid){
    $.ajax({
        url:"master_page/missing_setting.php?semesterid="+courseid+"&why=display",
        type:"POST",
        success:function(data){
            $(div).html(data);
        }
    });
}
function div_onchange_student(div,divid){
    $.ajax({
        url:"master_page/missing_setting.php?divid="+divid+"&why=display",
        type:"POST",
        success:function(data){
            $(div).html(data);
        }
    });
}



function semster_onchange_division(div,divisionid){
    $.ajax({
        url:"master_page/missing_setting.php?divisionid="+divisionid+"&why=display",
        type:"POST",
        success:function(data){
            $(div).html(data);
        }
    });
}



function leave_status(leaveid,status){
    $.ajax({
        url:"master_page/missing_setting.php?leaveid="+leaveid+"&status="+status,
        type:"POST",
        success:function(data){
        }
    });
}